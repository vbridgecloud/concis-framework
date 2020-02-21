<?php

namespace Concis\Provider\GCPCloud\CloudStorage\Enum;

use \Bramus\Enumeration\Enumeration;

/**
 * Possible Storage Class values
 *
 * @ref https://cloud.google.com/storage/docs/storage-classes
 */
class StorageClass extends Enumeration
{
	/**
	 * Standard Storage
	 *
	 * Standard Storage is best for data that is frequently accessed ("hot" data) and/or stored for only brief periods of time.
	 */
	const STANDARD = 'STANDARD';

	/**
	 * Nearline Storage
	 *
	 * Nearline Storage is a low-cost, highly durable storage service for storing infrequently accessed data. Nearline Storage is a better choice than Standard Storage in scenarios where slightly lower availability, a 30-day minimum storage duration, and costs for data access are acceptable trade-offs for lowered at-rest storage costs.
	 */
	const NEARLINE = 'NEARLINE';

	/**
	 * Coldline Storage
	 *
	 * Coldline Storage is a very-low-cost, highly durable storage service for storing infrequently accessed data. Coldline Storage is a better choice than Standard Storage or Nearline Storage in scenarios where slightly lower availability, a 90-day minimum storage duration, and higher costs for data access are acceptable trade-offs for lowered at-rest storage costs.
	 */
	const COLDLINE = 'COLDLINE';

	/**
	 * Archive Storage
	 *
	 * Archive Storage is the lowest-cost, highly durable storage service for data archiving, online backup, and disaster recovery. Unlike the "coldest" storage services offered by other Cloud providers, your data is available within milliseconds, not hours or days.
	 */
	const ARCHIVE = 'ARCHIVE';
}
