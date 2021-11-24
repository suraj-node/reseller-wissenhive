<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resellers extends Model
{
    protected $fillable = ['email','password','company_name','logo','url','status'];

}
