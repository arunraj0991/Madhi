<?php

class MYHTTPCLIENT
{
	

	
	// Create the http client
	public static function sendPost($dataToBot)
	{
		include_once APPPATH.'/vendor/autoload.php';
		
		if(true)
		{
			$client = new \GuzzleHttp\Client();
			$client->post( URL_TO_SEND_DATA, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => json_encode($dataToBot)
			]);
			
		
			
		}
		
	}
	

}

?>