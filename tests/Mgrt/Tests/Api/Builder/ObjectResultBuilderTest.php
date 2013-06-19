<?php

namespace Mgrt\Tests\Api\Builder;

use Symfony\Component\Yaml\Yaml;
use Mgrt\Api\Response\Response;
use Mgrt\Api\Builder\ObjectResultBuilder;

class ObjectResultBuilderTest extends \PHPUnit_Framework_TestCase
{
    private $fixtures;

    public function setUp()
    {
        $this->fixtures = $this->getFixtures();
    }

    public function testGetResult()
    {
        // Collection test
        $response = new Response($this->fixtures['collection']['statusCode'], $this->fixtures['collection']['data']);

        $resultBuilder = new ObjectResultBuilder();
        $result = $resultBuilder->getResult($response);

        $current = $result->current();
        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $result, 'Result must be an ResultCollection');
        $this->assertInstanceOf('Mgrt\Api\Result\Result', $current);
        $this->assertSame($current->getId(), $this->fixtures['collection'][0]['id']);
        $this->assertSame($current->getName(), $this->fixtures['collection'][0]['name']);

        // Single result test
        $response = new Response($this->fixtures['collection']['statusCode'], $this->fixtures['result']['data']);
        $resultBuilder  = new ObjectResultBuilder();
        $result = $resultBuilder->getResult($response);

        $this->assertInstanceOf('Mgrt\Api\Result\Result', $result);
        $this->assertSame($result->getId(), $this->fixtures['result']['id']);
        $this->assertSame($result->getName(), $this->fixtures['result']['name']);
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__.'/../../Fixtures/builder.yml');
    }
}
