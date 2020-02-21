<?php

namespace Concis\Provider\GCPCloud\CloudStorage\Datatype;

use Concis\Util\ObjectFactory;
use Concis\Provider\GCPCloud\Pubsub\Datatype\PubsubEvent;

class CloudStorageEvent extends PubsubEvent
{
	###

	public static function getObjectFactoryMap(): array
	{
		return [
			'message' => function($value) {
				return ObjectFactory::fromArray($value, CloudStorageMessage::class);
			},
		];
	}

	###

	public function getObject()/* : mixed */
	{
		return $this->getMessage()->getData();
	}

	public function getAttributes() : array
	{
		return $this->getMessage()->getAttributes();
	}
}
