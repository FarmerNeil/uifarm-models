<?php

namespace uifarm\controller\netwalk;

use uifarm\rest\netwalk\NetwalkREST as NetwalkREST;
use uifarm\wp\Debug as Debug;

abstract class BaseNetwalkController {

    private $netwalkAPI;
    private $view;
    private $cacheFileName;

    function __construct() {
        $this->setup();
    }

    public function getNetwalkAPI() {
        return $this->netwalkAPI;
    }

    public function setNetwalkAPI($netwalkAPI=null) {
        $this->netwalkAPI = $netwalkAPI;
    }

    public function getView() {
        return $this->view;
    }

    public function setView($view=null) {
        $this->view = $view;
    }

    public function getCacheFileName() {
        return $this->cacheFileName;
    }

    public function setCacheFileName($cacheFileName=null) {
        $this->cacheFileName = $cacheFileName;
    }

    public function executeAction() {

        $jsonResponse = "";

        // Save to a file
        $cacheDir = Debug::isDebugMode() ? 'debug' : 'cache';
        $fileName = LIBPATH . $cacheDir . '/' . $this->getCacheFileName();

        if( Debug::isDebugMode() ) {

            $json = file_get_contents( $fileName );
            $jsonResponse = json_decode( $json );

        } else {

            if( !file_exists( $fileName ) ) {

                $jsonResponse = $this->getNetwalkDataAndWriteResponse( $fileName );

            } else {

                $cachetime = 60 * 60 * 24; // 24hrs
                if ( ( time() - $cachetime ) < filemtime( $fileName ) ) {

                    // Cache file exists
                    $json = file_get_contents( $fileName );
                    if( $json === 'null' || $json === null ) {
                        $jsonResponse = $this->getNetwalkDataAndWriteResponse( $fileName );
                    } else {
                        $jsonResponse = json_decode( $json );
                    }

                } else {

                    $jsonResponse = $this->getNetwalkDataAndWriteResponse( $fileName );

                }

            }

        }

        // Populate view object
        $this->setView( $this->populateView( $jsonResponse ) );

        return $this->getView();

    }

    public function getNetwalkDataAndWriteResponse( $fileName ) {

        // Connect to Netwalk API
        $jsonResponse = $this->processNetwalk();

        // Write JSON response to a file
        $file = fopen( $fileName, 'w+' );
        $json = json_encode( $jsonResponse );
        fwrite( $file, $json );
        fclose( $file );

        return $jsonResponse;

    }

    public function processNetwalk() {
        $netwalkREST = new NetwalkREST( $this->getNetwalkAPI() );
        return $netwalkREST->execute();
    }

    abstract function populateView( $data );

    abstract function setup();

}

?>