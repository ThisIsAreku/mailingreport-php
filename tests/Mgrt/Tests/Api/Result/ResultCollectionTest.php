<?php

namespace Mgrt\Tests\Api\Result;

use Symfony\Component\Yaml\Yaml;
use Mgrt\Api\Builder\ObjectResultBuilder;
use Mgrt\Api\Response\Response;
use Mgrt\Api\Factory\ResultFactory;

class ResultCollectionTest extends \PHPUnit_Framework_TestCase
{
    private $fixtures;

    public function setUp()
    {
        $this->fixtures = $this->getFixtures();
    }

    public function testCollection()
    {
        $resultCollection = $this->getResultFromFixtures('collection', new ObjectResultBuilder());
        $this->assertInstanceOf('Mgrt\Api\Result\ResultCollection', $resultCollection);

        $this->assertSame(count($resultCollection), $this->fixtures['collection']['total']);
    }

    public function getResultFromFixtures($name, $resultBuilder )
    {
        $response = new Response($this->fixtures[$name]['statusCode'], $this->fixtures[$name]['data']);

        return ResultFactory::create($response, $resultBuilder);
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__ . '/../../Fixtures/factory.yml');
    }
}
