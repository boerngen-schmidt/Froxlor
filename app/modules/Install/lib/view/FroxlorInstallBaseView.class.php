<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2003-2009 the SysCP Team (see authors).
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Florian Lippert <flo@syscp.org> (2003-2009)
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Install
 *
 */
 
/**
 * The base view from which all Install module views inherit.
 */
class FroxlorInstallBaseView extends FroxlorBaseView
{
	public function initialize(AgaviExecutionContainer $container) {
		parent::initialize($container);
		$parameters = array(
			'http_headers' => array (
				'Cache-Control' => 'no-store, no-cache, must-revalidate',
				'Pragma' => 'no-cache',
				'Last-Modified' =>  gmdate( 'D, d M Y H:i:s \G\M\T', time()),
				'Expires' => gmdate( 'D, d M Y H:i:s \G\M\T', time())
			)
		);
		$container->getOutputType()->setParameters($parameters);
		
		// Set a timezone if
		if (function_exists("date_default_timezone_set")
			&& function_exists("date_default_timezone_get")
			)
		{
			@date_default_timezone_set(@date_default_timezone_get());
		}
	}
	
	
	public function setupHtml(AgaviRequestDataHolder $rd, $layoutName = 'install') {
		parent::setupHtml($rd, $layoutName);
	}	
}

?>