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

class Install_SettingsAction extends FroxlorInstallBaseAction
{
	

	/**
	 * Handles the Write request method.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>^
	 */
	public function executeWrite(AgaviRequestDataHolder $rd)
	{
		/* @var $cfg Install_ConfigurationBuilderModel */
		$cfg = $this->context->getModel('ConfigurationBuilder', 'Install');
		
		// first we try changing the default database.xml
	
		if (is_writable($filename)(AgaviConfig::get('%core.app_dir%').'/config/database.xml')
			&& is_writable(AgaviConfig::get('%core.app_dir%').'/config/setting.xml')) {
			$doc = new DOMDocument();
			$doc->load(AgaviConfig::get('%core.app_dir%').'/config/database.xml');
			$cfg->changeDatabaseXml($doc);
			
			$doc = new DOMDocument();
			$doc->load(AgaviConfig::get('%core.app_dir%').'/config/settings.xml');
			$cfg->enableDatabase($doc);
			return 'Success';
		} elseif ($cfg->writeToTmpFile()) {
			return 'Manual';
		} else {
			return 'Error';
		}
	}
	
	/**
	 * Handles the Read request method.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>^
	 */
	public function executeRead(AgaviRequestDataHolder $rd)
	{
		return 'Input';
	}
	
	/**
	 * Returns the default view if the action does not serve the request
	 * method used.
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>
	 */
	public function getDefaultViewName()
	{
		return 'Success';
	}
}

?>