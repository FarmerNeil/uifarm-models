<?php

namespace uifarm\model\netwalk;

class BaseModel {

	private $data;

    function __construct($data) {
        $this->data = $data;  
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data=null) { 
        $this->data = $data; 
    } 

}

?>