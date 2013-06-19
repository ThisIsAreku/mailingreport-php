<?php

namespace Mgrt\Tests\Api\Client;

use Mgrt\Api\Client\HttpBasicClient;
use Mgrt\Api\HttpAdapter\GuzzleHttpAdapter;
use Mgrt\Api\HttpAdapter\CurlHttpAdapter;

class HttpBasicClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mgrt\Api\Client
     */
    private $client;

     /**
     * @var Mgrt\Api\HttpAdapter\HttpAdapterInterface
     */
    private $httpAdapters;

    public function setUp()
    {
        $this->client = new HttpBasicClient();

        $this->httpAdapters = array(
            'guzzle' => new GuzzleHttpAdapter(),
            'curl'   => new CurlHttpAdapter()
        );

        $this->httpAdapter = new GuzzleHttpAdapter();
        $this->client->setHttpAdapter($this->httpAdapters['guzzle']);
    }

    public function testSetUsername()
    {
        $expectedUserName = 'foo';

        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);

            $this->client->setUsername($expectedUserName);
            $reflector = new \ReflectionProperty($httpAdapter, 'username');
            $reflector->setAccessible(true);
            $this->assertSame($reflector->getValue($httpAdapter), $expectedUserName);
        }
    }

    public function testSetPassword()
    {
        $expectedPassword = 'bar';

        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);
            $this->client->setPassword($expectedPassword);
            $reflector = new \ReflectionProperty($httpAdapter, 'password');
            $reflector->setAccessible(true);
            $this->assertSame($reflector->getValue($httpAdapter), $expectedPassword);
        }
    }
}
