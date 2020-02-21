<?php

namespace Concis;

use \Symfony\Component\HttpFoundation\Request;

abstract class EventHandler
{
	private static $shorthandMap = [];
	private $lambda;

	final public function __construct(callable $lambda)
	{
		$this->lambda = $lambda;
	}

	final public function getLambda(): callable
	{
		return $this->lambda;
	}

	abstract public function handle(Request $request);

	###

	final public static function registerShorthand(string $triggerName, string $triggerClassName)
	{
		static::$shorthandMap[$triggerName] = $triggerClassName;
	}

	/**
	 * Forward static calls to one of the registered shorthands
	 */
	public static function __callStatic($method, $arguments)
	{
		$triggerClassName = static::$shorthandMap[$method] ?? null;

		if ($triggerClassName === null) {
			throw new \Exception("Invalid event handler shorthand $method. Did you forget to register the provider?");
		}

		return new $triggerClassName($arguments[0]);
	}
}
