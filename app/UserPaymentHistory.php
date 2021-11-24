<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentHistory extends Model
{
    public $table = 'user_payment_history';

    protected $fillable = [

    							'user_id',
    							'course_id',
    							'course_history_id',
    							'amount_capture',
    							'user_address',
    							'user_country',
    							'user_state',
    							'user_postal_code',
    							'user_name',
    							'user_description',
    							'payment_token',
    							'currency',
    							'card_issued_country',
    							'card_exp_month',
    							'card_exp_year',
    							'card_fingerprint',
    							'card_last_four_digit',
    							'card_network',

    					  ];
}
