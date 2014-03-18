<form id="settings" method="post" action="{$ro->gen(null)}">
	<fieldset>
		<h2>{$tm->_("Database connection", "froxlor.install")}</h2>
		<p>
			<label style="width:65%;" for="mysql_host">{$tm->_("MySQL-Hostname:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="mysql_host" name="mysql_host">
		</p>
		<p>
			<label style="width:65%;" for="mysql_database">{$tm->_("Database name:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="mysql_database" name="mysql_database">
		</p>
		<p>
			<label style="width:65%;" for="mysql_unpriv_user">{$tm->_("Username for the unprivileged MySQL-account:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="mysql_unpriv_user" name="mysql_unpriv_user">
		</p>
		<p>
			<label style="width:65%;" for="mysql_unpriv_pass">{$tm->_("Password for the unprivileged MySQL-account:", "froxlor.install")}</label>&nbsp;
			<input type="password" required="required" value="" id="mysql_unpriv_pass" name="mysql_unpriv_pass">
		</p>
		<p>
			<label style="width:65%;" for="mysql_root_user">{$tm->_("Username for the MySQL-root-account:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="mysql_root_user" name="mysql_root_user">
		</p>
		<p>
			<label style="width:65%;" for="mysql_root_pass">{$tm->_("Password for the MySQL-root-account:", "froxlor.install")}</label>&nbsp;
			<input type="password" required="required" value="" id="mysql_root_pass" name="mysql_root_pass">
		</p>
		<br>
		<h2>{$tm->_("Administrator Account", "froxlor.install")}</h2>
		<p>
			<label style="width:65%;" for="admin_user">{$tm->_("Administrator Username:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="admin" id="admin_user" name="admin_user">
		</p>
		<p>
			<label style="width:65%;" for="admin_password">{$tm->_("Administrator Password:", "froxlor.install")}</label>&nbsp;
			<input type="password" required="required" value="" id="admin_password" name="admin_password">
		</p>
		<p>
			<label style="width:65%;" for="admin_password_confirmation">{$tm->_("Administrator-Password (confirmation):", "froxlor.install")}</label>&nbsp;
			<input type="password" required="required" value="" id="admin_password_confirmation" name="admin_password_confirmation">
		</p>
		<br>
		<h2>{$tm->_("Server settings", "froxlor.install")}</h2>
		<p>
			<label style="width:65%;" for="servername">{$tm->_("Server name (FQDN, no ip-address):", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="servername" name="servername">
		</p>
		<p>
			<label style="width:65%;" for="serverip">{$tm->_("Server IP:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="serverip" name="serverip">
		</p>
		<p>
			<label style="width:65%;" for="apache2">{$tm->_("Webserver Apache 2:", "froxlor.install")}</label>
			<input type="radio" checked="checked" value="apache2" id="apache2" name="webserver"><span>Apache 2</span>
		</p>
		<p>
			<label style="width:65%;" for="lighttpd">{$tm->_("Webserver LigHTTPd:", "froxlor.install")}</label>
			<input type="radio" value="lighttpd" id="lighttpd" name="webserver"><span>LigHTTPd</span>
		</p>
		<p>
			<label style="width:65%;" for="nginx">{$tm->_("Webserver NGINX:", "froxlor.install")}</label>
			<input type="radio" value="nginx" id="nginx" name="webserver"><span>NGINX</span>
		</p>
		<p>
			<label style="width:65%;" for="httpuser">{$tm->_("HTTP username:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="httpuser" name="httpuser">
		</p>
		<p>
			<label style="width:65%;" for="httpgroup">{$tm->_("HTTP groupname:", "froxlor.install")}</label>&nbsp;
			<input type="text" required="required" value="" id="httpgroup" name="httpgroup">
		</p>

	</fieldset>
	<aside>
		<input type="hidden" value="1" name="check">
		<input type="hidden" value="english" name="language">
		<input type="hidden" value="1" name="installstep">
		<input type="submit" value="{$tm->_("Click here to continue", "froxlor.install")}" name="submitbutton" class="bottom">
	</aside>
</form>