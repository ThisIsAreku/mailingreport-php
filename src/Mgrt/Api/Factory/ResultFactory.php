<?php

namespace Mgrt\Api\Factory;

use Mgrt\Api\Response\Response;
use Mgrt\Api\Builder\ResultBuilderInterface;
use Mgrt\Api\Builder\ArrayResultBuilder;

class ResultFactory
{
    public static function create(Response $response, ResultBuilderInterface $resultBuilder = null)
    {
        if ($response->isError()) {
           return $response;
        }

        $resultBuilder = self::getResultBuilder($resultBuilder);

        return $resultBuilder->getResult($response);
    }

    protected static function getResultBuilder(ResultBuilderInterface $resultBuilder = null)
    {
        return (null == $resultBuilder) ? new ArrayResultBuilder() : $resultBuilder;
    }
}
