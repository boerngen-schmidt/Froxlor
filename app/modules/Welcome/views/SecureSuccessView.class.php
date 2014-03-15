<?php

class Welcome_SecureSuccessView extends FroxlorWelcomeBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setAttribute('_title', 'Access Denied');
		
		$this->setupHtml($rd);
		
		$this->getResponse()->setHttpStatusCode('403');
	}
}

?>
