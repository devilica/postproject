<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    public function index(){

        $users=User::orderBy('id','asc')->paginate('20');


        return view('admin.users.index', [
            'users' => $users
        ]);

    }


    public function changeUsertype($id){

        $user=User::find($id);
        if($user->user_type=='user'){
            $user->user_type='admin';
            $user->save();
        }else{
            $user->user_type='user';
            $user->save();
        }
        return back()->with('message', 'Successfully changed user type');



    }








}
