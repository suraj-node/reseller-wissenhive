<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourseHistory extends Model
{
    public $table = 'user_course_history';

    protected $fillable = ['user_id','user_email','course_id','course_type','course_schedule','course_amount', 'salt','is_payment'];

}
