<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Userprofile extends Model
{
    use HasFactory;

    protected $fillable=['firstname', 'lastname', 'mobile','address1', 'address2','postcode','city', 'education', 'country', 'details', 'created_at', 'updated_at', 'deleted_at'];
    
   // protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
