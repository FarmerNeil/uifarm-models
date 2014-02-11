<?php

namespace uifarm\rest\netwalk;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;
use uifarm\rest\REST as REST;
use uifarm\wp\Debug as Debug;

class NetwalkREST extends REST {

	private $restAPICall;
	private $data;

	function __construct($restAPICall) {
    	$this->restAPICall = $restAPICall;
 	}

	public function getRestAPICall() {
        return $this->restAPICall;
    }

    public function setRestAPICall($restAPICall=null) {
        $this->restAPICall = $restAPICall;
    }

    public function getData() {
    	if( $this->data == null ) {
    		$this->setData( array( NetwalkConstants::NETWALK_PASSWORD_NAME => get_option( NetwalkConstants::NETWALK_PASSWORD_VALUE ) ) );
    	}
        return $this->data;
    }

    public function setData($data=null) {
        $this->data = $data;
    }

	public function getURL() {
		if( Debug::isDebugMode() ) {
			return WP_SITEURL . $this->getRestAPICall();
		}
		return NetwalkHelper::getBaseURL() . $this->getRestAPICall();
	}

}

?>
