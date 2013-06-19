<?php

namespace Mgrt\Tests\Api\Factory;

use Mgrt\Api\Result\ResultCollection;
use Symfony\Component\Yaml\Yaml;
use Mgrt\Api\Factory\ResultFactory;
use Mgrt\Api\Response\Response;
use Mgrt\Api\Builder\ObjectResultBuilder;
use Mgrt\Api\Builder\ArrayResultBuilder;

class ResultFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $fixtures;

    private $response;

    public function setUp()
    {
        $this->fixtures = $this->getFixtures();
    }

    /**
     * Test ArrayResultBuilder (using by default)
     */
    public function testArrayResultBuilderCollection()
    {
        $resultCollection = $this->getResultFromFixtures('collection', new ArrayResultBuilder());

        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $resultCollection);
        $this->assertSame(count($resultCollection), $this->fixtures['collection']['total']);

        foreach ($resultCollection as $key => $result) {
            $this->assertInternalType('array', $result);
            $this->assertSame($result['id'], $this->fixtures['collection'][$key]['id']);
        }
    }

    /**
     * Test ObjectResultBuilder for collection
     */
    public function testObjectResultBuilderCollection()
    {
        $resultCollection = $this->getResultFromFixtures('collection', new ObjectResultBuilder());

        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $resultCollection);
        $this->assertSame(count($resultCollection), $this->fixtures['collection']['total']);

        $this->assertSame($resultCollection->getLimit(), $this->fixtures['collection']['limit']);
        $this->assertSame($resultCollection->getPage(), $this->fixtures['collection']['page']);
        $this->assertSame($resultCollection->getTotal(), $this->fixtures['collection']['total']);

        foreach ($resultCollection as $key => $result) {
            $this->assertInstanceOf('Mgrt\Api\Result\Result', $result);
            $this->assertSame($result->getId(), $this->fixtures['collection'][$key]['id']);
            $this->assertSame($result->getName(), $this->fixtures['collection'][$key]['name']);
            $this->assertSame($result->getBody(), $this->fixtures['collection'][$key]['body']);
            $this->assertSame($result->getFoo(), null);
        }
    }

    /**
     * Test ObjectResultBuilder for single result
     */
    public function testObjectResultBuilderSingle()
    {
        $result = $this->getResultFromFixtures('result', new ObjectResultBuilder());

        $this->assertInstanceOf('Mgrt\Api\Result\Result', $result);

        $this->assertSame($result->getId(), $this->fixtures['result']['id']);
        $this->assertSame($result->getName(), $this->fixtures['result']['name']);
        $this->assertSame($result->getBody(), $this->fixtures['result']['body']);
        $this->assertSame($result->getCreatedAt(), $this->fixtures['result']['createdAt']);
        $this->assertSame($result->getUpdatedAt(), $this->fixtures['result']['updatedAt']);
        $this->assertSame($result->getFoo(), null);
    }

    public function testObjectResultBuilderError()
    {
        $result = $this->getResultFromFixtures('error', new ObjectResultBuilder());

        $this->assertInstanceOf('Mgrt\Api\Response\Response', $result);
        $this->assertSame($result->isError(), true);
    }

    public function getResultFromFixtures($name, $resultBuilder )
    {
        $response = new Response($this->fixtures[$name]['statusCode'], $this->fixtures[$name]['data']);

        return ResultFactory::create($response, $resultBuilder);
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__.'/../../Fixtures/factory.yml');
    }
}
