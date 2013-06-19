<?php

namespace Mgrt\Api\Client;

use Mgrt\Api\HttpAdapter\GuzzleHttpAdapter;
use Mgrt\Api\HttpAdapter\HttpAdapterInterface;
use Mgrt\Api\Response\Response;

/**
 * Mgrt Client
 */
class Client
{
    /**
     * @var string
     */
    protected $baseUrl = "https://api.mgrt.net";

    const VERSION = '1.0.0';

    /**
     * @var Mgrt\Api\HttpAdapter\HttpAdapterInterface
     */
    protected $httpAdapter = null;

    /**
     * Constructor
     *
     * @param Mgrt\Api\HttpAdapter\HttpAdapterInterface $httpAdapter
     */
    public function __construct(HttpAdapterInterface $httpAdapter = null)
    {
        if ($httpAdapter == null) {
            $this->setHttpAdapter($this->getDefaultAdapter());
        } else {
            $this->setHttpAdapter($httpAdapter);
        }
    }

    /**
     * Return API entry point path
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * get the default adapter
     *
     * @return HttpAdapterInterface
     */
    private function getDefaultAdapter()
    {
        return new GuzzleHttpAdapter($this->baseUrl);
    }

    /**
     * setHttpAdapter
     *
     * @param HttpAdapterInterface $httpAdapter
     *
     * @return self
     */
    public function setHttpAdapter(HttpAdapterInterface $httpAdapter)
    {
        $this->httpAdapter = $httpAdapter;
        $this->httpAdapter->setBaseUrl($this->baseUrl);

        return $this;
    }

    /**
     * Get http adapter
     *
     * @return Mgrt\Api\HttpAdapter\HttpAdapterInterface
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
    }

    /**
     * Shortcut for GET adapter method
     *
     * @param string $resource
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function get($resource, $parameters = null)
    {
        return $this->getHttpAdapter()->get($resource, $parameters);
    }

    /**
     * Shortcut for POST adapter method
     *
     * @param string $resource
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function post($resource, $parameters = null)
    {
        return $this->getHttpAdapter()->post($resource, $parameters);
    }

     /**
     * Shortcut for PUT adapter method
     *
     * @param string $resource
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function put($resource, $parameters = array())
    {
        return $this->getHttpAdapter()->put($resource, $parameters);
    }

     /**
     * Shortcut for PATCH adapter method
     *
     * @param string $resource
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function patch($resource, $parameters = array())
    {
        return $this->getHttpAdapter()->patch($resource, $parameters);
    }

     /**
     * Shortcut for DELETE adapter method
     *
     * @param string $resource
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function delete($resource)
    {
        return $this->getHttpAdapter()->delete($resource);
    }
}
