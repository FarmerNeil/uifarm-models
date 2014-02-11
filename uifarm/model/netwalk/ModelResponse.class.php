<?php

namespace uifarm\model\netwalk;

class ModelResponse {

    public $responseMsg;
    public $moreModels;

    function __construct($responseMsg,$moreModels) {
        $this->responseMsg = $responseMsg; 
        $this->moreModels = $moreModels; 
    }

    public function getResponseMsg() {
        return $this->responseMsg;
    }

    public function setResponseMsg($responseMsg=null) { 
        $this->responseMsg = $responseMsg; 
    } 

    public function isMoreModels() {
        return $this->moreModels;
    }

    public function setMoreModels($moreModels=null) { 
        $this->moreModels = $moreModels; 
    } 

}

?>