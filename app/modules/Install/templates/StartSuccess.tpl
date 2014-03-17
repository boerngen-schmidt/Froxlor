<table class="noborder">
	<tbody>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP version >= 5.3', 'default')}</td>
		<td>
			{if $requirement->checkPhp()}<span style="color:green;">{php}echo PHP_VERSION{/php}</span>{/if}
			{else}<span style="color:red;">{$tm->_('')}</span>{/else}
		</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('magic_quotes_runtime...', 'default')}</td>
		<td>
			{if $requirement->checkMagicQuotes()}<span style="color:green;">{$tm->_('off')}</span>{/if}
			{else}<span style="color:orange;">{$tm->_('PHP setting "magic_quotes_runtime" must be set to "Off". We have disabled it temporary for now please fix the coresponding php.ini.')}{/else}
		</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP PDO extension and PDO-MySQL driver...', 'default')}</td>
		<td>
			{if $requirement->checkPdo()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:red;">{$tm->_('not installed')}</span>{/else}
		</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP XML-extension...')}</td>
		<td>
			{if $requirement->checkPhpXml()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:red;">{$tm->_('not installed')}</span>{/else}
		</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP filter-extension...')}</td>
		<td>{if $requirement->checkPhpFilter()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:red;">{$tm->_('not installed')}</span>{/else}</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP posix-extension...')}</td>
		<td>{if $requirement->checkPhpPosix()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:red;">{$tm->_('not installed')}</span>{/else}</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP bcmath-extension...')}</td>
		<td>{if $requirement->checkPhpBcmath()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:orange;">{$tm->_('not installed')}<br />{$tm->_('Traffic-calculation related functions will not work correctly!')}</span>{/else}</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('PHP curl-extension...')}</td>
		<td>{if $requirement->checkPhpCurl()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:orange;">{$tm->_('not installed')}<br />{$tm->_('Version-check and news-feed may not work correctly!')}</span>{/else}</td>
	</tr>
	<tr>
		<td style="width: 250px;">{$tm->_('open_basedir...')}</td>
		<td>{if $requirement->checkOpenbasedir()}<span style="color:green;">{$tm->_('installed')}</span>{/if}
			{else}<span style="color:orange;">{$tm->_('enabled')}<br />{$tm->_('Froxlor will not work properly with open_basedir enabled. Please disable open_basedir for Froxlor in the coresponding php.ini.')}</span>{/else}</td>
	</tr>
	</tbody>
</table>