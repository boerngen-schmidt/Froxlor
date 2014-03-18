<form action="{$ro->gen('install.start')}" method="post">
	<fieldset>
		<legend>{$tm->_("Froxlor install - choose language", "froxlor.install")}</legend>
		<table class="noborder">
			<tr>
				<td>
					<label for="language">{$tm->_("Installation language", "froxlor.install")}:</label>
				</td>
				<td align="right">
					
					<select name="language" id="language" class="dropdown">
						{html_options options=$t.languages}
					</select>
					<input type="submit" name="chooselang" value="{$tm->_("Select Language", "froxlor.install")}" />
				</td>
			</tr>
		</table>
	</fieldset>
</form>
