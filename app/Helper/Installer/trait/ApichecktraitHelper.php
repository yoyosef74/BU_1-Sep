<?php

namespace App\Helper\Installer\trait;

use App\Helper\Curl;

trait ApichecktraitHelper
{
    /**
	 * IMPORTANT: Do not change this part of the code to prevent any data losing issue.
	 *
	 * @param $purchaseCode
	 * @return false|mixed|string
	 */

    private function purchaseCodeChecker($purchaseCode)
	{
       return true;
	}


	private function purchaseCodecreate($purchaseCodes, $url,$license,$buyer,$author)
	{
		// A sample PHP Script to POST data using cURL
		// Data in JSON format
		$data = array(
			'purchaseCode' => $purchaseCodes,
            'url' => $url,
            'license' => $license,
            'buyer' => $buyer,
            'author' => $author,
		);
		
		$payload = json_encode($data);

		// Prepare new cURL resource
		$ch = curl_init('https://panel.spruko.com/api/api/apicreate');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		
		// Set HTTP Header for POST request 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($payload))
		);
		
		// Submit the POST request
		$result = curl_exec($ch);
		

		// Close cURL session handle
		curl_close($ch);

		// Format object data
		$result = json_decode($result);
		return $result;
	}


	private function purchaseCodecheckingapi($purchaseCodes)
	{	
return true;
	}
}