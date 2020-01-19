# guzzle-wrapper

[![GitHub license](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://raw.githubusercontent.com/kevoj/redis-jwt/master/LICENSE)

> This package a simple wrapper for [guzzle/guzzle](https://github.com/guzzle/guzzle).

## Requirements

- [guzzle/guzzle](https://github.com/guzzle/guzzle) **>= 6.0** (**Recommended 6.5**)

## Installation

```bash
composer require sametsahindogan/guzzle-wrapper
```

## Request Usage
**GET**

```php
$api = (new ApiCallBuilder('https://dev.test.com', '/me', ApiCallBuilder::HTTP_GET));

$response = $api->call();
```

**POST**
```php
$api = (new ApiCallBuilder('https://dev.test.com', '/login', ApiCallBuilder::HTTP_POST));

$response = $api->body([ 'Your' => 'Body' ])->call();
```

## Response Usage
```php
$response->getData(); // Parsing response data.
$response->getStatusCode(); // Parsing response status code.
```
## Options

Here are a few optional methods to you can add your chain;
```php
->headers([ 'Your' => 'Headers' ])
->bearerToken(' Your Token ')
->basicAuth(' Your Credantials ')
->formParams([ 'Your' => 'Params' ])
->multipart([ 'Your' => 'Multipart' ])
->queryString(' Your Query String ')
```


## License
MIT © [Samet Sahindogan](https://github.com/sametsahindogan/laravel-jwtredis/blob/master/LICENSE)
