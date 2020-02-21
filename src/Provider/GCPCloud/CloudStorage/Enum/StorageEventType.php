<?php

namespace Concis\Provider\GCPCloud\CloudStorage\Enum;

use \Bramus\Enumeration\Enumeration;

/**
 * Types of possible Storage Events
 *
 * @ref https://cloud.google.com/storage/docs/pubsub-notifications#events
 * @ref https://cloud.google.com/functions/docs/calling/storage
 */
class StorageEventType extends Enumeration
{
	/**
	 * Object has been Finalized
	 *
	 * Sent when a new object (or a new generation of an existing object) is successfully created in the bucket. This includes copying or rewriting an existing object. A failed upload does not trigger this event.
	 */
	const OBJECT_FINALIZE = 'google.storage.object.finalize';

	/**
	 * Object Metadata has been Updated
	 *
	 * Sent when the metadata of an existing object changes.
	 */
	const OBJECT_METADATA_UPDATE = 'google.storage.object.metadataUpdate';

	/**
	 * Object has been Deleted
	 *
	 * Sent when an object has been permanently deleted. This includes objects that are overwritten or are deleted as part of the bucket's lifecycle configuration. For buckets with object versioning enabled, this is not sent when an object becomes noncurrent (see OBJECT_ARCHIVE), even if the object becomes noncurrent via the storage.objects.delete method.
	 */
	const OBJECT_DELETE = 'google.storage.object.delete';

	/**
	 * Object has been Archived
	 *
	 * Only sent when a bucket has enabled object versioning. This event indicates that the live version of an object has become a noncurrent version, either because it was explicitly made noncurrent or because it was overwritten by the upload of an object of the same name.
	 */
	const OBJECT_ARCHIVE = 'google.storage.object.delete';
}
