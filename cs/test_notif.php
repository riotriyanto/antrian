<?php

	function sendMessage(){
		$content = array(
			"en" => 'test antrian'
			);
		
		$fields = array(
			'app_id' => "8d27ea3b-d95e-4013-af96-0119e06e7f92",
			'include_player_ids' => array("babd8521-f40e-42b9-9b01-896b7008cfc1"),
			'data' => array("foo" => "bar"),
			'contents' => $content
		);
		
		$fields = json_encode($fields);
    	print("\nJSON sent:\n");
    	print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
	print("\n");
?>