<h1>{$t.title}</h1>
	{include file='./CheckRequirementsList.tpl'}
<h2 style="color:green;text-align: center">{$tm->_("All requirements are satisfied", "froxlor.install")}</h2>
<aside>
	<a href="{$ro->gen('install.settings')}">{$tm->_("Click here to continue", "froxlor.install")}</a>
</aside>
	