<?php

namespace Mgrt\Tests\Api\Client;

use Mgrt\Api\Client\Client;
use Mgrt\Api\HttpAdapter\GuzzleHttpAdapter;
use Mgrt\Api\HttpAdapter\CurlHttpAdapter;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mgrt\Api\Client
     */
    private $client;

    /**
     * @var array()
     */
    private $httpAdapters = array();

    public function setUp()
    {
        $this->httpAdapters = array(
            'guzzle' => new GuzzleHttpAdapter(),
            'curl'   => new CurlHttpAdapter()
        );

        $this->client = new Client();
        $this->client->setHttpAdapter($this->httpAdapters['guzzle']);
    }

    public function testConstructor()
    {
        $curlHttpAdapter = new CurlHttpAdapter();
        $client = new Client($curlHttpAdapter);

        $this->assertInstanceOf('Mgrt\Api\HttpAdapter\CurlHttpAdapter', $client->getHttpAdapter());
    }

    public function testGet()
    {
        $arrayParameters[] = 'templates/1';
        $arrayParameters[] = array('page' => 1);

        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);
            $result = call_user_func_array(array($this->client, 'get'), $arrayParameters);
            $this->assertSame($result->getStatusCode(), 401, sprintf('Check if method return a correct response. Error in the function "%s"', 'get')); // If we got a 401 we are on a api route (no credentials) else we are not on a api route
            $this->assertSame($httpAdapter->getName(), $name);
        }
    }

    public function testDelete()
    {
        $arrayParameters[] = 'templates/1';

        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);
            $result = call_user_func_array(array($this->client, 'delete'), $arrayParameters);
            $this->assertSame($result->getStatusCode(), 401, sprintf('Check if method return a correct response. Error in the function "%s"', 'delete')); // If we got a 401 we are on a api route (no credentials) else we are not on a api route
        }
    }

    public function testPost()
    {
        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);
            $result = call_user_func_array(array($this->client, 'post'), array(
                'templates',
                array(
                    'name' => 'test name',
                    'body' => 'test body'
                )
            ));
            $this->assertSame($result->getStatusCode(), 401, sprintf('Check if method return a correct response. Error in the function "%s"', 'post')); // If we got a 401 we are on a api route (no credentials) else we are not on a api route
        }
    }

    public function testPut()
    {
        $arrayParameters[] = 'templates/1';
        $arrayParameters[] = array('template' => array(
            'name' => 'test name',
            'body' => 'test body'
        ));

        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);
            $result = call_user_func_array(array($this->client, 'put'), $arrayParameters);
            $this->assertSame($result->getStatusCode(), 401, sprintf('Check if method return a correct response. Error in the function "%s"', 'put')); // If we got a 401 we are on a api route (no credentials) else we are not on a api route
        }
    }

    public function testPatch()
    {
        $arrayParameters[] = 'templates/1';
        $arrayParameters[] = array('template' => array(
            'name' => 'test name',
            'body' => 'test body'
        ));

        foreach ($this->httpAdapters as $name => $httpAdapter) {
            $this->client->setHttpAdapter($httpAdapter);
            $result = call_user_func_array(array($this->client, 'patch'), $arrayParameters);
            $this->assertSame($result->getStatusCode(), 401, sprintf('Check if method return a correct response. Error in the function "%s"', 'patch')); // If we got a 401 we are on a api route (no credentials) else we are not on a api route
        }
    }
}
