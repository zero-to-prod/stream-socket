<?php

namespace Zerotoprod\StreamSocket\DataModels;

use Zerotoprod\StreamSocket\Helpers\DataModel;

/**
 * Represents a SocketClient for handling socket connections with various options.
 *
 * Example:
 * ```
 *  SocketClient::new()
 *      ->set_client($socketResource)
 *      ->set_error_code(0)
 *      ->set_error_message('');
 * ```
 *
 * @method self set_client($client) Open Internet or Unix domain socket connection
 * @method self set_error_code(int $error_code) Will be set to the system level error number if connection fails
 * @method self set_error_message(string $error_message) Will be set to the system level error message if the connection fails.
 *
 * @see  https://github.com/zero-to-prod/stream-socket
 */
class ClientStream
{
    use DataModel;

    public const client = 'client';
    public const error_code = 'error_code';
    public const error_message = 'error_message';

    /**
     * Open Internet or Unix domain socket connection
     *
     * @var false|resource $client
     */
    public $client;
    /**
     * Will be set to the system level error number if connection fails
     *
     * @var int $error_code
     */
    public $error_code;
    /**
     * Will be set to the system level error message if the connection fails.
     *
     * @var string $error_message
     */
    public $error_message;

    /**
     * Turns encryption on/off on an already connected socket
     *
     * Once the crypto settings are established, cryptography
     * can be turned on and off dynamically by passing true or
     * false in the enable parameter.
     *
     *
     *
     * @param  bool           $enable          Enable/disable cryptography on the stream.
     * @param  int|null       $crypto_method   Setup encryption on the stream. Valid methods are
     *                                         STREAM_CRYPTO_METHOD_SSLv2_CLIENT
     *                                         STREAM_CRYPTO_METHOD_SSLv3_CLIENT
     *                                         STREAM_CRYPTO_METHOD_SSLv23_CLIENT
     *                                         STREAM_CRYPTO_METHOD_ANY_CLIENT
     *                                         STREAM_CRYPTO_METHOD_TLS_CLIENT
     *                                         STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT
     *                                         STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT
     *                                         STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
     *                                         STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT (as of PHP 7.4.0)
     *                                         STREAM_CRYPTO_METHOD_SSLv2_SERVER
     *                                         STREAM_CRYPTO_METHOD_SSLv3_SERVER
     *                                         STREAM_CRYPTO_METHOD_SSLv23_SERVER
     *                                         STREAM_CRYPTO_METHOD_ANY_SERVER
     *                                         STREAM_CRYPTO_METHOD_TLS_SERVER
     *                                         STREAM_CRYPTO_METHOD_TLSv1_0_SERVER
     *                                         STREAM_CRYPTO_METHOD_TLSv1_1_SERVER
     *                                         STREAM_CRYPTO_METHOD_TLSv1_2_SERVER
     *                                         STREAM_CRYPTO_METHOD_TLSv1_3_SERVER
     *                                         If omitted, the crypto_method context option on the stream's SSL context will be used instead.
     * @param  resource|null  $session_stream  Seed the stream with settings from session_stream.
     *
     * @return bool|int Returns true on success, false if negotiation has failed or 0 if there isn't enough data and you should try again (only for non-blocking sockets).
     * @link https://www.php.net/manual/en/function.stream-socket-enable-crypto.php
     * @link https://www.php.net/manual/en/stream.constants.php#constant.stream-crypto-method-sslv2-client
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function enableCrypto(bool $enable, ?int $crypto_method = null, $session_stream = null)
    {
        return stream_socket_enable_crypto($this->client, $enable, $crypto_method, $session_stream);
    }

    /**
     * The remote socket to get the name of.
     * A wrapper around `stream_socket_get_name()`
     *
     * @return false|string The name of the socket or false on error.
     *
     * @link https://www.php.net/manual/en/function.stream-socket-get-name.php
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function remoteSocketName()
    {
        return stream_socket_get_name($this->client, true);
    }

    /**
     * The local socket to get the name of.
     * A wrapper around `stream_socket_get_name()`
     *
     * @return false|string The name of the socket or false on error.
     *
     * @link https://www.php.net/manual/en/function.stream-socket-get-name.php
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function localSocketName()
    {
        return stream_socket_get_name($this->client, false);
    }

    /**
     * Sends a message to a socket, whether it is connected or not.
     *
     * Sends the specified data through the socket.
     *
     * A wrapper around `stream_socket_sendto()`
     *
     * @param  string  $data     The data to be sent.
     * @param  int     $flags    The value of flags can be any combination of the following: STREAM_OOB
     * @param  string  $address  The address specified when the socket stream was created will be used unless an alternate address is specified in address.
     *                           If specified, it must be in dotted quad (or [ipv6]) format
     *
     * @return int|false The name of the socket or false on error.
     *
     * @link https://www.php.net/manual/en/function.stream-socket-sendto.php
     * @link https://www.php.net/manual/en/stream.constants.php#constant.stream-oob
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function sendto(string $data, int $flags = 0, string $address = "")
    {
        return stream_socket_sendto($this->client, false);
    }

    /**
     * Tells whether the stream supports locking
     *
     * Tells whether the stream supports locking through flock().
     *
     * A wrapper around `stream_supports_lock()`
     *
     * @return bool Returns true on success or false on failure.
     * @link https://www.php.net/manual/en/function.stream-supports-lock.php
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function supportsLock(): bool
    {
        return stream_supports_lock($this->client);
    }

    /**
     * Returns an array of options on the specified stream or context.
     *
     * @return array an associative array with the options.
     *
     * @link https://www.php.net/manual/en/function.stream-context-get-options.php
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function getOptions(): array
    {
        return stream_context_get_options($this->client);
    }

    /**
     * Retrieves parameter and options information from the stream or context.
     *
     * @return array an associate array containing all context options and parameters.
     *
     * @link https://www.php.net/manual/en/function.stream-context-get-params.php
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function getParams(): array
    {
        return stream_context_get_params($this->client);
    }

    /**
     * Closes the client.
     *
     * @return bool true on success or false on failure.
     *
     * @link https://php.net/manual/en/function.fclose.php
     * @see  https://github.com/zero-to-prod/stream-socket
     */
    public function close(): bool
    {
        return is_bool($this->client)
            ? $this->client
            : fclose($this->client);
    }
}
