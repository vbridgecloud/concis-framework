<?php

namespace Concis\Provider\Generic;

class GenericProvider extends \Concis\EventHandlerProvider
{
	protected $prefix = '';

	protected $shorthandMap = [
		[EventType::HTTP, Http\EventHandler::class],
	];
}
