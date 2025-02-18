<?php

namespace Zerotoprod\StreamSocket;

use Zerotoprod\StreamSocket\DataModels\ClientStream;

/**
 * A wrapper for stream_socket_client()
 *
 * @link https://github.com/zero-to-prod/stream-socket
 */
class StreamSocket
{
    /**
     * A wrapper around `stream_socket_client()`.
     *
     * Example
     * ```
     *  StreamSocket::client(
     *      'ssl://example.com:443',
     *      30
     *      STREAM_CLIENT_CONNECT,
     *      stream_context_create()
     *  );
     * ```
     *
     * @param  string      $address
     * @param  float|null  $timeout
     * @param  int         $flags
     * @param  resource    $context
     *
     * @return ClientStream
     * @link https://www.php.net/manual/en/function.stream-stream-socket.php
     * @see  https://github.com/zero-to-prod/stream-socket
     * @link https://github.com/zero-to-prod/stream-socket
     */
    public static function client(string $address, ?float $timeout, int $flags = STREAM_CLIENT_CONNECT, $context = null): ClientStream
    {
        return ClientStream::from([
            ClientStream::client => stream_socket_client(
                $address,
                $error_code,
                $error_message,
                $timeout,
                $flags,
                $context ?? stream_context_create()
            ),
            ClientStream::error_code => $error_code,
            ClientStream::error_message => $error_message,
        ]);
    }
}
