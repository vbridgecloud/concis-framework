<?php

namespace Concis\Provider\GCPCloud\CloudStorage\Datatype;

use Concis\Provider\GCPCloud\CloudStorage\Enum\StorageClass;

/**
 * Representation of an object within Google Cloud Storage.
 *
 * @ref https://cloud.google.com/storage/docs/json_api/v1/objects#resource
 */
class CloudStorageObject
{
	public $kind = 'storage#object';
	/* string */ public $id;
	/* string */ public $selfLink;
	/* string */ public $name;
	/* string */ public $bucket;
	/* int */ public $generation;
	/* int */ public $metageneration;
	/* string */ public $contentType;
	/* \DateTime */ public $timeCreated;
	/* \DateTime */ public $updated;
	/* \DateTime */ public $timeDeleted;
	/* bool */ public $temporaryHold;
	/* bool */ public $eventBasedHold;
	/* \DateTime */ public $retentionExpirationTime;
	/* StorageClassType */ public $storageClass;
	/* \DateTime */ public $timeStorageClassUpdated;
	/* int */ public $size;
	/* string */ public $md5Hash;
	/* string */ public $mediaLink;
	/* string */ public $contentEncoding;
	/* string */ public $contentDisposition;
	/* string */ public $contentLanguage;
	/* string */ public $cacheControl;
	/* map */ public $metadata;
	/* AccesControl[] */ public $acl;
	/* obj */ public $owner;
	/* string */ public $crc32c;
	/* int */ public $componentCount;
	/* string */ public $etag;
	/* obj */ public $customerEncryption;
	/* string */ public $kmsKeyName;

	###

	public static function getObjectFactoryMap(): array
	{
		return [
			'storageClass' => function($value) {
				return new StorageClass(StorageClass::toValue($value));
			},
			'timeCreated' => function($value) {
				return \DateTime::createFromFormat(\DateTime::RFC3339_EXTENDED, $value);
			},
			'updated' => function($value) {
				return \DateTime::createFromFormat(\DateTime::RFC3339_EXTENDED, $value);
			},
			'timeDeleted' => function($value) {
				return \DateTime::createFromFormat(\DateTime::RFC3339_EXTENDED, $value);
			},
			'timeStorageClassUpdated' => function($value) {
				return \DateTime::createFromFormat(\DateTime::RFC3339_EXTENDED, $value);
			},
			'retentionExpirationTime' => function($value) {
				return \DateTime::createFromFormat(\DateTime::RFC3339_EXTENDED, $value);
			},
			'temporaryHold' => function($value) {
				return (bool) $value;
			},
			'eventBasedHold' => function($value) {
				return (bool) $value;
			},
			'generation' => function($value) {
				return (int) $value;
			},
			'metageneration' => function($value) {
				return (int) $value;
			},
			'size' => function($value) {
				return (int) $value;
			},
			'componentCount' => function($value) {
				return (int) $value;
			},
		];
	}
}
