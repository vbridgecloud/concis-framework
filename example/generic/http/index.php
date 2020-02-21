<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

try {
	$concis = new \Concis\Concis();

	$eventHandler = new \Concis\Provider\Generic\Http\EventHandler(function(Request $request) {
		$name = $request->query->get('name', 'Concis');
		file_put_contents(__DIR__ . '/index.log', "Hello $name" . PHP_EOL, FILE_APPEND);

		return new Response('Hello, ' . htmlspecialchars($name, ENT_QUOTES));
	});
	$request = Request::createFromGlobals();

	$response = $concis->handle(
		$request,
		$eventHandler
	);
} catch (\Exception $e) {
	$response = new Response($e->getMessage(), 500);
}

$response->send();
