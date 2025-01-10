# `Zerotoprod\StreamSocket`

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/stream-socket)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/stream-socket/test.yml?label=tests)](https://github.com/zero-to-prod/stream-socket/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/stream-socket?color=blue)](https://packagist.org/packages/zero-to-prod/stream-socket/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/stream-socket?color=f28d1a)](https://packagist.org/packages/zero-to-prod/stream-socket)
[![GitHub repo size](https://img.shields.io/github/repo-size/zero-to-prod/stream-socket)](https://github.com/zero-to-prod/stream-socket)
[![License](https://img.shields.io/packagist/l/zero-to-prod/stream-socket?color=red)](https://github.com/zero-to-prod/stream-socket/blob/main/LICENSE.md)
[![Hits-of-Code](https://hitsofcode.com/github/zero-to-prod/stream-socket?branch=main)](https://hitsofcode.com/github/zero-to-prod/stream-socket/view?branch=main)

A wrapper for the [`stream_socket_client()`](https://www.php.net/manual/en/function.stream-stream-socket.php) method.

It provides classes that define all the options for this method.

## Installation

To install this package, add it to your composer.json file and run composer install:

```shell
composer require zero-to-prod/stream-socket
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