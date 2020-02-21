# 🤏 Concis – PHP Serverless Functions Framework

Serverless Functions are great, but unfortunately Google Cloud Platform (and other cloud vendors) don't support PHP. Let's fill that gap.

## Introduction

These are two Concis Demos for you to check out.

## Prerequites

- Run `composer install` in the project root
- Valet or PHP's built-in server

## Running the demos

### Using Valet

```bash
# Install dependencies in project root
cd /path/to/concis/
composer install

# Serve the example/html folder using valet
cd example/generic/http
valet link concis
valet secure

# Test HTTP Trigger
open https://concis.test/
```

### Using PHP's built-in server

```bash
# Install dependencies in project root
cd /path/to/concis/
composer install

# Serve the example/html folder using valet
php -S localhost:8080 -t example/generic/http

# Test HTTP Trigger
open http://localhost:8080/
```
