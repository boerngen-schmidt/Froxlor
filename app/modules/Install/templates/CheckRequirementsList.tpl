<table class="noborder">
	<tbody>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP version >= 5.3", "froxlor")}</td>
		<td>
			{if $t.requirement->checkPhp()}<span style="color:green;">{$tm->_("OK, running PHP %s", "froxlor", null, array($t.phpversion))}</span>
			{else}<span style="color:red;">{$tm->_("Failed PHP Version check. Running PHP %s.", null, null, array($t.phpversion))}</span>{/if}
		</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("magic_quotes_runtime...", "froxlor")}</td>
		<td>
			{if $t.requirement->checkMagicQuotes()}<span style="color:green;">{$tm->_("off")}</span>
			{else}<span style="color:orange;">{$tm->_("PHP setting \"magic_quotes_runtime\" must be set to \"Off\". We have disabled it temporary for now please fix the coresponding php.ini.")}{/if}
		</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP PDO extension and PDO-MySQL driver...", "froxlor")}</td>
		<td>
			{if $t.requirement->checkPdo()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:red;">{$tm->_("not installed")}</span>{/if}
		</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP XML-extension...")}</td>
		<td>
			{if $t.requirement->checkPhpXml()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:red;">{$tm->_("not installed")}</span>{/if}
		</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP filter-extension...")}</td>
		<td>{if $t.requirement->checkPhpFilter()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:red;">{$tm->_("not installed")}</span>{/if}</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP posix-extension...")}</td>
		<td>{if $t.requirement->checkPhpPosix()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:red;">{$tm->_("not installed")}</span>{/if}</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP bcmath-extension...")}</td>
		<td>{if $t.requirement->checkPhpBcmath()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:orange;">{$tm->_("not installed")}<br />{$tm->_("Traffic-calculation related functions will not work correctly!")}</span>{/if}</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("PHP curl-extension...")}</td>
		<td>{if $t.requirement->checkPhpCurl()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:orange;">{$tm->_("not installed")}<br />{$tm->_("Version-check and news-feed may not work correctly!")}</span>{/if}</td>
	</tr>
	<tr>
		<td style="width: 320px;">{$tm->_("open_basedir...")}</td>
		<td>{if $t.requirement->checkOpenbasedir()}<span style="color:green;">{$tm->_("installed")}</span>
			{else}<span style="color:orange;">{$tm->_("enabled")}<br />{$tm->_("Froxlor will not work properly with open_basedir enabled. Please disable open_basedir for Froxlor in the coresponding php.ini.")}</span>{/if}</td>
	</tr>
	</tbody>
</table>