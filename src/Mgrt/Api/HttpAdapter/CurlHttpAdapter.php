<?php

namespace Mgrt\Api\HttpAdapter;

use Mgrt\Api\HttpAdapter\HttpAdapterInterface;
use Mgrt\Api\Response\Response;

class CurlHttpAdapter implements HttpAdapterInterface
{
    /**
     * @var string
     */
    protected $username = null;

    /**
     * @var string
     */
    protected $password = null;

     /**
     * @var string
     */
    protected $baseUrl = null;

    public function __construct($baseUrl = null)
    {
        $this->setBaseUrl($baseUrl);
    }

    /**
     * {@inheritDoc}
     */
    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    /**
     * getCurl
     *
     * @param string $verb
     * @param string $url
     *
     * @return Curl
     */
    protected function getCurl($verb, $url)
    {
        $curl_version = curl_version();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERPWD, sprintf('%s:%s', $this->username, $this->password));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($curl, CURLOPT_URL, sprintf('%s/%s', $this->baseUrl, $url));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($curl, CURLOPT_USERAGENT, sprintf('mgrt-php/%s curl/%s PHP/%s', \Mgrt\Api\Client\Client::VERSION, $curl_version['version'], PHP_VERSION));

        return $curl;
    }

    /**
     * {@inheritDoc}
     */
    public function get($url, array $parameters = null)
    {
        if ($parameters) {
            $paramUrlized = http_build_query($parameters);
            $url = sprintf('%s?%s', $url, $paramUrlized);
        }

        $curl = $this->getCurl('GET', $url);

        return $this->getResponse($curl);
    }

    /**
     * {@inheritDoc}
     */
    public function post($url, array $parameters)
    {
        $curl = $this->getCurl('POST', $url);
        curl_setopt($curl, CURLOPT_POST, count($parameters));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));

        return $this->getResponse($curl);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($url)
    {
        $curl = $this->getCurl('DELETE', $url);

        return $this->getResponse($curl);
    }

    /**
     * {@inheritDoc}
     */
    public function put($url, array $parameters = null)
    {
        $curl = $this->getCurl('PUT', $url);
        if ($parameters) {
            curl_setopt($curl, CURLOPT_POST, count($parameters));
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }

        return $this->getResponse($curl);
    }

    /**
     * {@inheritDoc}
     */
    public function patch($url, array $parameters = null)
    {
        $curl = $this->getCurl('PATCH', $url);
        if ($parameters) {
            curl_setopt($curl, CURLOPT_POST, count($parameters));
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }

        return $this->getResponse($curl);
    }

    /**
     * Get the response form a given request
     *
     * @return Mgrt\Api\Response
     */
    private function getResponse($curl)
    {
        $content = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return new Response($httpCode, $content);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'curl';
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
}
