<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ReorderController extends Controller

{     

		  	$order = [
							    "email" => "kanishkas@99x.lk",
							    "fulfillment_status" => "unfulfilled",
							    "line_items" => [
							      [
							          "variant_id" => 42837938757,
							          "quantity" => 5
							      ]
							    ]
							];
	file_put_contents("php://stderr", json_decode($order).PHP_EOL);
	
  file_put_contents("php://stderr","asasa".PHP_EOL);
	}
}
