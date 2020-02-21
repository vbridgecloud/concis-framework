# 🤏 Concis – PHP Serverless Functions Framework (WIP)

Serverless Functions are great, but unfortunately Google Cloud Platform (and other cloud vendors) don't support PHP. Let's fill that gap.

## Introduction

Concis [kɔ̃si] is a PHP Serverless Functions Framework that allows you to register functions which will respond to a certain trigger. Triggers have an external origin and are, for example, an incoming HTTP Request or a Cloud Pub/Sub Message Event.

Concis comes with several [Providers](#concis-providers) which provide you with a handful of EventHandlers _(and accompanying abstractions / date types)_ that allow you to easily respond and work with these different types of triggers.

A Concis EventHandler can run on any webserver with PHP, or through one of the [Runtime Containers](#concis-runtimes).

## Inner Workings: Request & Response

Concis uses `symfony/http-foundation` internally, utilizing its `Symfony\Component\HttpFoundation\Request` and `Symfony\Component\HttpFoundation\Response` classes.

A Concis EventHandler is expected to take a `Symfony\Component\HttpFoundation\Request` instance as its input, and return a `Symfony\Component\HttpFoundation\Response` instance which will be sent to the client.

However:

1. Providers can, and should, pre-process the `Symfony\Component\HttpFoundation\Request` instance and pass their extracted info into their registered Callbacks.
    
    _For example: The `CloudStorage` Concis EventHandler from the `GCPCloud` Provider will parse the POSTed JSON-message and build a `CloudStorageObject` instance from that JSON. It is not the `Request` object but the `CloudStorageObject` object that will then be passed into the registered function._

1. If no `Response` instance is returned from a Concis EventHandler, Concis will try and cast it to a `Response`:

    1. If a `string` is returned from a Concis EventHandler, Concis will create a new `Response` instance with the returned `string` set as its content and send that.
    1. If no response at all is returned from a Concis EventHandler, Concis will create a new – empty – `Response` instance and send that.

    _Note: By default `Response` instances have a HTTP Status Code of 200, so that will be used in the two scenarios listed above._

## Basic Example

### EventHandler Examples

- An EventHandler that responds to a simple HTTP Request:

    ```php
    $eventHandler = new \Concis\Provider\Generic\Http\EventHandler(function(\Symfony\Component\HttpFoundation\Request $request) {
        $name = $request->query->get('name', 'Concis');
        return new \Symfony\Component\HttpFoundation\Response("Hello, " . htmlspecialchars($name, ENT_QUOTES));
    });
    ```

- An EventHandler that responds to a Message being published on Google Cloub Pub/Sub:

    ```php
    $eventHandler = new \Concis\Provider\GCPCloud\Pubsub\EventHandler(function(string $topic, \Concis\Provider\GCPCloud\Pubsub\Datatype\PubsubMessage $message) {
        $data = $message->getJsonData(true);
        // …
    });
    ```

### Running the Examples

To run one of these sample EventHandlers we'll use a simple `index.php` file which we'll upload to a webserver.

```php
$concis = new \Concis\Concis();

$eventHandler = /* … */
$request = Request::createFromGlobals();

$response = $concis->handle(
    $request,
    $eventHandler
);

$response->send();
```

Alternatively we can use one of the [Concis Runtimes](#concis-runtimes)

## Concis Providers

Out of the box Concis comes with these providers:

- [Generic Provider](docs/provider-generic.md)
- [Google Cloud Platform Provider](docs/provider-gcpcloud.md)

Please refer to each provider's documentation on how to use them.

_(Submit a PR with your own Provider to have Concis support more platforms/triggers)_

## Shorthands

Concis allows EventHandlers to be accessed using a shorthand. That way your code becomes even more concise.

```php
// Without shorthand:
$eventHandler = new \Concis\Provider\Generic\Http\EventHandler(function(\Symfony\Component\HttpFoundation\Request $request) {
	// …
});

// With shorthand:
$eventHandler = \Concis\EventHandler::http(function(\Symfony\Component\HttpFoundation\Request $request) {
	// …
});
```

Before you can use any of these shorthands, you'll need to register the provider with Concis. For example:

```php
\Concis\Concis::registerProviderShorthands(new \Concis\Provider\Generic\Provider());
\Concis\Concis::registerProviderShorthands(new \Concis\Provider\GCPCloud\Provider());
```

## Concis Runtimes

@TODO

## FAQ

### Do I need Google Cloud Platform?

No you don't. You can run EventHandlers on any infrastructure.

### Can I used Concis without any of the Google Platform integrated triggers?

Yes, you can use the generic HTTP Trigger.

### From where the name Concis?

There's a popular PHP Functions Framework for AWS that is named Bref. Concis is a synonym of Bref.

## Tests

@TODO 😅

## License

Concis is released under the MIT License (MIT). See the enclosed [`LICENSE`](LICENSE) for details.