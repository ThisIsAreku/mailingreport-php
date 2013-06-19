<?php

namespace Mgrt\Tests\Api\Builder;

use Symfony\Component\Yaml\Yaml;
use Mgrt\Api\Response\Response;
use Mgrt\Api\Builder\ResultBuilder;

class ResultBuilderTest extends \PHPUnit_Framework_TestCase
{
    private $fixtures;

    public function setUp()
    {
        $this->fixtures = $this->getFixtures();
    }

    public function testSetResponse()
    {
        $testStatusCode = 200;
        $testContent = 'test';

        $response = new Response($testStatusCode, $testContent);

        $builder = new ResultBuilder();
        $builder->setResponse($response);

        $result = $builder->getResponse();
        $this->assertInstanceOf('Mgrt\Api\Response\Response', $result);
        $this->assertSame($result->getStatusCode(), $testStatusCode);
        $this->assertSame($result->getContent(), $testContent);
    }

    public function testGetResult()
    {
        $response = new Response($this->fixtures['collection']['statusCode'], $this->fixtures['collection']['data']);

        $resultBuilder  = new ResultBuilder();
        $result = $resultBuilder->getResult($response);
        $this->assertInternalType('array', $result['templates']['results'][0], 'Result must be an array');

        $this->assertSame($result['templates']['results'][0]['id'], $this->fixtures['result']['id']);
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__.'/../../Fixtures/builder.yml');
    }
}
