<h1>{$t.title}</h1>
	{include file='./CheckRequirementsList.tpl'}
<h2 style="color:red;text-align: center">{$tm->_("Cannot install Froxlor without these requirements! Try to fix them and retry.")}</h2>
<aside>
	<a href="{$ro->gen(null)}">{$tm->_("Click here to check again")}</a>
</aside>
