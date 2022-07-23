<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    public function index(){

        $users=User::orderBy('id','desc')->paginate('20');


        return view('admin.users.index', [
            'users' => $users
        ]);

    }


}
