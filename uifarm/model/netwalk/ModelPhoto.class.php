<?php

namespace uifarm\model\netwalk;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;
use uifarm\rest\netwalk\NetwalkHelper as NetwalkHelper;
use uifarm\wp\Debug as Debug;

class ModelPhoto {

    private $imageSrc;
    private $imageWidth;
    private $imageHeight;
    private $credit;

    function __construct($imageSrc,$imageWidth,$imageHeight,$credit) {
        $this->imageSrc = $imageSrc;
        $this->imageWidth = $imageWidth;
        $this->imageHeight = $imageHeight;
        $this->credit = $credit;
    }

    public function getImageSrc() {
        if( Debug::isDebugMode() ) {
            return NetwalkConstants::NETWALK_API_DEBUG_MODEL_THUMB_URL;
        }
        return $this->imageSrc;
    }

    public function setImageSrc($imageSrc=null) {
        $this->imageSrc = $imageSrc;
    }

    public function getImageWidth() {
        return $this->imageWidth;
    }

    public function setImageWidth($imageWidth=null) {
        $this->imageWidth = $imageWidth;
    }

    public function getImageHeight() {
        return $this->imageHeight;
    }

    public function setImageHeight($imageHeight=null) {
        $this->imageHeight = $imageHeight;
    }

    public function getCredit() {
        return $this->credit;
    }

    public function setCredit($credit=null) {
        $this->credit = $credit;
    }

    public function __toString() {
        return
            'imageSrc:' . $this->imageSrc . '\n' .
            'imageWidth:' . $this->imageWidth . '\n' .
            'imageHeight:' . $this->imageHeight . '\n' .
            'credit:' . $this->credit;
    }

}

?>
