<?php

namespace uifarm\rest\netwalk;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;

use uifarm\wp\Debug as Debug;

class NetwalkHelper {

	public static function getModelId() {
		$modelId = self::getId();
		if( strlen( $modelId ) === 0 ) {
    			$modelId = 0;
		} else {
			$modelId = preg_replace("/[^0-9]+/", "", $modelId);
		}
		return $modelId;
	}

	public static function getId() {
		return get_query_var( 'id' );
	}

	public static function getBaseURL() {
		$baseURL = get_option( NetwalkConstants::WP_SETTING_NETWALK_API_URL );
		$baseURLPrefix = "http://";
		if( strpos( $baseURL, $baseURLPrefix ) === 0 ) {
			return $baseURL;
		}
		return $baseURLPrefix . $baseURL;
	}

	public static function getModelAPI() {
		$modelBookAPI = get_option( NetwalkConstants::WP_SETTING_NETWALK_API_MODEL_BOOK );
		if( strpos( $modelBookAPI, "/" ) !== 0 )
			$modelBookAPI = "/" . $modelBookAPI;
		if( substr( $modelBookAPI, -strlen( "/" ) ) !== "/" )
			$modelBookAPI .= "/";
		return $modelBookAPI . self::getModelId();
	}

	public static function getAllModelsAPI() {
		$allModelsAPI = get_option( NetwalkConstants::WP_SETTING_NETWALK_API_ALL_MODELS );
		if( strpos( $allModelsAPI, "/" ) === 0 ) {
			return $allModelsAPI;
		}
		return "/" . $allModelsAPI;
	}

	public static function getFullName( $firstName, $lastName ) {
		return strtoupper(strtolower($firstName)).' '.ucwords(strtolower($lastName));
	}

}

?>