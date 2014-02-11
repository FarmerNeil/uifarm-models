<?php

namespace uifarm\model\netwalk;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;
use uifarm\rest\netwalk\NetWalkHelper as NetWalkHelper;

class ModelListing extends ModelPhoto {

    private $firstName;
    private $lastName;
    private $modelId;
    public $displayName;
    public $pageURL;
    public $photoImageURL;
    public $debug;

    function __construct($imageSrc,$firstName,$lastName,$modelId,$debug=null) {
        parent::__construct($imageSrc,null,null,null);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->modelId = $modelId;
        $this->displayName = $this->getFullName();
        $this->pageURL = $this->getModelURL();
        $this->photoImageURL = $this->getImageSrc();
        $this->debug = $debug;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName=null) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName=null) {
        $this->lastName = $lastName;
    }

    public function getModelId() {
        return $this->modelId;
    }

    public function setModelId($modelId=null) {
        $this->modelId = $modelId;
    }

    public function getFullName() {
        return NetWalkHelper::getFullName( $this->getFirstName(), $this->getLastName() );
    }

    private function getFullNameURL() {
        return strtolower($this->getFirstName()) . '-' .strtolower($this->getLastName());
    }

    public function getModelURL() {
        return NetwalkConstants::MODEL_URL_PREFIX . $this->getModelId() . '/' . $this->getFullNameURL() .'/';
    }

}

?>