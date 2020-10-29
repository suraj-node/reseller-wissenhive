<?php

namespace App;

use Illuminate\Http\Request;
use App\ActivityLogger;


trait ActivityLoggerTrait{

	public function logActivity($activity, $doneby, $object_id, $action){


		$store = array('activity' => $activity, 'done_by' => $doneby, 'object_id' => $object_id, 'action'=>$action );
		
		ActivityLogger::create($store);

	}

}