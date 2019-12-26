<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $fillable = ['user_id', 'fullname', 'chat_id', 'role'];
}
