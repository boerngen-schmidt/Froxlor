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
 
class Install_DatabaseBuilderModel extends FroxlorInstallBaseModel
{
	
	/**
	 * create corresponding entries in froxlor database
	 *
	 * @param object $db
	 *
	 * @return string status messages
	 */
	private function _doDataEntries(&$db) {
	
		$content = "";
	
		$content .= $this->_status_message('begin', $this->_lng['install']['creating_entries']);
	
		// and lets insert the default ip and port
		$stmt = $db->prepare("
				INSERT INTO `".TABLE_PANEL_IPSANDPORTS."` SET
				`ip`= :serverip,
				`port` = '80',
				`namevirtualhost_statement` = '1',
				`vhostcontainer` = '1',
				`vhostcontainer_servername_statement` = '1'
				");
		$stmt->execute(array('serverip' => $this->_data['serverip']));
		$defaultip = $db->lastInsertId();
	
		// insert the defaultip
		$upd_stmt = $db->prepare("
				UPDATE `".TABLE_PANEL_SETTINGS."` SET
				`value` = :defaultip
				WHERE `settinggroup` = 'system' AND `varname` = 'defaultip'
				");
		$upd_stmt->execute(array('defaultip' => $defaultip));
	
		$content .= $this->_status_message('green', 'OK');
	
		//last but not least create the main admin
		$content .= $this->_status_message('begin', $this->_lng['install']['adding_admin_user']);
		$ins_data = array(
				'loginname' => $this->_data['admin_user'],
				'password' => md5($this->_data['admin_pass1']),
				'email' => 'admin@' . $this->_data['servername'],
				'deflang' => $this->_languages[$this->_activelng]
		);
		$ins_stmt = $db->prepare("
				INSERT INTO `" . TABLE_PANEL_ADMINS . "` SET
				`loginname` = :loginname,
				`password` = :password,
				`name` = 'Froxlor-Administrator',
				`email` = :email,
				`def_language` = :deflang,
				`customers` = -1,
				`customers_see_all` = 1,
				`caneditphpsettings` = 1,
				`domains` = -1,
				`domains_see_all` = 1,
				`change_serversettings` = 1,
				`diskspace` = -1024,
				`mysqls` = -1,
				`emails` = -1,
				`email_accounts` = -1,
				`email_forwarders` = -1,
				`email_quota` = -1,
				`ftps` = -1,
				`tickets` = -1,
				`tickets_see_all` = 1,
				`subdomains` = -1,
				`traffic` = -1048576
				");
	
		$ins_stmt->execute($ins_data);
	
		$content .= $this->_status_message('green', 'OK');
	
		return $content;
	}
	
	/**
	 * change settings according to users input
	 *
	 * @param object $db
	 *
	 * @return string status messages
	 */
	private function _doSettings(&$db) {
	
		$content = "";
	
		$content .= $this->_status_message('begin', $this->_lng['install']['changing_data']);
		$upd_stmt = $db->prepare("
				UPDATE `" . TABLE_PANEL_SETTINGS . "` SET
				`value` = :value
				WHERE `settinggroup` = :group AND `varname` = :varname
				");
	
		$this->_updateSetting($upd_stmt, 'admin@' . $this->_data['servername'], 'panel', 'adminmail');
		$this->_updateSetting($upd_stmt, $this->_data['serverip'], 'system', 'ipaddress');
		$this->_updateSetting($upd_stmt, $this->_data['servername'], 'system', 'hostname');
		$this->_updateSetting($upd_stmt, $this->_languages[$this->_activelng], 'panel', 'standardlanguage');
		$this->_updateSetting($upd_stmt, $this->_data['mysql_access_host'], 'system', 'mysql_access_host');
		$this->_updateSetting($upd_stmt, $this->_data['webserver'], 'system', 'webserver');
		$this->_updateSetting($upd_stmt, $this->_data['httpuser'], 'system', 'httpuser');
		$this->_updateSetting($upd_stmt, $this->_data['httpgroup'], 'system', 'httpgroup');
	
		// necessary changes for webservers != apache2
		if ($this->_data['webserver'] == "lighttpd") {
			$this->_updateSetting($upd_stmt, '/etc/lighttpd/conf-enabled/', 'system', 'apacheconf_vhost');
			$this->_updateSetting($upd_stmt, '/etc/lighttpd/froxlor-diroptions/', 'system', 'apacheconf_diroptions');
			$this->_updateSetting($upd_stmt, '/etc/lighttpd/froxlor-htpasswd/', 'system', 'apacheconf_htpasswddir');
			$this->_updateSetting($upd_stmt, '/etc/init.d/lighttpd reload', 'system', 'apachereload_command');
			$this->_updateSetting($upd_stmt, '/etc/lighttpd/lighttpd.pem', 'system', 'ssl_cert_file');
			$this->_updateSetting($upd_stmt, '/var/run/lighttpd/', 'phpfpm', 'fastcgi_ipcdir');
		} elseif ($this->_data['webserver'] == "nginx") {
			$this->_updateSetting($upd_stmt, '/etc/nginx/sites-enabled/', 'system', 'apacheconf_vhost');
			$this->_updateSetting($upd_stmt, '/etc/nginx/sites-enabled/', 'system', 'apacheconf_diroptions');
			$this->_updateSetting($upd_stmt, '/etc/nginx/froxlor-htpasswd/', 'system', 'apacheconf_htpasswddir');
			$this->_updateSetting($upd_stmt, '/etc/init.d/nginx reload', 'system', 'apachereload_command');
			$this->_updateSetting($upd_stmt, '/etc/nginx/nginx.pem', 'system', 'ssl_cert_file');
			$this->_updateSetting($upd_stmt, '/var/run/nginx/', 'phpfpm', 'fastcgi_ipcdir');
		}
	
		// insert the lastcronrun to be the installation date
		$this->_updateSetting($upd_stmt, time(), 'system', 'lastcronrun');
	
		// set specific times for some crons (traffic only at night, etc.)
		$ts = mktime(0, 0, 0, date('m', time()), date('d', time()), date('Y', time()));
		$db->query("UPDATE `".TABLE_PANEL_CRONRUNS."` SET `lastrun` = '".$ts."' WHERE `cronfile` ='cron_traffic.php';");
		$ts = mktime(1, 0, 0, date('m', time()), date('d', time()), date('Y', time()));
		$db->query("UPDATE `".TABLE_PANEL_CRONRUNS."` SET `lastrun` = '".$ts."' WHERE `cronfile` ='cron_used_tickets_reset.php';");
		$db->query("UPDATE `".TABLE_PANEL_CRONRUNS."` SET `lastrun` = '".$ts."' WHERE `cronfile` ='cron_ticketarchive.php';");
	
		$content .= $this->_status_message('green', 'OK');
	
		return $content;
	}
	
	/**
	 * Import froxlor.sql into database
	 *
	 * @param object $db_root
	 *
	 * @return string status messages
	 */
	private function _importDatabaseData() {
	
		$content = "";
		$content .= $this->_status_message('begin', $this->_lng['install']['testing_new_db']);
		$options = array('PDO::MYSQL_ATTR_INIT_COMMAND' => 'set names utf8');
		$dsn = "mysql:host=".$this->_data['mysql_host'].";dbname=".$this->_data['mysql_database'].";";
		$fatal_fail = false;
		try {
			$db = new PDO(
					$dsn, $this->_data['mysql_unpriv_user'], $this->_data['mysql_unpriv_pass'], $options
			);
		} catch (PDOException $e) {
			$content .= $this->_status_message('red', $e->getMessage());
			$fatal_fail = true;
		};
	
		if (!$fatal_fail) {
	
			$content .= $this->_status_message('green', 'OK');
	
			$content .= $this->_status_message('begin', $this->_lng['install']['importing_data']);
			$db_schema = dirname(dirname(__FILE__)).'/froxlor.sql';
			$sql_query = @file_get_contents($db_schema);
			$sql_query = $this->_remove_remarks($sql_query);
			$sql_query = $this->_split_sql_file($sql_query, ';');
			for ($i = 0; $i < sizeof($sql_query); $i++) {
				if (trim($sql_query[$i]) != '') {
					$result = $db->query($sql_query[$i]);
				}
			}
			$db = null;
	
			$content .= $this->_status_message('green', 'OK');
		}
	
		return $content;
	}
	
	/**
	 * Create database and database-user
	 *
	 * @param object $db_root
	 *
	 * @return string status messages
	 */
	private function _createDatabaseAndUser(&$db_root) {
	
		$content = "";
	
		// so first we have to delete the database and
		// the user given for the unpriv-user if they exit
		$content .= $this->_status_message('begin', $this->_lng['install']['prepare_db']);
	
		$del_stmt = $db_root->prepare("DELETE FROM `mysql`.`user` WHERE `User` = :user AND `Host` = :accesshost");
		$del_stmt->execute(array('user' => $this->_data['mysql_unpriv_user'], 'accesshost' => $this->_data['mysql_access_host']));
	
		$del_stmt = $db_root->prepare("DELETE FROM `mysql`.`db` WHERE `User` = :user AND `Host` = :accesshost");
		$del_stmt->execute(array('user' => $this->_data['mysql_unpriv_user'], 'accesshost' => $this->_data['mysql_access_host']));
	
		$del_stmt = $db_root->prepare("DELETE FROM `mysql`.`tables_priv` WHERE `User` = :user AND `Host` =:accesshost");
		$del_stmt->execute(array('user' => $this->_data['mysql_unpriv_user'], 'accesshost' => $this->_data['mysql_access_host']));
	
		$del_stmt = $db_root->prepare("DELETE FROM `mysql`.`columns_priv` WHERE `User` = :user AND `Host` = :accesshost");
		$del_stmt->execute(array('user' => $this->_data['mysql_unpriv_user'], 'accesshost' => $this->_data['mysql_access_host']));
	
		$del_stmt = $db_root->prepare("DROP DATABASE IF EXISTS `".str_replace('`', '', $this->_data['mysql_database'])."`;");
		$del_stmt->execute();
	
		$db_root->query("FLUSH PRIVILEGES;");
		$content .= $this->_status_message('green', 'OK');
	
		// we have to create a new user and database for the froxlor unprivileged mysql access
		$content .= $this->_status_message('begin', $this->_lng['install']['create_mysqluser_and_db']);
		$ins_stmt = $db_root->prepare("CREATE DATABASE `".str_replace('`', '', $this->_data['mysql_database'])."`");
		$ins_stmt->execute();
	
		$mysql_access_host_array = array_map('trim', explode(',', $this->_data['mysql_access_host']));
	
		if (in_array('127.0.0.1', $mysql_access_host_array)
		&& !in_array('localhost', $mysql_access_host_array)
		) {
			$mysql_access_host_array[] = 'localhost';
		}
	
		if (!in_array('127.0.0.1', $mysql_access_host_array)
		&& in_array('localhost', $mysql_access_host_array)
		) {
			$mysql_access_host_array[] = '127.0.0.1';
		}
	
		$mysql_access_host_array[] = $this->_data['serverip'];
		foreach ($mysql_access_host_array as $mysql_access_host) {
			$_db = str_replace('`', '', $this->_data['mysql_database']);
			$stmt = $db_root->prepare("
					GRANT ALL PRIVILEGES ON `" . $_db . "`.*
					TO :username@:host
					IDENTIFIED BY 'password'"
			);
			$stmt->execute(array("username" => $this->_data['mysql_unpriv_user'], "host" => $mysql_access_host));
			$stmt = $db_root->prepare("SET PASSWORD FOR :username@:host = PASSWORD(:password)");
			$stmt->execute(array("username" => $this->_data['mysql_unpriv_user'], "host" => $mysql_access_host, "password" => $this->_data['mysql_unpriv_pass']));
		}
	
		$db_root->query("FLUSH PRIVILEGES;");
		$this->_data['mysql_access_host'] = implode(',', $mysql_access_host_array);
		$content .= $this->_status_message('green', 'OK');
	
		return $content;
	}
	
	/**
	 * Check if an old database exists and back it up if necessary
	 *
	 * @param object $db_root
	 *
	 * @return string status messages
	 */
	private function _backupExistingDatabase(&$db_root) {
	
		$content = "";
	
		// check for existing of former database
		$tables_exist = false;
		$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :database";
		$result_stmt = $db_root->prepare($sql);
		$result_stmt->execute(array('database' => $this->_data['mysql_database']));
		$rows = $db_root->query("SELECT FOUND_ROWS()")->fetchColumn();
	
		// check result
		if ($result_stmt !== false && $rows > 0) {
			$tables_exist = true;
		}
	
		if ($tables_exist) {
			// tell whats going on
			$content .= $this->_status_message('begin', $this->_lng['install']['backup_old_db']);
	
			// create temporary backup-filename
			$filename = "/tmp/froxlor_backup_" . date('YmdHi') . ".sql";
	
			// look for mysqldump
			$do_backup = false;
			if (file_exists("/usr/bin/mysqldump")) {
				$do_backup = true;
				$mysql_dump = '/usr/bin/mysqldump';
			} elseif (file_exists("/usr/local/bin/mysqldump")) {
				$do_backup = true;
				$mysql_dump = '/usr/local/bin/mysqldump';
			}
	
			if ($do_backup) {
				$command = $mysql_dump." ".$this->_data['mysql_database']." -u " . $this->_data['mysql_root_user'] . " --password='" . $this->_data['mysql_root_pass'] . "' --result-file=" . $filename;
				$output = exec($command);
				if (stristr($output, "error")) {
					$content .= $this->_status_message('red', $this->_lng['install']['backup_failed']);
				} else {
					$content .= $this->_status_message('green', 'OK ('.$filename.')');
				}
			} else {
				$content .= $this->_status_message('red', $this->_lng['install']['backup_binary_missing']);
			}
		}
	
		return $content;
	}
}

?>