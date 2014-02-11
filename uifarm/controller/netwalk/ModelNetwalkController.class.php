<?php

namespace uifarm\controller\netwalk;

use uifarm\model\netwalk\Model as Model;
use uifarm\model\netwalk\ModelResponse as ModelResponse;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;
use uifarm\rest\netwalk\NetwalkHelper as NetwalkHelper;

use uifarm\wp\Debug as Debug;

class ModelNetwalkController extends BaseNetwalkController {

    public function setup() {
        $this->setNetwalkAPI( NetwalkHelper::getModelAPI() );
        $this->setCacheFileName( $this->getCacheFileName() );
    }

    public function getCacheFileName() {
        if( Debug::isDebugMode() ) {
            return NetwalkConstants::NETWALK_API_DEBUG_MODEL_FILENAME;
        }
        return NetwalkConstants::NETWALK_CACHE_MODEL_PREFIX .
            NetwalkHelper::getModelId() .
            NetwalkConstants::NETWALK_CACHE_MODEL_SUFFIX;
    }

    public function populateView( $data ) {
        if( !isset( $data->id ) ) {
            return new ModelResponse( 'ERR_MSG_MODEL', false );
        }
        return new Model( $data );
    }

}

?>