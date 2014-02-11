<?php

namespace uifarm\controller\netwalk;

use uifarm\model\netwalk\ModelResponse as ModelResponse;
use uifarm\model\netwalk\AllModels as AllModels;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;
use uifarm\rest\netwalk\NetwalkHelper as NetwalkHelper;

class AllModelsNetwalkController extends BaseNetwalkController {

    public function setup() {

        $this->setNetwalkAPI( NetwalkHelper::getAllModelsAPI() );

        $this->setCacheFileName( NetwalkConstants::NETWALK_CACHE_ALLMODELS );

    }

    public function populateView( $data ) {

    	if( isset( $data->Message ) ) {
    		return new ModelResponse( $data->Message, false );
    	}
    	return new AllModels( $data );

    }

}

?>
