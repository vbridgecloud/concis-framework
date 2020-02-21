# Concis Generic Provider

The Generic Provider (namespace `\Concis\Provider\Generic`) is a collection of generic EventHandlers, not linked to a specific vendor. It supports:

Don't forget to register the provider if you want to use its shorthands

```php
\Concis\Concis::registerEventHandlerProviderShorthands(new \Concis\Provider\Generic\GenericProvider());
```

## HTTP

These EventHandlers respond to any generic HTTP request using the `POST`, `PUT`, `GET`, `DELETE`, and `OPTIONS` HTTP methods.

- Class: `\Concis\Provider\Generic\Http\EventHandler`
- Shorthand: `http`

💡 You could compare this type of EventHandler as to deploying a Google Cloud Function using `--trigger-http --allow-unauthenticated`

### Example

```php
$eventHandler = \Concis\EventHandler::http(function (\Symfony\Component\HttpFoundation\Request $request) {
    // Your handling code here …
});
```

### Arguments

- `$request`: Info about the request being made. See [the Symfony Docs](https://symfony.com/doc/current/components/http_foundation.html#request) for more info.

### Invoking the EventHandler

```bash
curl -X GET HTTP_TRIGGER_ENDPOINT
```