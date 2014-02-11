<?php

namespace uifarm\wp;

use uifarm\rest\netwalk\NetwalkConstants as NetwalkConstants;

class Debug {

	static function isDebugMode() {

		$debugMode = self::getDebugMode();
		if( $debugMode === "1" ) {
			return true;
		}
		return false;

	}

	private static function getDebugMode() {

		return get_option( NetwalkConstants::WP_SETTING_NETWALK_DEBUG_MODE );

	}

}

?>