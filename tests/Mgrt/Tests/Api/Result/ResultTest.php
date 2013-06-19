<?php

namespace Mgrt\Tests\Api\Result;

use Mgrt\Api\Result\Result;
use Symfony\Component\Yaml\Yaml;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    public function testGetter()
    {
        $fixtures = $this->getFixtures();
        $result = new Result(json_decode($fixtures['success']['data'], true));

        $this->assertSame($result->getId(), $fixtures['success']['id'], "test defined");
        $this->assertSame($result->getFoo(), null, 'test undefined variable');
        $this->assertSame($result->getCreatedAt(), $fixtures['success']['created_at'], 'test camelCase');
        $this->assertSame($result->get(), null, 'just get !');
        $this->assertSame($result->getResultType(), 'template', 'Test result type');

        $this->assertSame($result->getParameter('id'), $fixtures['success']['id'], 'Test getParameter with "id"');
        $this->assertSame($result->getParameter('name'), $fixtures['success']['name'], 'Test getParameter with "name"');
    }

    public function testCall()
    {
        $fixtures = $this->getFixtures();
        $result = new Result(json_decode($fixtures['contact']['data'], true));
        $customFields = $result->getCustomFields();

        $firstCustomField = array_shift($customFields);

        $this->assertSame($result->getId(), $fixtures['contact']['id'], "Test id");
        $this->assertInstanceOf('Mgrt\Api\Result\Result', $firstCustomField, 'Test first custom field class');
        $this->assertSame($firstCustomField->getId(), $fixtures['contact']['first_custom_field_id'], 'First custom field id');
        $this->assertSame($firstCustomField->getName(), $fixtures['contact']['first_custom_field_name'], 'First custom field name');
        $this->assertSame($firstCustomField->getValue(), $fixtures['contact']['first_custom_field_value'], 'First custom field value');
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__ . '/../../Fixtures/result.yml');
    }
}
