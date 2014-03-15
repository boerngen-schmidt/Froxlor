<?php

class Welcome_IndexSuccessView extends FroxlorWelcomeBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		// we load a "simple" layout with just one template layer
		// as this is a special welcome page, completely standalone
		$this->setupHtml($rd, 'simple');
		
		$this->setAttribute('agavi_release', AgaviConfig::get('agavi.release'));
		$this->setAttribute('warn_display_errors', !ini_get('display_errors'));
		$this->setAttribute('php_ini_path', function_exists('php_ini_loaded_file') ? php_ini_loaded_file() : null); // 5.2.3 and later
		$this->setAttribute('recommended_error_reporting', version_compare(PHP_VERSION, '5.4', '<') ? 'E_ALL | E_STRICT' : 'E_ALL'); // 5.4 and up have E_STRICT included in E_ALL
	}
}

?>