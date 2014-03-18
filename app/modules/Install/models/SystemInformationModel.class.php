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
class Install_SystemInformationModel extends FroxlorInstallBaseModel {
	/**
	 * get/guess servername
	 */
	public function guessServerName() {
		if (! empty ( $_SERVER ['SERVER_NAME'] )) {
			// no ips
			if ($this->_validate_ip ( $_SERVER ['SERVER_NAME'] ) == false) {
				return  $_SERVER ['SERVER_NAME'];
			}
		}
		// empty
		return '';
	}
	
	/**
	 * get/guess serverip
	 */
	public function guessServerIP() {
		if (! empty ( $_SERVER ['SERVER_ADDR'] )) {
			return $this->_validate_ip( $_SERVER ['SERVER_ADDR']);
		}
		// empty
		return '';
	}
	
	/**
	 * get/guess webserver-software
	 */
	public function guessWebserver() {
		if (strtoupper ( @php_sapi_name () ) == "APACHE2HANDLER" || stristr ( $_SERVER ['SERVER_SOFTWARE'], "apache/2" )) {
			return 'apache2';
		} elseif (substr ( strtoupper ( @php_sapi_name () ), 0, 8 ) == "LIGHTTPD" || stristr ( $_SERVER ['SERVER_SOFTWARE'], "lighttpd" )) {
			return 'lighttpd';
		} elseif (substr ( strtoupper ( @php_sapi_name () ), 0, 8 ) == "NGINX" || stristr ( $_SERVER ['SERVER_SOFTWARE'], "nginx" )) {
			return 'nginx';
		} else {
			// we don't need to bail out, since unknown does not affect any critical installation routines
			return 'unknown';
		}
	}
	
	/**
	 * check whether the given parameter is an ip-address or not
	 *
	 * @param string $ip
	 *
	 * @return boolean|string
	 */
	private function _validate_ip($ip = null) {
		if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false
		&& filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false
		&& filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) === false
		) {
			return false;
		}
		return $ip;
	}
	
	public function guessHttpUsername() {
		if (extension_loaded('posix')) {
			$posixusername = posix_getpwuid(posix_getuid());
			return $posixusername['name'];
		}
	}
	
	public function guessHttpGroupname() {
		if (extension_loaded('posix')) {
			$posixgroup = posix_getgrgid(posix_getgid());
			return $posixgroup['name'];
		}
		return '';
	}
}

?>