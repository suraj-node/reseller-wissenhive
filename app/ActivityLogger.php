<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLogger extends Model
{
    public $table = 'recent_activity_logger';

    protected $fillable = ['activity','done_by','object_id', 'action'];
}
