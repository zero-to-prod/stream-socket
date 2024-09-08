# `Zerotoprod\StreamSocket`

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/stream-socket)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/zero-to-prod/stream-socket.svg)](https://packagist.org/packages/zero-to-prod/stream-socket)
![test](https://github.com/zero-to-prod/stream-socket/actions/workflows/phpunit.yml/badge.svg)
![Downloads](https://img.shields.io/packagist/dt/zero-to-prod/stream-socket.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/zero-to-prod/stream-socket&#41)

A wrapper for the [`stream_socket_client()`](https://www.php.net/manual/en/function.stream-stream-socket.php) method.

It provides classes that define all the options for this method.

## Installation

To install this package, add it to your composer.json file and run composer install:

```shell
composer require zerotoprod/stream-socket
```

## Usage

```php
use Zerotoprod\StreamSocket\StreamSocket;

StreamSocket::client(
    'ssl://'.$url.':'. 443,
    30
    STREAM_CLIENT_CONNECT,
    stream_context_create()
);

echo $SocketClient->remoteSocketName(); // 34.223.124.45:443

$SocketClient->close();
```