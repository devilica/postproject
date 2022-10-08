<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
class GmailController extends Controller
{
    //


    public function test(){

        $api_response = Http::get('https://postingproject.herokuapp.com/api/posts');

        $response = json_decode($api_response);
        $data=$response->data;
        //dd($data);
        foreach($data as $d){
            print $d->title;
        }
   
    }

    public function getProfile(){
        
        
        
        //$accessToken='ya29.a0AVA9y1spEqqjarQ1uUyLuVxSKgyu0lTSY0gJEpFK4DD4Cuqaqp9Ued98mIZB8h6IpA1NZveHQbXMG6z84QBmwvfFfQfk4CK-kpffLUkgXiW3WoxetuthVXoCMeBrQ_jaoNTy8hG_SgGP_sFQiHPfSplfI4p7aCgYKATASARISFQE65dr8j9J_jMvMfhdUU_fpxpaX6A0163';
        $api_response = Http::withHeaders([
            'Accept' => 'application/json',
           // 'Authorization' => 'Bearer '.$accessToken,
        ])->get('https://gmail.googleapis.com/gmail/v1/users/zavjesa987@gmail.com/messages');
        return $api_response;

    }

    private function getClient():\Google_Client
    {
        // load our config.json that contains our credentials for accessing google's api as a json string
        $configJson = base_path().'/config.json';

        // define an application name
        $applicationName = 'postproject';

        // create the client
        $client = new \Google_Client();
        $client->setApplicationName($applicationName);
        $client->setAuthConfig($configJson);
        $client->setAccessType('offline'); // necessary for getting the refresh token
        $client->setApprovalPrompt ('force'); // necessary for getting the refresh token
        // scopes determine what google endpoints we can access. keep it simple for now.
        $client->setScopes(
            [

                \Google\Service\Oauth2::USERINFO_PROFILE,
                \Google\Service\Oauth2::USERINFO_EMAIL,
                \Google\Service\Oauth2::OPENID,
                \Google\Service\Drive::DRIVE_METADATA_READONLY // allows reading of google drive metadata
            ]
        );
        $client->setIncludeGrantedScopes(true);
        return $client;
    } // getClient

    public function getAuthUrl(Request $request)
    {
        /**
         * Create google client
         */
        $client = $this->getClient();
        //dd($client);

        /**
         * Generate the url at google we redirect to
         */
        $authUrl = $client->createAuthUrl();

       // dd($authUrl);
        /**
         * HTTP 200
         */
        
       // return response()->json($authUrl, 200);

       
      return view('gmail',
         [
        'authUrl'=>$authUrl
       ]);
    } // getAuthUrl


    public function postLogin(Request $request):JsonResponse
    {

        /**
         * Get authcode from the query string
         * Url decode if necessary
         */
        $authCode = urldecode($request->input('auth_code'));

        /**
         * Google client
         */
        $client = $this->getClient();

        /**
         * Exchange auth code for access token
         * Note: if we set 'access type' to 'force' and our access is 'offline', we get a refresh token. we want that.
         */
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        dd($accessToken);

        /**
         * Set the access token with google. nb json
         */
        $client->setAccessToken(json_encode($accessToken));

        /**
         * Get user's data from google
         */
        $service = new \Google\Service\Oauth2($client);
        $userFromGoogle = $service->userinfo->get();

        /**
         * Select user if already exists
         */
        $user = User::where('provider_name', '=', 'google')
            ->where('provider_id', '=', $userFromGoogle->id)
            ->first();

        /**
         */
        if (!$user) {
            $user = User::create([
                    'provider_id' => $userFromGoogle->id,
                    'provider_name' => 'google',
                    'google_access_token_json' => json_encode($accessToken),
                    'name' => $userFromGoogle->name,
                    'email' => $userFromGoogle->email,
                    //'avatar' => $providerUser->picture, // in case you have an avatar and want to use google's
                ]);
        }
        /**
         * Save new access token for existing user
         */
        else {
            $user->google_access_token_json = json_encode($accessToken);
            $user->save();
        }

        /**
         * Log in and return token
         * HTTP 201
         */
        $token = $user->createToken("Google")->accessToken;
        return response()->json($token, 201);
    } // postLogin

}
