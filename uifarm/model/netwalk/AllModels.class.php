<?php

namespace uifarm\model\netwalk;

use uifarm\wp\Debug as Debug;
use uifarm\helper\MobileDetect as MobileDetect;
use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;

class AllModels extends BaseModel {

    public function getModelsForSelectMenu() {

        $models = array();
        try {
            foreach ( $this->getData() as $model ) {
                $imagePath = $model->coverImgAlt->thumb;
                $firstName = $model->fname;
                $lastName = $model->lname;
                $modelId = $model->id;
                array_push( $models, new ModelListing( $imagePath, $firstName, $lastName, $modelId, $this->getDebug() ) );
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        return $models;

    }

    public function getAllModelsList() {

        $models = array();
    	try {

            $responseObj = new ModelResponse( 'OK', $this->isShowLoadMoreLink());
            array_push( $models, $responseObj );

            foreach ( $this->getModelDataArr() as $model ) {
                $imagePath = $model->cover;
                $firstName = $model->fname;
                $lastName = $model->lname;
                $modelId = $model->id;
                array_push( $models, new ModelListing( $imagePath, $firstName, $lastName, $modelId, $this->getDebug() ) );
            }

    	} catch(Exception $e) {
    		echo $e->getMessage();
    	}
    	return $models;

    }

    private function getDebug() {

        $debug = "";

        /*$debug = "View ID: " . $_REQUEST['viewId'];

        $debug = $debug . "Req Type: " . $_REQUEST['reqType'];

        $debug = $debug . "Start Index: " . $this->getStartIndex();

        $debug = $debug . "End Index: " . $this->getEndIndex();*/

        return $debug;

    }

    private function getMaxCount() {
        $detect = new MobileDetect;
        $count = NetwalkConstants::MODELS_PER_VIEW_DEFAULT;
        if( $detect->isMobile() && !$detect->isTablet() ) {
            $count = NetwalkConstants::MODELS_PER_VIEW_MOBILE;
        } else if( $detect->isTablet() ) {
            $count = NetwalkConstants::MODELS_PER_VIEW_TABLET;
        }
        return $count;
    }

    private function getCount() {
        return count( $this->getData() );
    }

    public function getModelDataArr() {

        $maxCount = $this->getMaxCount();
        $total = $this->getCount();
        $start = $this->getStartIndex();

        /*
        NON AJAX
        $viewId = $this->getViewId();
        if( $viewId == 0 ) $viewId = 1;

        $end = $viewId * $maxCount;
        if( $end > $total ) $end = $total;*/

        $end = $this->getEndIndex();

        $modelsArr = array();
        $outputArr = array_slice( $this->getData(), $start, $maxCount );
        return $outputArr;

    }

    private function getEndIndex() {
        return $this->getStartIndex() + $this->getMaxCount();
    }

    private function getStartIndex() {

        $startIndex = 0;
        if( $this->isAJAXRequest() ) {
            $viewId = $this->getViewId();
            if( $viewId  != 0 ) {
               $startIndex = $viewId * $this->getMaxCount();
            }
        }
        return $startIndex;

    }

    private function isAJAXRequest() {
        $isAJAXRequest = false;
        if ( isset( $_REQUEST['reqType'] ) ) {
            if( $_REQUEST['reqType'] == 0 ) {
                $isAJAXRequest = true;
            }
        }
        return $isAJAXRequest;
    }

    private function getViewId() {

        $viewId = 0;
        if ( isset( $_REQUEST['viewId'] ) && !empty( $_REQUEST['viewId'] ) ) {
            $viewId = $_REQUEST['viewId'];
        }
        return $viewId;

    }

    public function getLoadMoreLink() {

        echo $this->getViewId();

    }

    public function isShowLoadMoreLink() {

        if( ( $this->getStartIndex() + $this->getMaxCount() ) > $this->getCount() ) {
            return false;
        }
        return true;

    }

}

?>
