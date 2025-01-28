<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Zerotoprod\StreamSocket\StreamSocket;

class StreamSocketTest extends TestCase
{

    public static function urls(): array
    {
        return [
            'neverssl.com' => ['neverssl.com'],
            'google.com' => ['google.com'],
        ];
    }

    #[DataProvider('urls')]
    #[Test] public function can_create_client(string $url): void
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

    #[DataProvider('urls')]
    #[Test] public function can_create_client_without_context(string $url): void
    {
        $SocketClient = StreamSocket::client(
            'ssl://'.$url.':'. 443,
            30
        );

        $this->assertNotNull($SocketClient->remoteSocketName());

        $SocketClient->close();
    }
}