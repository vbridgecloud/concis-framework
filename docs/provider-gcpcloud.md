# Concis GCPCloud Provider

The GCPCloud Provider (namespace `\Concis\Provider\GCPCloud`) is a collection of EventHandlers tied to events originating from inside of Google Cloud Platform.

Just like [Google Cloud Functions supporting various triggers](https://cloud.google.com/functions/docs/calling), Concis also supports _(several of)_ these.

## Cloud Pub/Sub Topic EventHandler

This type of EventHandler is invoked by messages published to Google Cloud Platform Pub/Sub topics.

- Class: `\Concis\Provider\GCPCloud\Pubsub\EventHandler`
- Shorthand: `gcpcloud_pubsub`

💡 You could compare EventHandlers registered like this to deploying a Google Cloud Function using `--trigger-topic`.

### Example

```php
$eventHandler = \Concis\EventHandler::gcpcloud_pubsub(function (string $subscription, \Concis\Provider\GCPCloud\Pubsub\Datatype\PubsubMessage $message) {
    // Your handling code here …
});
```

### Arguments

- `$subscription`: The Pub/Sub subscription that received the message
- `$message`: The message that was triggered on the topic.
    - @REF https://cloud.google.com/pubsub/docs/reference/rest/v1/PubsubMessage

### Invoking the EventHandler

1. Set up some ENV vars to use

    ```bash
    BUCKET_NAME=my-bucket
    GC_PROJECT=my-gcp-project
    PUBSUB_TOPIC=my-topic
    CONCIS_URL=https://example.org/
    ```

1. Register your EventHandler as a Push Endpoint for your Cloud Pub/Sub Topic

    ```bash
    gcloud pubsub topics create $PUBSUB_TOPIC --project=$GC_PROJECT
    gcloud pubsub subscriptions create $PUBSUB_TOPIC-subscription --project=$GC_PROJECT --topic $PUBSUB_TOPIC --push-endpoint="$CONCIS_URL"
    ```

1. Trigger a message

    ```bash
    gcloud pubsub topics publish $PUBSUB_TOPIC --project=$GC_PROJECT --message '{"foo": "bar"}'
    ```

🔰 References:

- https://cloud.google.com/pubsub/docs/admin
- https://cloud.google.com/pubsub/docs/publisher

## Cloud Storage EventHandler

This type of EventHandler is invoked by messages published by Cloud Storage. The messages are transported over HTTP

- Class: `\Concis\Provider\GCPCloud\CloudStorage\EventHandler`
- Shorthand: `gcpcloud_cloud_storage`

💡 You could compare EventHandlers registered like this to deploying a Google Cloud Function using `--trigger-resource`.

### Example

```php
$eventHandler = \Concis\EventHandler::gcpcloud_cloud_storage(function(\Concis\Provider\GCPCloud\CloudStorage\Datatype\CloudStorageObject $object = null, array $attributes = []) {
    // Your handling code here …
});
```

### Arguments

- `$object`: The Cloud Storage Object
    - @REF https://cloud.google.com/storage/docs/json_api/v1/objects#resource
- `$attributes`: The attributes for the event (array)
    - …
    - `eventType`:
        - @REF https://cloud.google.com/storage/docs/pubsub-notifications#events
        - @REF https://cloud.google.com/functions/docs/calling/storage

### Invoking the EventHandler

1. Set up some ENV vars to use

    ```bash
    BUCKET_NAME=my-bucket
    GC_PROJECT=my-gcp-project
    GC_REGION=europe-west1
    TRIGGER_NAME=my-trigger
    CONCIS_URL=https://example.org/
    ```

1. Create a Bucket

    ```bash
    gsutil mb "gs://$BUCKET_NAME/" -c "STANDARD" -p $GC_PROJECT -l $GC_REGION
    ```

1. Create a Trigger Notification in the JSON format on your bucket. It will automatically also create a Cloud Pub/Sub Topic.

    ```bash
    gsutil notification create -t $TRIGGER_NAME -f json gs://$BUCKET_NAME
    ```

1. Create a Push Subscription onto the created Cloud Pub/Sub Topic

    ```bash
    gcloud pubsub subscriptions create $TRIGGER_NAME-subscription --project=$GC_PROJECT --topic $TRIGGER_NAME --push-endpoint="$CONCIS_URL"
    ```

1. Trigger a message by uploading a file to your Bucket

    ```bash
    NOW=$(date +%s)
    gsutil cp README.md gs://c-all-data-dev-test-bramus/README-$NOW.md
    ```