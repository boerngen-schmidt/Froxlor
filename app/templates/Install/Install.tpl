<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Default-Style" content="text/css" />
	<base href="{$ro->getBaseHref()}" />
	<!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
	<link href="templates/Install/css/install.css" rel="stylesheet" type="text/css" />
	<!--[if IE]><link rel="stylesheet" href="templates/Install/css/main_ie.css" type="text/css" /><![endif]-->
	<link href="templates/Install/img/favicon.ico" rel="icon" type="image/x-icon" />
	<title>Froxlor Server Management Panel - Installation</title>
	<style type="text/css">
	body {
        font-family: Verdana, Geneva, sans-serif;
	}
	</style>
</head>
<body>
	<div class="installsec">
		{$inner}
	</div>
	<footer>
		<span> Froxlor &copy; 2009-{$smarty.now|date_format:"%Y"} by <a href="http://www.froxlor.org/" rel="external">the Froxlor Team</a>
		</span>
	</footer>
</body>
</html>
