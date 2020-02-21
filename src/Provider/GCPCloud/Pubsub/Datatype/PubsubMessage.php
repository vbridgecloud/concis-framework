<?php

namespace Concis\Provider\GCPCloud\Pubsub\Datatype;

use \Concis\Util\Json;

/**
 * @ref https://cloud.google.com/pubsub/docs/reference/rest/v1/PubsubMessage
 */
class PubsubMessage
{
	/* string */ public $messageId;
	/* \DateTime */ public $publishTime;
	/* string */ public $data;
	/* array */ public $attributes = [];

	###

	public static function getObjectFactoryMap(): array
	{
		return [
			'publishTime' => function($value) {
				return \DateTime::createFromFormat(\DateTime::RFC3339_EXTENDED, $value);
			},
			'data' => function($value) {
				return \base64_decode($value);
			},
			'attributes' => function($value) {
				return $value ?? [];
			},
		];
	}

	###

	public function getMessageId(): string
	{
		return $this->messageId;
	}

	public function getPublishTime(): string
	{
		return $this->publishTime;
	}

	public function getData()/*: mixed */
	{
		return $this->data;
	}

	public function getAttributes(): array
	{
		return $this->attributes;
	}

	###

	public function getJsonData(bool $assoc = false, int $depth = 512, int $options = 0)/*: mixed */
	{
		return Json::decode($this->data, $assoc, $depth, $options);
	}
}
