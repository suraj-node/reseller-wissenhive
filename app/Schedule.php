<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'shedule';
    protected $fillable = ['course_id','date','schedule_type','duration'];

     public function course(){

        return $this->belongsTo('App\Schedule', 'course_id');
   
    }
}
