<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerStudents extends Model
{
    protected $fillable = ['email','fname','lname','mobile','country','status','added_by'];
}
