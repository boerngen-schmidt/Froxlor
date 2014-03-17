<?php

/**
 * The base view from which all project views inherit.
 */
class FroxlorBaseView extends AgaviView
{
	/* @var $tm AgaviTranslationManager */
	protected $tm;
	
	const SLOT_LAYOUT_NAME = 'slot';
	
	public function initialize(AgaviExecutionContainer $container) {
		parent::initialize($container);
		$this->tm = $container->getContext()->getTranslationManager();
	}
	
	/**
	 * Handles output types that are not handled elsewhere in the view. The
	 * default behavior is to simply throw an exception.
	 *
	 * @param      AgaviRequestDataHolder The request data associated with
	 *                                    this execution.
	 *
	 * @throws     AgaviViewException if the output type is not handled.
	 */
	public final function execute(AgaviRequestDataHolder $rd)
	{
		throw new AgaviViewException(sprintf(
			'The view "%1$s" does not implement an "execute%3$s()" method to serve '.
			'the output type "%2$s", and the base view "%4$s" does not implement an '.
			'"execute%3$s()" method to handle this situation.',
			get_class($this),
			$this->container->getOutputType()->getName(),
			ucfirst(strtolower($this->container->getOutputType()->getName())),
			get_class()
		));
	}
	
	/**
	 * Prepares the HTML output type.
	 *
	 * @param      AgaviRequestDataHolder The request data associated with
	 *                                    this execution.
	 * @param      string The layout to load.
	 */
	public function setupHtml(AgaviRequestDataHolder $rd, $layoutName = null)
	{
		if($layoutName === null && $this->getContainer()->getParameter('is_slot', false)) {
			// it is a slot, so we do not load the default layout, but a different one
			// otherwise, we could end up with an infinite loop
			$layoutName = self::SLOT_LAYOUT_NAME;
		}

		// now load the layout
		// this method returns an array containing the parameters that were declared on the layout (not on a layer!) in output_types.xml
		// you could use this, for instance, to automatically set a bunch of CSS or Javascript includes based on layout parameters -->
		$this->loadLayout($layoutName);
	}
	
	/**
	 * Sets the Output Renderer to Smarty using *.tpl files
	 */
	protected function useSmartyRenderer() {
		$this->getLayer('content')->setRenderer($this->container->getOutputType()->getRenderer('smarty'));
	}
	
	/**
	 * Sets the Output Renderer to PHP using *.php files
	 */
	protected function usePhpRenderer() {
		$this->getLayer('content')->setRenderer($this->container->getOutputType()->getRenderer('php'));
	}
}

?>