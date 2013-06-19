<?php

namespace Mgrt\Tests\Api\Client;

use Mgrt\Api\Client\Client;
use Mgrt\Api\Client\MRApiClient;
use Symfony\Component\Yaml\Yaml;

class MRApiClientTest extends \PHPUnit_Framework_TestCase
{
    private $apiClient;
    private $httpAdapter;
    private $fictures;

    public function setUp()
    {
        $this->fixtures = $this->getFixtures();
        $this->apiClient = new MRApiClient();
    }

    public function testAllRoutes()
    {

        $clientMethods = $this->getClientMethods();

        $reflectionObject = new \ReflectionObject($this->apiClient);
        foreach ($reflectionObject->getMethods() as $method) {

            if (!in_array($method->getName(), $clientMethods)) {

                $arrayParameters = array();

                foreach ($method->getParameters() as $key => $parameter) {
                    if ($parameter->isArray()) {
                        $arrayParameters[] = array('foo' => 'bar');
                    } else {
                        $arrayParameters[] = 1;
                    }
                }

                $result = call_user_func_array(array($this->apiClient, $method->getName()), $arrayParameters);
                $this->assertSame($result->getStatusCode(), 401, sprintf('Check if the route exists. Error in the function "%s"',$method->getName())); // If we got a 401 we are on a api route (no credentials) else we are not on a api route
            }
        }

    }

    private function getClientMethods()
    {
        $client = new Client();
        $clientMethods = array();

        $reflectionClient = new \ReflectionObject($client);
        foreach ($reflectionClient->getMethods() as $method) {
            $clientMethods[] = $method->getName();
        }

        return $clientMethods;
    }

    public function getFixtures()
    {
        return Yaml::parse(__DIR__ . '/../../Fixtures/factory.yml');
    }
}
