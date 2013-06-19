<?php

namespace Mgrt\Api\Builder;

use Mgrt\Api\Builder\ResultBuilderInterface;
use Mgrt\Api\Builder\ResultBuilder;
use Mgrt\Api\Result\ResultCollection;
use Mgrt\Api\Result\Result;
use Mgrt\Api\Core\ArrayTools;
use Mgrt\Api\Response\Response;

class ObjectResultBuilder extends ResultBuilder implements ResultBuilderInterface
{
    public function getResult(Response $response)
    {
        $data = $this->parseData($response->getContent());

        if (is_array($data) && $this->hasCollection($data)) {
            $rootKey = ArrayTools::getRootKey($data);

            $collection = new ResultCollection();

            $collection->setMetadata('page', ArrayTools::getParameter($data, 'page', false));
            $collection->setMetadata('limit', ArrayTools::getParameter($data, 'limit', false));
            $collection->setMetadata('total', ArrayTools::getParameter($data, 'total', false));

            foreach ($this->getCollection($data) as $result) {
               $collection->add(new Result($result, true, $rootKey));
            }

            return $collection;
        }

        return new Result($data);
    }
}
