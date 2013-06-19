<?php

namespace Mgrt\Api\Builder;

use Mgrt\Api\Builder\ResultBuilderInterface;
use Mgrt\Api\Core\ArrayTools;
use Mgrt\Api\Response\Response;

class ResultBuilder implements ResultBuilderInterface
{
    /**
     * @var Mgrt\Api\Response\Response
     */
    protected $response;

    /**
     * Return the result
     *
     * @param  Response $response [description]
     * @return [type]   [description]
     */
    public function getResult(Response $response)
    {
        $data = $this->parseData($response->getContent());

        return $data;
    }

    /**
     * Parse and convert input data from json string to associative array
     *
     * @param  string  $responseContent json string
     * @param  boolean $assoc           If true return associative array
     * @return array
     */
    protected function parseData($responseContent, $assoc = true)
    {
        return json_decode($responseContent, $assoc);
    }

    /**
     * Check if given data contains a collection of results
     *
     * @param  string  $data Data to test, json string
     * @return boolean false or collection
     */
    protected function hasCollection($data)
    {
        return $this->getCollection($data);
    }

    /**
     * Return collection
     *
     * @param  string $data Data to test, json string
     * @return array
     */
    protected function getCollection($data)
    {
        return ArrayTools::getParameter($data, 'results', false);
    }

    /**
     * Set response
     *
     * @param Mgrt\Api\Response\Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Get response
     *
     * @return Mgrt\Api\Response\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
