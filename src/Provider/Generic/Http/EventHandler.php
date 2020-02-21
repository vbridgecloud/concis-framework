<?php

namespace Concis\Provider\Generic\Http;

use \Symfony\Component\HttpFoundation\Request;

class EventHandler extends \Concis\EventHandler
{
	public function handle(Request $request)
	{
		return \call_user_func(
			$this->getLambda(),
			$request
		);
	}
}
