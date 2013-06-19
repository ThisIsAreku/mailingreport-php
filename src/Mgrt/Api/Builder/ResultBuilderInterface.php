<?php

namespace Mgrt\Api\Builder;

use Mgrt\Api\Builder\ResultBuilderInterface;
use Mgrt\Api\Response\Response;

interface ResultBuilderInterface
{
    public function getResult(Response $response);
}
