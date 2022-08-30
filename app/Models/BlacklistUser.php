<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlacklistUser extends Model
{

    use SoftDeletes;


    protected $table = 'blacklist_users';

    protected $fillable=['firstname', 'lastname', 'birth_date', 'created_at', 'updated_at'];

    protected $dates = ['birth_date', 'deleted_at'];


}
