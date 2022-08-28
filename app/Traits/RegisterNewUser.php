<?php
namespace App\Traits;

use App\Models\Userprofile;
use App\Models\User;
use Carbon\Carbon;



trait RegisterNewUser
{

    public function createuserprofile($user) 
	{   
    
        $userprofile = new Userprofile;
        $userprofile->user_id = $user->id;
        $userprofile->created_at = Carbon::now();
        $userprofile->updated_at = Carbon::now(); 
        $userprofile->save();
     
        return $userprofile;       
	}

    
}
