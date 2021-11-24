<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    protected $fillable = [

    	'title',
    	'category',
        'slug_url',
    	'course_thumbnail',
        'course_cert_image',
        'description',
        'course_rating',
        'course_rating_overall',
    	'course_learner',
    	'course_video_link',
    	'course_dataset',
    	'overview',
    	'skills_covered',
    	'course_benefits',
        'course_details',
        'course_exam_and_cert',
        'length',
        'effort',
        'governing_body',
        'language',
        'video_script',
        'status',

    ];

    public function getCourseThumbnailAttribute($value){
        return url('/').'/course-thumbnail/'.$value;
    }

    public function getCourseCertImageAttribute($value){
        return url('/').'/course-certification/'.$value;
    }

    public function getCourseDatasetAttribute($value){
        return url('/').'/course-dataset/'.$value;
    }
    
    //  public function option(){
        
    //     return $this->hasMany('App\Models\Admin\CourseTrainingOption', 'course_id');

    // }

    // public function content(){
        
    //     return $this->hasMany('App\Models\Admin\Content', 'course_id');

    // }

    // public function faq(){
        
    //     return $this->hasMany('App\Models\Admin\Faq', 'course_id');

    // }

     public function schedule(){
        
        return $this->hasMany('App\Course', 'id');

    }
    
    public function student_enroll(){
        
        return $this->belongsTo('App\ResellersEnrollStudents', 'course_id');

    }

}
