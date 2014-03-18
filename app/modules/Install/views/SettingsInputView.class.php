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
 
class Install_SettingsInputView extends FroxlorInstallBaseView
{
	

	/**
	 * Handles the Html output type.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>An AgaviExecutionContainer to forward the execution to or</li>
	 *                     <li>Any other type will be set as the response content.</li>
	 *                   </ul>
	 */
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('title', 'Settings');
		/* @var $mSysinfo Install_SystemInformationModel */
		$mSysinfo = $this->context->getModel('SystemInformation', 'Install');
		
		$form = new AgaviParameterHolder(array(
				'mysql_host' => "127.0.0.1",
				'mysql_database' => 'froxlor',
				'mysql_unpriv_user' => 'froxlor',
				'mysql_root_user' => 'root',
				'admin_user' => 'admin',
				'servername' => $mSysinfo->guessServerName(),
				'serverip' => $mSysinfo->guessServerIP(),
				'httpuser' => $mSysinfo->guessHttpUsername(),
				'httpgroup' => $mSysinfo->guessHttpGroupname(),
		));
		$this->getContext()->getRequest()->setAttribute('populate', array('settings' => $form), 'org.agavi.filter.FormPopulationFilter');
	}
}

?>