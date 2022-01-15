<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $table = 'invoice';
    protected $fillable = [

                'amount',
                'course',
                'mode_of_payment',
                'reseller_comment',
                'admin_comment',
                'status',
                'notification_status_reseller',
                'notification_status_admin',
                'candidate_id',
                'reseller_id',
                'admin_id'
    ];

    
}
