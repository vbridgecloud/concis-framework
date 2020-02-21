<?php

namespace Concis\Provider\GCPCloud\CloudStorage\Enum;

use \Bramus\Enumeration\Enumeration;

/**
 * Possible Cloud Storage Payload formats
 *
 * @ref https://cloud.google.com/storage/docs/pubsub-notifications#payload
 */
class PayloadFormat extends Enumeration
{
	/**
	 * No payload is included with the notification.
	 */
	const NONE = 'NONE';

	/**
	 * The payload will be a UTF-8 string containing the resource representation of the object’s metadata.
	 */
	const JSON_API_V1 = 'JSON_API_V1';
}
