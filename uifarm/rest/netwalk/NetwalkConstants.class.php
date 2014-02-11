<?php

namespace uifarm\rest\netwalk;

class NetwalkConstants {

	const NETWALK_PASSWORD_NAME = "password";
	const NETWALK_PASSWORD_VALUE = "netwalk_api_password";

	const NETWALK_LABEL_CREDIT = "Photo by:";
	const NETWALK_LABEL_SECONDARY_BOOK_TITLE = "Polaroids";

	const NETWALK_BOOK_TYPE_MAIN = 0;
	const NETWALK_BOOK_TYPE_POLAROIDS = 1;

	const NETWALK_API_DEBUG_MODEL_THUMB_URL = "/lib/debug/model_thumb.jpg";
	const NETWALK_API_DEBUG_MODEL_FILENAME = "model.json";

	const NETWALK_CACHE_ALLMODELS = "models-dept-1-all.json";
	const NETWALK_CACHE_MODEL_PREFIX = "model-";
	const NETWALK_CACHE_MODEL_SUFFIX = ".json";

	const MODELS_PER_VIEW_MOBILE = 6;
	const MODELS_PER_VIEW_TABLET = 14;
	const MODELS_PER_VIEW_DEFAULT = 21;

	const MODEL_URL_PREFIX = "model/";

	const WP_SETTING_NETWALK_API_URL = "netwalk_api_url";
	const WP_SETTING_NETWALK_API_ALL_MODELS = "netwalk_api_url_all_models";
	const WP_SETTING_NETWALK_API_MODEL_BOOK = "netwalk_api_url_model_book";
	const WP_SETTING_NETWALK_DEBUG_MODE = "netwalk_api_debug";

}

?>
