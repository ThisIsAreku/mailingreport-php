<?php

namespace Mgrt\Tests\Api\Response;

use Mgrt\Api\Response\Response;
use Mgrt\Api\Result\ResultCollection;
use Symfony\Component\Yaml\Yaml;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    private $fixtures;

    public function setUp()
    {
        $this->fixtures = $this->getFixtures();
    }

    public function testGetResultAsArray()
    {
        $response = new Response($this->fixtures['collection']['statusCode'], $this->fixtures['collection']['data']);

        $resultCollection = $response->getResult(true);

        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $resultCollection, 'Test instance of');
        $this->assertSame(count($resultCollection), $this->fixtures['collection']['total'], "Test count result");

        foreach ($resultCollection as $key => $result) {
            $this->assertInternalType('array', $result);
            $this->assertSame($result['id'], $this->fixtures['collection'][$key]['id']);
            $this->assertSame($result['name'], $this->fixtures['collection'][$key]['name']);
        }
    }

    public function testGetResultAsObject()
    {
        $response = new Response($this->fixtures['collection']['statusCode'], $this->fixtures['collection']['data']);

        $resultCollection = $response->getResult();

        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $resultCollection, 'Test instance of');
        $this->assertSame(count($resultCollection), $this->fixtures['collection']['total'], "Test count result");

        foreach ($resultCollection as $key => $result) {
            $this->assertInstanceOf('Mgrt\Api\Result\Result', $result);
            $this->assertSame($result->getId(), $this->fixtures['collection'][$key]['id']);
            $this->assertSame($result->getName(), $this->fixtures['collection'][$key]['name']);
        }
    }

    public function testErrorStatusCode()
    {
        $response = new Response($this->fixtures['error']['statusCode'], $this->fixtures['error']['data']);
        $result = $response->getResult(true);

        $this->assertInstanceOf('Mgrt\Api\Response\Response', $result, "Check instance of");
        $this->assertSame($result->isError(), true);
        $this->assertSame($result->getStatusCode(), $this->fixtures['error']['statusCode']);
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__.'/../../Fixtures/factory.yml');
    }
}
