<?php

namespace uifarm\web;

class WebHelper {

	public static function isError( $object ) {
		return strrpos( get_class( $object ), "ModelResponse" );
	}

}

?>