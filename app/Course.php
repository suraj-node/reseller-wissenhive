<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $table = 'course';
    
    protected $fillable = ['title','amount','one_on_one','interview_preparation','project_support','status'];
}
