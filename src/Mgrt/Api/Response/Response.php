<?php

namespace Mgrt\Api\Response;

use Mgrt\Api\Factory\ResultFactory;
use Mgrt\Api\Builder\ObjectResultBuilder;
use Mgrt\Api\Builder\ArrayResultBuilder;

class Response
{
    /**
     * @var array
     */
    private $successCodes = array(200, 201, 204);

    /**
     * @var integer
     */
    private $statusCode;

    /**
     * @var string
     */
    private $content;

    public function getResult($asArray = false)
    {
        if ( $this->isSuccessful()) {

            if (true === $asArray) {
                return  ResultFactory::create($this,  new ArrayResultBuilder());
            }

            return  ResultFactory::create($this, new ObjectResultBuilder());
        } else {
            return $this;
        }
    }

    /**
     * Constructor
     *
     * @param integer $statusCode
     * @param string  $content    Default is null
     */
    public function __construct($statusCode, $content = null)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    /**
     * getStatusCode
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * getContent
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Check if the response is successfull
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if (in_array($this->getStatusCode(), $this->successCodes)) {
            return true;
        }

        return false;
    }

    /**
     * Check if it is an error response
     *
     * @return boolean
     */
    public function isError()
    {
        if ($this->isSuccessful()) {
            return false;
        }

        return true;
    }
}
