<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrderController extends Controller

{   

	public function verify_webhook($data, $hmac_header){

	    $calculated_hmac = base64_encode(hash_hmac('sha256', $data, "039debc65f8d0525541d9b01c95b3b6475059390eae4410f959333ea0dcca66d", true));
	    return hash_equals($hmac_header, $calculated_hmac);
	}

    public function tag(){    	

    	$client = new Client();
        $res = $client->request('PUT', 'https://3e0ea0b497d2c61c9c65772d128b0ac1:42a3bd866aa6debd4a2c172606a883ff@saaraketha-organics.myshopify.com/admin/orders/4990583621.json', [ 
        	 	'form_params' => ['order' => [
                              'id' => 4990583621,
                              'tags' => rand()
                            ]]
        ]);
        echo $res->getStatusCode();
        dd(json_decode((string)$res->getBody(),true));
    }

    public function webhook_tagger(Request $request){

    	//$header 	= $request->header()["x-shopify-hmac-sha256"][0];
    	// $data   	= file_get_contents('php://input');
		// $verified 	= $this->verify_webhook($data, $header);

		// if($verified){

	 		$id  		=  (string)$request['id'] ;
	 		$url 		=  'https://3d7b2f6a83f57bc4d0abb14205942ef5:b04081ebe8a2849ed05f0decc4606e1e@saaraketha-organics.myshopify.com/admin/orders/'.$id.'.json';
	 		$date 		= $request['note_attributes'][0]['value'];
	    	$client 	= new Client();
	        $res 		= $client->request('PUT', $url , [ 
					        	 						'form_params' => 
					        	 										[
					        	 											'order' => [
					                              										'id' => $id,
					                              										'tags' => ["forced created date changed ", "second" ],
					                              										 'created_at' => '2017-09-14T23:16:27-11:00',
					                              										 'attribute' => 'new one'                 
					                  												   ]
					                  									 ]
					        	 						
	        										 ]
	        						   );
	        dd(json_decode((string)$res->getBody(),true));

	    //     return response('Order was succesfully tagged', 200);
	    // }

	    // else{
	    // 	return response('Untrusted Source. Webhook could not be verified ', 403);
	    // }
    }

    public function reorder(Request $request){
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

		 		$url 		=  'https://3d7b2f6a83f57bc4d0abb14205942ef5:b04081ebe8a2849ed05f0decc4606e1e@saaraketha-organics.myshopify.com/admin/orders.json';
		 		$client 	= new Client();

		 		$res = $client->postAsync($url, [
   					  'json' => 	$order
						]);


// 			  	$order = array (
// 							    "email" => "kanishkas@99x.lk",
// 							    "fulfillment_status" => "unfulfilled",
// 							    "line_items" => [
// 							      [
// 							          "variant_id" => 42837938757,
// 							          "quantity" => 5
// 							      ]
// 							    ]
// 							);

// 				$headers = [

// 				   'Accept' => 'application/json',

// 				   'Content-Type' => 'application/json'
				   
// 				];

// 		 		$url 		=  'https://3d7b2f6a83f57bc4d0abb14205942ef5:b04081ebe8a2849ed05f0decc4606e1e@saaraketha-organics.myshopify.com/admin/orders.json';
// 		 		$client 	= new Client();

// 		 		$res = $client->post($url, [
//    					 'headers' => $headers, 
//   					  'json' => 	$order
// 						]);

// 		 		file_put_contents("php://stderr", "sending push !!!".PHP_EOL);
// echo $res->getStatusCode();
		 		//$result = $res->getBody();

		 		//file_put_contents("php://stderr",$result.PHP_EOL);
	  
				//file_put_contents("php://stderr",json_decode((string)$res->getBody(),true).PHP_EOL);

//file_put_contents("php://stderr","error log".PHP_EOL);

	 		// $url 		= 'https://3d7b2f6a83f57bc4d0abb14205942ef5:b04081ebe8a2849ed05f0decc4606e1e@saaraketha-organics.myshopify.com/admin/orders.json';
	   //  	$client 	= new Client();
	   //  //	$data = 		   json_decode({"order":{ "email":"kanishkas@99x.lk","line_items":[{"variant_id":42837938757,"quantity":1}]}}, true);
	   //      $res 		= $client->request('POST', $url , [ 
				// 	        	 						 //  'form_params' =>
	   //      														//		[
				// 	        	 											'order' => [
				// 	                              										"email" => 'kanishkas@99x.lk',
				// 	                              										"line_items"=>[["variant_id"=> 42837938757,  "quantity"=> 2 ]]                
				// 	                  												   ]
				// 	                  									// ]
					        	 				

				// 	        	 						  // [{"order":{"line_items":[{"variant_id":42837938757,"quantity":1}],"email":"jane@example.com"}}]
	   //      										      ]
	   //      						   );


				// // $request = new HttpRequest();
				// // $request->setUrl('https://3d7b2f6a83f57bc4d0abb14205942ef5:b04081ebe8a2849ed05f0decc4606e1e@saaraketha-organics.myshopify.com/admin/orders.json');
				// // $request->setMethod(HTTP_METH_POST);

				// // $request->setHeaders(array(
				// //   'postman-token' => '8a8ec5bf-bf9f-c12b-4e07-8871c6cc6fab',
				// //   'cache-control' => 'no-cache',
				// //   'content-type' => 'application/json'
				// //   //'authorization' => 'Basic M2Q3YjJmNmE4M2Y1N2JjNGQwYWJiMTQyMDU5NDJlZjU6YjA0MDgxZWJlOGEyODQ5ZWQwNWYwZGVjYzQ2MDZlMWU='
				// // ));

				// // $request->setBody('{"order":
				// // { "email":"kanishkas@99x.lk","line_items":[{"variant_id":42837938757,"quantity":1}]}
				// // }');

				// // try {
				// //   $response = $request->send();

				// //   echo $response->getBody();
				// // } catch (HttpException $ex) {
				// //   echo $ex;
				// // }
    // }



		// $packet = '{"order":{ "email":"kanishkas@99x.lk","line_items":[{"variant_id":42837938757,"quantity":1}]} }';
		// $client = new Client();

		// try
		// 	{
		// 	$request = $client->post('https://3d7b2f6a83f57bc4d0abb14205942ef5:b04081ebe8a2849ed05f0decc4606e1e@mydomain.myshopify.com/admin/orders.json', null, $packet);
		// 	$request->setHeader("Content-Type", "application/json");
		// 	$response = $request->send();
		// 	$data = $response->getBody(true);
		// 	file_put_contents("php://stderr",$response .PHP_EOL);

		// 	}
		// catch(Exception $e)
		// 	{
		// 		//echo '###########';
		// 	echo $e->getMessage();
					
		
		// 	}

	}

}


