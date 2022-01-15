<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{   
    public $table = 'admin';
    protected $fillable = ['name', 'email', 'password'];
}
