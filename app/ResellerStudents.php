<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerStudents extends Model
{
    protected $fillable = ['email',
                            'fname',
                            'lname',
                            'mobile',
                            'country',
                            'status',
                            'linkedin_url',
                            'type','coated_amount',
                            'interested_course',
                            'sales_amount',
                            'amount_paid',
                            'balance',
                            'mode_of_payment',
                            'linkedin_url',
                            'added_by'];
    
    public function course_taken(){
        
    	return $this->hasMany('App\ResellersEnrollStudents', 'student_id');

    }
    
}
