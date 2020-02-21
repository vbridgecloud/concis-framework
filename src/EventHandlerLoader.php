<?php

namespace Concis;

class EventHandlerLoader
{
	final public static function loadFromDisk(string $fileName)
	{
		if (\file_exists($fileName)) {
			$eventHandler = require $fileName;

			if (!\is_a($eventHandler, EventHandler::class)) {
				throw new \Exception("The lamda returned from {$fileName} is not a Concis EventHandler");
			}
		} else {
			throw new \Exception("Could not load EventHandler from location {$fileName}");
		}

		return $eventHandler;
	}
}
