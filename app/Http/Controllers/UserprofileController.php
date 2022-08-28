<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userprofile;
use Illuminate\Support\Facades\Auth;

class UserprofileController extends Controller
{
    //

    public function userprofile(){

        return view('admin.userprofile');
   }

   public function updateProfile(Request $request){

    $inputs=request()->validate([
        'firstname'=>'required|min:3',
        'lastname'=>'required'

    ]); 

    $user=Userprofile::find(Auth::id());
    $user->firstname=$request->firstname;
    $user->lastname=$request->lastname;
    $user->mobile=$request->mobile;
    $user->address1=$request->address1;
    $user->address2=$request->address2;
    $user->postcode=$request->postcode;
    $user->city=$request->city;
    $user->country=$request->country;
    $user->education=$request->education;
    $user->details=$request->details;

    $user->save();
    return back()->with('message', 'Successfully updated!');

   }


}
