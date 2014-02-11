<?php

namespace uifarm\rest;

abstract class REST {

	private $responseType = 'JSON';

 	public function getResponseType() {
        return $this->responseType;
    }

    public function setResponseType($responseType=null) {
        $this->responseType = $responseType;
    }

	abstract function getURL();

	abstract function getData();

	private function executeGet() {

		$ch=curl_init($this->getURL());
		$curl_post_data = $this->getData();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
		$response=curl_exec($ch);
		curl_close($ch);

		echo 'RESPONSE:' . $response;

		return $response;

	}

	private function getJSONResponse($response) {
		return json_decode($response);
	}

	public function execute() {

		// Call API
		$response = $this->executeGet();

		// Get JSON
		if( 'JSON' == $this->getResponseType() )
			$response = $this->getJSONResponse($response);

		return $response;

	}

}

?>