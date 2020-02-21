<?php

namespace Concis\Provider\GCPCloud;

class Provider extends \Concis\EventHandlerProvider
{
	protected $prefix = 'gcpcloud';

	protected $shorthandMap = [
		[EventType::PUBSUB, Pubsub\EventHandler::class],
		[EventType::CLOUD_STORAGE, CloudStorage\EventHandler::class],
	];
}
