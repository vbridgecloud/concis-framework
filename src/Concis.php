<?php

namespace Concis;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class Concis
{
	final public static function registerProviderShorthands(EventHandlerProvider $provider): void
	{
		$provider->registerShorthands();
	}

	public function handle(Request $request, EventHandler $eventHandler): Response
	{
		// Call it!
		try {
			$response = $eventHandler->handle($request);
		} catch (\Exception $e) {
			$response = new Response($e->getMessage(), 500);
		}

		// Make sure we have a Response
		if (!\is_a($response, Response::class)) {
			$response = new Response($response);
		}

		// Return it
		return $response;
	}
}
