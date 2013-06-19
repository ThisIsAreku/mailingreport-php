<?php

namespace Mgrt\Api\HttpAdapter;

/**
 * Interface for http adapters
 */
interface HttpAdapterInterface
{
    /**
     * Set the base URL of the client
     *
     * @param string $url The base service endpoint URL of the webservice
     *
     * @return HttpAdapterInterface
     */
    public function setBaseUrl($url);

    /**
     * Returns the content fetched from a given URL.
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function get($url, array $parameters = null);

    /**
     * Post
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function post($url, array $parameters);

    /**
     * Put
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function put($url, array $parameters = null);

    /**
     * Patch
     *
     * @param string $url
     * @param array  $parameters
     *
     * @return Mgrt\Api\Response
     */
    public function patch($url, array $parameters = null);

    /**
     * Delete
     *
     * @param string $url
     *
     * @return Mgrt\Api\Response
     */
    public function delete($url);

    /**
     * Returns the name of the HTTP Adapter.
     *
     * @return string
     */
    public function getName();

    /**
     * set Authentification user name
     *
     * @param string $username
     */
    public function setUsername($username);

    /**
     * Set the authentification password
     *
     * @param $password
     */
    public function setPassword($password);
}
