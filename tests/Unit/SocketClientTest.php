<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\StreamSocket\DataModels\ClientStream;

class SocketClientTest extends TestCase
{

    protected function setUp(): void
    {
        $this->socketClient = $this->getMockBuilder(ClientStream::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->socketClient->client = stream_socket_server('tcp://127.0.0.1:0');
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function enableCrypto(): void
    {
        $this->socketClient->method('enableCrypto')->willReturn(true);

        $this->assertTrue($this->socketClient->enableCrypto(true));
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function remoteSocketName(): void
    {
        $this->socketClient->method('remoteSocketName')->willReturn('127.0.0.1:1234');

        $this->assertEquals('127.0.0.1:1234', $this->socketClient->remoteSocketName());
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function localSocketName(): void
    {
        $this->socketClient->method('localSocketName')->willReturn('127.0.0.1:5678');

        $this->assertEquals('127.0.0.1:5678', $this->socketClient->localSocketName());
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function sendto(): void
    {
        $this->socketClient->method('sendto')->willReturn(strlen('test'));

        $this->assertEquals(4, $this->socketClient->sendto('test'));
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function supportsLock(): void
    {
        $this->socketClient->method('supportsLock')->willReturn(true);

        $this->assertTrue($this->socketClient->supportsLock());
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function getOptions(): void
    {
        $options = ['ssl' => ['verify_peer' => true]];

        $this->socketClient->method('getOptions')->willReturn($options);

        $this->assertEquals($options, $this->socketClient->getOptions());
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function getParams(): void
    {
        $params = ['timeout' => 30];

        $this->socketClient->method('getParams')->willReturn($params);

        $this->assertEquals($params, $this->socketClient->getParams());
    }

    /**
     * @test
     *
     * @see ClientStream
     */
    public function close(): void
    {
        $this->socketClient->method('close')->willReturn(true);

        $this->assertTrue($this->socketClient->close());
    }

    protected function tearDown(): void
    {
        if (is_resource($this->socketClient->client)) {
            fclose($this->socketClient->client);
        }
    }
}