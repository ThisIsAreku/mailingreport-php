<?php

namespace Mgrt\Api\HttpAdapter;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Mgrt\Api\HttpAdapter\HttpAdapterInterface;
use Mgrt\Api\Response\Response;
use Guzzle\Http\Message\Request;
use Guzzle\Http\EntityBody;

/**
 * An adapter for the the guzzle PHP HTTP client.
 */
class GuzzleHttpAdapter implements HttpAdapterInterface
{
    /**
     * @var Guzzle\Http\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username = null;

    /**
     * @var string
     */
    protected $password = null;

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl = null)
    {
        $this->client = new Client($baseUrl);
        $this->client->setUserAgent(sprintf('mgrt-php/%s', \Mgrt\Api\Client\Client::VERSION), true);
        $this->client->setDefaultOption('headers/Accept', 'application/json');
    }

    /**
     * {@inheritDoc}
     */
    public function get($url, array $parameters = null)
    {
        $request = $this->client->get($url);

        if ($parameters) {
            $query = $request->getQuery();
            foreach ($parameters as $key => $value) {
                if ($value) {
                    $query->set($key, $value);
                }
            }
        }

        return $this->getResponse($request);
    }

    /**
     * {@inheritDoc}
     */
    public function post($url, array $parameters)
    {
        $request = $this->client->post(
            $url,
            array('Content-Type' => 'application/x-www-form-urlencoded'),
            EntityBody::factory($parameters)
        );

        return $this->getResponse($request);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($url)
    {
        $request = $this->client->delete($url);

        return $this->getResponse($request);
    }

    /**
     * {@inheritDoc}
     */
    public function put($url, array $parameters = null)
    {
        $request = $this->client->put(
            $url,
            array('Content-Type' => 'application/x-www-form-urlencoded'),
            EntityBody::factory($parameters)
        );

        return $this->getResponse($request);
    }

    /**
     * {@inheritDoc}
     */
    public function patch($url, array $parameters = null)
    {
        $request = $this->client->patch(
            $url,
            array('Content-Type' => 'application/x-www-form-urlencoded'),
            EntityBody::factory($parameters)
        );

        return $this->getResponse($request);
    }

    /**
     * Get the response form a given request
     *
     * @param Guzzle\Http\Message\Request $request
     *
     * @return Mgrt\Api\Response
     */
    private function getResponse(Request $request)
    {
        try {
            $response = $request->setAuth($this->username, $this->password)->send();

            return new Response($response->getStatusCode(), (string) $response->getBody());
        } catch (ClientErrorResponseException $e) {
            return new Response($e->getResponse()->getStatusCode(), (string) $e->getResponse()->getBody());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'guzzle';
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * {@inheritDoc}
     */
    public function setBaseUrl($url)
    {
        $this->client->setBaseUrl($url);
    }
}
