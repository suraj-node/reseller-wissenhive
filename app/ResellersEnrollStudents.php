<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellersEnrollStudents extends Model
{
    protected $fillable = ['student_id','course_id','schedule_id','currency','amount','assign_by'];
    
    
     public function students(){

    	return $this->hasMany('App\ResellerStudents', 'id', 'student_id');

    }

    public function course(){

    	return $this->hasMany('App\Course', 'id', 'course_id');

    }
    
    
}
