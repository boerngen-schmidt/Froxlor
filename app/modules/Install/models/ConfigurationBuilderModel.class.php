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
 
class Install_ConfigurationBuilderModel extends FroxlorInstallBaseModel
{
	
	const AGAVI_AE = 'http://agavi.org/agavi/config/global/envelope/1.1';
	const AGAVI_DB = 'http://agavi.org/agavi/config/parts/databases/1.1';
	const AGAVI_CFG = 'http://agavi.org/agavi/config/parts/settings/1.1';
	/**
	 * @todo fill in documentation here
	 *
	 * @var          string 
	 */
	private $SqlUser;

	/**
	 * @todo fill in documentation here
	 *
	 * @var          string 
	 */
	private $SqlPassword;

	/**
	 * @todo fill in documentation here
	 *
	 * @var          string 
	 */
	private $SqlDatabase;

	/**
	 * @todo fill in documentation here
	 *
	 * @var          string 
	 */
	private $SqlServer;

	/**
	 * @todo fill in documentation here
	 *
	 * @var          int 
	 */
	private $SqlServerPort;

	/**
	 * @todo fill in documentation here
	 *
	 * @var          string 
	 */
	private $SqlRootUser;

	/**
	 * @todo fill in documentation here
	 *
	 * @var          string 
	 */
	private $SqlRootPassword;
	
	public function initialize(AgaviContext $context, Array $parameters) {
		parent::initialize($context, $parameters);
		
		// Set model parameters
	}

	/**
	 * Sets the SqlUser attribute.
	 *
	 * @param        string the new value for SqlUser
	 *
	 * @return       void
	 */
	public function setSqlUser($SqlUser)
	{
		$this->SqlUser = $SqlUser;
	}

	/**
	 * Retrieves the SqlUser attribute.
	 *
	 * @return       string the value for SqlUser
	 */
	public function getSqlUser()
	{
		return $this->SqlUser;
	}

	/**
	 * Sets the SqlPassword attribute.
	 *
	 * @param        string the new value for SqlPassword
	 *
	 * @return       void
	 */
	public function setSqlPassword($SqlPassword)
	{
		$this->SqlPassword = $SqlPassword;
	}

	/**
	 * Retrieves the SqlPassword attribute.
	 *
	 * @return       string the value for SqlPassword
	 */
	public function getSqlPassword()
	{
		return $this->SqlPassword;
	}

	/**
	 * Sets the SqlDatabase attribute.
	 *
	 * @param        string the new value for SqlDatabase
	 *
	 * @return       void
	 */
	public function setSqlDatabase($SqlDatabase)
	{
		$this->SqlDatabase = $SqlDatabase;
	}

	/**
	 * Retrieves the SqlDatabase attribute.
	 *
	 * @return       string the value for SqlDatabase
	 */
	public function getSqlDatabase()
	{
		return $this->SqlDatabase;
	}

	/**
	 * Sets the SqlServer attribute.
	 *
	 * @param        string the new value for SqlServer
	 *
	 * @return       void
	 */
	public function setSqlServer($SqlServer)
	{
		$this->SqlServer = $SqlServer;
	}

	/**
	 * Retrieves the SqlServer attribute.
	 *
	 * @return       string the value for SqlServer
	 */
	public function getSqlServer()
	{
		return $this->SqlServer;
	}

	/**
	 * Sets the SqlServerPort attribute.
	 *
	 * @param        int the new value for SqlServerPort
	 *
	 * @return       void
	 */
	public function setSqlServerPort($SqlServerPort)
	{
		$this->SqlServerPort = $SqlServerPort;
	}

	/**
	 * Retrieves the SqlServerPort attribute.
	 *
	 * @return       int the value for SqlServerPort
	 */
	public function getSqlServerPort()
	{
		return $this->SqlServerPort;
	}

	/**
	 * Sets the SqlRootUser attribute.
	 *
	 * @param        string the new value for SqlRootUser
	 *
	 * @return       void
	 */
	public function setSqlRootUser($SqlRootUser)
	{
		$this->SqlRootUser = $SqlRootUser;
	}

	/**
	 * Retrieves the SqlRootUser attribute.
	 *
	 * @return       string the value for SqlRootUser
	 */
	public function getSqlRootUser()
	{
		return $this->SqlRootUser;
	}

	/**
	 * Sets the SqlRootPassword attribute.
	 *
	 * @param        string the new value for SqlRootPassword
	 *
	 * @return       void
	 */
	public function setSqlRootPassword($SqlRootPassword)
	{
		$this->SqlRootPassword = $SqlRootPassword;
	}

	/**
	 * Retrieves the SqlRootPassword attribute.
	 *
	 * @return       string the value for SqlRootPassword
	 */
	public function getSqlRootPassword()
	{
		return $this->SqlRootPassword;
	}
	
	private function getMysqlDSN() {
		return 'mysql:host='.$this->SqlServer.';dbname='.$this->SqlDatabase;
	}
	
