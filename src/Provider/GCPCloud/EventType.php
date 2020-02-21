<?php

namespace Concis\Provider\GCPCloud;

use \Bramus\Enumeration\Enumeration;

class EventType extends Enumeration
{
	/**
	 * Cloud Pub/Sub Trigger
	 */
	const PUBSUB = 'pubsub';

	/**
	 * Cloud Storage Trigger
	 */
	const CLOUD_STORAGE = 'cloud_storage';
}
