<?php

namespace Concis\Provider\GCPCloud\Pubsub;

use \Concis\Util\ObjectFactory;
use \Concis\Provider\GCPCloud\Pubsub\Datatype\PubsubEvent;

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

		// Convert Request to a PubsubEvent
		$event = ObjectFactory::fromString($request->getContent(), PubsubEvent::class);

		// @TODO: Validate Event Object

		// Call the lambda
		return \call_user_func(
			$this->getLambda(),
			$event->getSubscription(),
			$event->getMessage()
		);
	}
}