	/**
	 * Writes a new database.xml file to /tmp
	 */
	public function writeToTmpFile() {
		$doc = new DOMDocument('1.0', 'UTF-8');
		$doc->formatOutput = true;
		$root = $doc->createElementNS(self::AGAVI_AE, 'ae:configurations');
		$root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns', AGAVI_DB);
		$doc->appendChild($root);
		
		$coniguration = $doc->createElementNS(self::AGAVI_AE, 'ae:configuration');
		$root->appendChild($coniguration);
		
		$databases = $doc->createElement('databases');
		$databases->setAttribute('default', 'froxlor');
		$coniguration->appendChild($databases);
		
		$db_froxlor = $doc->createElement('database');
		$db_froxlor->setAttribute('name', 'froxlor');
		$db_froxlor->setAttribute('class', 'AgaviPdoDatabase');
		$databases->appendChild($db_froxlor);
		
		$param = $doc->createElementNS(self::AGAVI_AE, 'ae:parameter', $this->getMysqlDSN());
		$param->setAttribute('name', 'dsn');
		$db_froxlor->appendChild($param);
		$param = $doc->createElementNS(self::AGAVI_AE, 'ae:parameter', $this->getSqlUser());
		$param->setAttribute('name', 'username');
		$db_froxlor->appendChild($param);
		$param = $doc->createElementNS(self::AGAVI_AE, 'ae:parameter', $this->getSqlPassword());
		$param->setAttribute('name', 'password');
		$db_froxlor->appendChild($param);
		
		$db_root = $doc->createElement('database');
		$db_root->setAttribute('name', 'root');
		$db_root->setAttribute('class', 'AgaviPdoDatabase');
		$databases->appendChild($db_root);
		
		$param = $doc->createElementNS(self::AGAVI_AE, 'ae:parameter', $this->getMysqlDSN());
		$param->setAttribute('name', 'dsn');
		$db_root->appendChild($param);
		$param = $doc->createElementNS(self::AGAVI_AE, 'ae:parameter', $this->getSqlRootUser());
		$param->setAttribute('name', 'username');
		$db_root->appendChild($param);
		$param = $doc->createElementNS(self::AGAVI_AE, 'ae:parameter', $this->getSqlRootPassword());
		$param->setAttribute('name', 'password');
		$db_root->appendChild($param);
				
		// write the 
		return $doc->save('/tmp/database.xml');
	}
	
	public function enableDatabase(DOMDocument $doc) {
		$xpath = new DOMXPath($doc);
		$xpath->registerNamespace('ae', self::AGAVI_AE);
		$xpath->registerNamespace('cfg', self::AGAVI_CFG);
		$result = $xpath->query("/ae:configurations/ae:configuration/cfg:settings/cfg:setting[@name='use_database']");
		/* @var $element DOMElement */
		$element = $result->item(0);
		$element->nodeValue = 'true';
	}
	
	/**
	 * Writes the given content into a file
	 * 
	 * @param string $content The content which should be written in the file
	 * @param string $file Path, Filename and extentsion to write content into
	 * @return boolean true on successful write | false otherwise
	 */
	private function writeContentToFile($content, $file) {
		if ($fp = @fopen($file, 'w')) {
			$result = @fputs($fp, $content, strlen($content));
			@fclose($fp);
			chmod($file, 0440);
			return true;
		} else {
			return false;
		}
	}
	
	public function changeDatabaseXml(DOMDocument $doc) {
		$xpath = new DOMXPath($doc);
		$xpath->registerNamespace('ae', self::AGAVI_AE);
		$xpath->registerNamespace('db', self::AGAVI_DB);
		
		// Should return just one note
		$result = $xpath->query("/ae:configurations/ae:configuration/db:databases/db:database[@name='froxlor']");
		/* @var $element DOMElement */
		$element = $result->item(0);
		if ($element->hasChildNodes()) {
			foreach ($element->childNodes as $e) {
				if (!$e instanceof DOMElement)
					continue;
				/* @var $e DOMElement */
				switch ($e->getAttribute('name')) {
					case 'dsn':
						$e->nodeValue = $this->getMysqlDSN();
						break;
					case 'username':
						$e->nodeValue = $this->getSqlUser();
						break;
					case 'password':
						$e->nodeValue = $this->getSqlPassword();
						break;
				}
			}
		}
		
		// Now the root database connection
		// Should return just one note
		$result = $xpath->query("/ae:configurations/ae:configuration/db:databases/db:database[@name='root']");
		/* @var $element DOMElement */
		$element = $result->item(0);
		if ($element->hasChildNodes()) {
			foreach ($element->childNodes as $e) {
				if (!$e instanceof DOMElement)
					continue;
				/* @var $e DOMElement */
				switch ($e->getAttribute('name')) {
					case 'dsn':
						$e->nodeValue = $this->getMysqlDSN();
						break;
					case 'username':
						$e->nodeValue = $this->getSqlUser();
						break;
					case 'password':
						$e->nodeValue = $this->getSqlPassword();
						break;
				}
			}
		}
		
		
	}
}

class FroxlorConfigurationBuilderException extends AgaviException {}

?>