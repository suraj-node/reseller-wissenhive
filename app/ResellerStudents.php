<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerStudents extends Model
{
    protected $fillable = ['email','fname','lname','mobile','country','status','added_by'];
    
    public function course_taken(){

    	return $this->hasMany('App\ResellersEnrollStudents', 'student_id');

    }
    
}
