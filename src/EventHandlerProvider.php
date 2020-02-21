<?php

namespace Concis;

abstract class EventHandlerProvider
{
	protected $prefix = '';
	protected $shorthandMap = [];

	final public function registerShorthands()
	{
		if (sizeof($this->shorthandMap) === 0) {
			throw new \Exception('No shorthandMap defined on class ' . static::class);
		}

		foreach ($this->shorthandMap as $shorthandAndHandlerClassname) {
			[$shorthand, $handlerClassname] = $shorthandAndHandlerClassname;

			EventHandler::registerShorthand(
				$this->prefix ? $this->prefix . '_' . $shorthand : $handlerClassname,
				$handlerClassname
			);
		}
	}
}
