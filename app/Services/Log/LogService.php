<?php

namespace App\Services\Log;

use App\Models\Log;

class LogService{

	public static function insert( $dni, $level , $message , $context ){

		$objLog = Log::create([
			"dni" => $dni,
			"level" => $level,
			"message" => $message,
			"context" => $context,
		]);
	}
}
