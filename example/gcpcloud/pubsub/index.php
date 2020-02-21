<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

try {
	$concis = new \Concis\Concis();

	$eventHandler = new \Concis\Provider\GCPCloud\Pubsub\EventHandler(function(string $topic, \Concis\Provider\GCPCloud\Pubsub\Datatype\PubsubMessage $message) {
		file_put_contents(__DIR__ . '/index.log', $topic . ' got ' . serialize($message) . PHP_EOL, FILE_APPEND);
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
