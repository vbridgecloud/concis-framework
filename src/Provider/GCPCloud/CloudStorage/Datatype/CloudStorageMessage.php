<?php

namespace Concis\Provider\GCPCloud\CloudStorage\Datatype;

use Concis\Provider\GCPCloud\Pubsub\Datatype\PubsubMessage;
use Concis\Provider\GCPCloud\CloudStorage\Enum\StorageEventType;
use Concis\Provider\GCPCloud\CloudStorage\Enum\PayloadFormat;

use Concis\Util\ObjectFactory;

/**
 * Message coming from Cloud Storage over Pub/Sub
 *
 * @ref https://cloud.google.com/storage/docs/pubsub-notifications#format
 */
class CloudStorageMessage extends PubsubMessage
{
	###

	public static function getObjectFactoryMap(): array
	{
		return [
			'attributes' => function($value) {
				if (!$value) {
					throw new \Exception('Invalid CloudStorageMessage: Missing Attributes');
				}

				try {
					$value['eventType'] = forward_static_call([StorageEventType::class, $value['eventType']]);
				} catch (\Exception $e) {
					throw new \Exception('Invalid CloudStorageMessage: Invalid value for attribute eventType', 0, $e);
				}

				try {
					$value['payloadFormat'] = forward_static_call([PayloadFormat::class, $value['payloadFormat']]);
				} catch (\Exception $e) {
					throw new \Exception('Invalid CloudStorageMessage: Invalid value for attribute payloadFormat', 0, $e);
				}

				return $value;
			},
			'data' => function($value, $orig) {
				$value = \base64_decode($value);

				$payloadFormat = $orig['attributes']['payloadFormat'] ?? '(NONE)';

				switch ($payloadFormat) {
					case PayloadFormat::JSON_API_V1:
						return ObjectFactory::fromString($value, CloudStorageObject::class);

					case PayloadFormat::NONE:
						return null;

					default:
						throw new \Exception('Invalid CloudStorageMessage: Cannot convert data to CloudStorageObject for the given payloadFormat “' . $payloadFormat . '”');
				}

				return $value;
			},
		] + parent::getObjectFactoryMap();
	}
}
