<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

try {
	$concis = new \Concis\Concis();

	$eventHandler = new \Concis\Provider\GCPCloud\CloudStorage\EventHandler(function(\Concis\Provider\GCPCloud\CloudStorage\Datatype\CloudStorageObject $object = null, array $attributes = []) {
		file_put_contents(__DIR__ . '/index.log', 'Got ' . serialize($object) . ' with attributes ' . serialize($attributes) . PHP_EOL, FILE_APPEND);
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
