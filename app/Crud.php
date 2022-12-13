<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $table = 'crud';
    protected $fillable = ['firstname', 'lastname', 'email', 'password', 'mobile', 'usertype'];
    public $timestamp = false;
}
