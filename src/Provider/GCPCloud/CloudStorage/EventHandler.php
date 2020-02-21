<?php

namespace Concis\Provider\GCPCloud\CloudStorage;

use \Concis\Util\ObjectFactory;
use \Concis\Provider\GCPCloud\CloudStorage\Datatype\CloudStorageEvent;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class EventHandler extends \Concis\EventHandler
{
	public function handle(Request $request)
	{
		// Only allow POST requests
		if ($request->getMethod() !== 'POST') {
			return new Response('', 405);
		}

		// Convert Request to a CloudStorageEvent
		$event = ObjectFactory::fromString($request->getContent(), CloudStorageEvent::class);

		// @TODO: Validate Event Object

		// Call the lambda
		return \call_user_func(
			$this->getLambda(),
			$event->getObject(),
			$event->getAttributes()
		);
	}
}
