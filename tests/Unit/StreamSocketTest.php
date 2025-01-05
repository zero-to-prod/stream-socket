<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\StreamSocket\StreamSocket;

class StreamSocketTest extends TestCase
{

    /**
     * @return array
     */
    public static function urls(): array
    {
        return [
            'neverssl.com' => ['neverssl.com'],
            'google.com' => ['google.com'],
        ];
    }

    /**
     * @test
     * @dataProvider urls
     *
     * @see          StreamSocket
     */
    public function can_create_client(string $url): void
    {
        $SocketClient = StreamSocket::client(
            'ssl://'.$url.':'. 443,
            30,
            STREAM_CLIENT_CONNECT,
            stream_context_create()
        );

        $this->assertNotNull($SocketClient->remoteSocketName());

        $SocketClient->close();
    }
}