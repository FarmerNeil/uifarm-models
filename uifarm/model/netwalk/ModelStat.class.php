<?php

namespace uifarm\model\netwalk;

class ModelStat {

	private $statName;
	private $statValue;

	function __construct($statName,$statValue) {
        $this->statName = $statName;  
        $this->statValue = $statValue;
    }

    public function getStatName() {
        return ucwords($this->statName);
    }

    public function setStatName($statName=null) { 
        $this->statName = $statName; 
    } 

    public function getStatValue() {
        return ucwords($this->statValue);
    }

    public function setStatValue($statValue=null) { 
        $this->statValue = $statValue; 
    } 

}

?>