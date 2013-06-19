<?php

namespace Mgrt\Tests\Api\Builder;

use Symfony\Component\Yaml\Yaml;
use Mgrt\Api\Response\Response;
use Mgrt\Api\Builder\ArrayResultBuilder;

class ArrayResultBuilderTest extends \PHPUnit_Framework_TestCase
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

        $resultBuilder  = new ArrayResultBuilder();
        $result         = $resultBuilder->getResult($response);
        $current        = $result->current();

        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $result, 'Result must be an ResultCollection');
        $this->assertInternalType('array', $current);
        $this->assertSame($current['id'], $this->fixtures['result']['id']);

        // Single result test
        $response = new Response($this->fixtures['collection']['statusCode'], $this->fixtures['result']['data']);
        $resultBuilder  = new ArrayResultBuilder();
        $result         = $resultBuilder->getResult($response);

        $this->assertInternalType('array', $result);

        $resultKeys = array_keys($result);
        $firstKey = array_shift($resultKeys);
        $this->assertSame($firstKey, $this->fixtures['result']['key']);
        $this->assertSame($result[$firstKey]['id'], $this->fixtures['result']['id']);
        $this->assertSame($result[$firstKey]['name'], $this->fixtures['result']['name']);
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__.'/../../Fixtures/builder.yml');
    }
}
