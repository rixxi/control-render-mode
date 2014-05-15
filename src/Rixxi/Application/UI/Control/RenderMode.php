<?php

namespace Rixxi\Application\UI\Control;


/**
 * Implements IRenderMode and handles render<Mode>() calls ie. {control name:view ... } in template.
 * Useful for having multiple render modes of component with only one render method (default).
 *
 * It is intended only for Nette\Application\UI\Control children.
 */
trait RenderMode /* implements IRenderMode */
{

	private $defaultRenderMode = IRenderMode::DEFAULT_RENDER_MODE;

	/** @var string|null */
	private $renderMode = IRenderMode::DEFAULT_RENDER_MODE;


	/** @param string|null */
	protected function setDefaultRenderMode($mode = IRenderMode::DEFAULT_RENDER_MODE)
	{
		$this->defaultRenderMode = $mode;
	}


	/** @return string|null */
	protected function getDefaultRenderMode()
	{
		return $this->renderMode;
	}


	public function setRenderMode($mode = IRenderMode::DEFAULT_RENDER_MODE)
	{
		$this->renderMode = $mode;
	}


	public function getRenderMode($mode = IRenderMode::DEFAULT_RENDER_MODE)
	{
		return $mode !== IRenderMode::DEFAULT_RENDER_MODE ? $mode : ($this->renderMode !== IRenderMode::DEFAULT_RENDER_MODE ? $this->renderMode : $this->defaultRenderMode);
	}


	public function __call($name, $args)
	{
		if (isset($name[7]) && strpos($name, 'render') === 0) {
			$previous = $this->getRenderMode();
			$this->setRenderMode(lcfirst(substr($name, 6)));
			call_user_func_array([$this, 'render'], $args);
			$this->setRenderMode($previous);
		}

		return parent::__call($name, $args);
	}

}