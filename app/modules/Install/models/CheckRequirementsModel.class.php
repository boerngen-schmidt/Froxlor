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
 * @author     Benjamin Börngen-Schmidt <benjamin@froxlor.org>
 * @author     Florian Lippert <flo@syscp.org> (2003-2009)
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Install
 *
 */
 
class Install_CheckRequirementsModel extends FroxlorInstallBaseModel
{
	public function checkAllRequirements() {
		return ($this->checkMustRequirements() && $this->checkOptionalRequirements());
	}
	
	public function checkOptionalRequirements() {
		return ($this->checkOpenbasedir()
				&& $this->checkPhpBcmath()
				&& $this->checkPhpCurl()
				&& $this->checkPhpPosix()
		);
	}
	
	public function checkMustRequirements() {
		return ($this->checkMagicQuotes()
				&& $this->checkPdo()
				&& $this->checkPhp()
				&& $this->checkPhpFilter()
				&& $this->checkPhpXml()
		);
	}
	
	public function checkPhp($version = "5.3.0") {
		return version_compare(PHP_VERSION, $version, ">=");
	}
	
	public function checkMagicQuotes() {
		if (get_magic_quotes_runtime()) {
			// deactivate it
			set_magic_quotes_runtime(false);
			return false;
		} else {
			return true;
		}
	}
	
	public function checkPdo() {
		return (extension_loaded('pdo') || in_array("mysql", PDO::getAvailableDrivers()) == true);
	}
	
	public function checkPhpXml() {
		return extension_loaded('xml');
	}

	public function checkPhpFilter() {
		return extension_loaded('filter');
	}
	
	// check for posix-extension
	public function checkPhpPosix() {
		return extension_loaded('posix');
	}
	
	// check for bcmath extension
	public function checkPhpBcmath() {
		return extension_loaded('bcmath');
	}
	
	// check for curl extension
	public function checkPhpCurl() {
		return extension_loaded('curl');
	}
	
	// check for open_basedir
	public function checkOpenbasedir() {
		$php_ob = @ini_get("open_basedir");
		return (empty($php_ob) && $php_ob == '');
	}
}

?>