<?php

namespace Concis\Provider\GCPCloud\Pubsub\Datatype;

use \Concis\Util\ObjectFactory;

/**
 * @ref https://cloud.google.com/pubsub/docs/reference/rest/v1/PubsubMessage
 */
class PubsubEvent
{
	/* string */ public $subscription;
	/* PubsubMessage */ public $message;

	###

	public static function getObjectFactoryMap(): array
	{
		return [
			'message' => function($value) {
				return ObjectFactory::fromArray($value, PubsubMessage::class);
			},
		];
	}

	###

	public function getMessage(): PubsubMessage
	{
		return $this->message;
	}

	public function getSubscription(): string
	{
		return $this->subscription;
	}
}
