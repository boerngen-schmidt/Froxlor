<article class="install bradius">
	<header class="dark">
		<img src="templates/Sparkle/img/logo.png" alt="Froxlor Server Management Panel" />
	</header>

	<section class="installsec">
		<h1>{$.title}</h1>
			{include file='CheckRequirementsList.tpl'}
		<h2 style="color:green;text-align: center">{$tm->_("All requirements are satisfied", "froxlor.install")}</h2>
		<aside>
			<a href="{$ro->gen('install.database')}">{$tm->_("Click here to continue", "froxlor.install")}</a>
		</aside>
	</section>
</article>