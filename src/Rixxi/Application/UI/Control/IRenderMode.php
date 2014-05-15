<?php

namespace Rixxi\Application\UI\Control;


interface IRenderMode
{

	const DEFAULT_RENDER_MODE = NULL;

	/** @param string */
	function setRenderMode($mode = self::DEFAULT_RENDER_MODE);

	/**
	 * In case getRenderMode() === DEFAULT_RENDER_MODE, getRenderMode($mode) must return $mode instead.
	 *
	 * @return string|null
	 */
	function getRenderMode($mode = self::DEFAULT_RENDER_MODE);

}
