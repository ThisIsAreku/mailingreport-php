<?php

namespace Mgrt\Api\Builder;

use Mgrt\Api\Builder\ResultBuilderInterface;
use Mgrt\Api\Builder\ResultBuilder;
use Mgrt\Api\Result\ResultCollection;
use Mgrt\Api\Response\Response;

class ArrayResultBuilder extends ResultBuilder implements ResultBuilderInterface
{
    public function getResult(Response $response)
    {
        $data = $this->parseData($response->getContent());

        if ($this->hasCollection($data)) {
            $collection = new ResultCollection();
            foreach ($this->getCollection($data) as $result) {
               $collection->add($result);
            }

            return $collection;
        }

        return $data;
    }
}
