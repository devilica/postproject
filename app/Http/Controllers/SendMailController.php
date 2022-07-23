<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SendMailController extends Controller
{
    public function testMail($id){

   
            $details = [
                'title' => 'Vazno obavjestenje',
                'body' => 'Ovo je testiranje prvog mejla'
            ];
           
            $user=User::find($id);

            \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
           
            dd("Email is Sent.");
    }



}
