<?php

namespace Mgrt\Api\Result;

use Doctrine\Common\Inflector\Inflector;
use Mgrt\Api\Core\ArrayTools;

class Result
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * @var boolean
     */
    private $disableRootKey;

    private $resultType = null;

    /**
     * Constructor
     *
     * @param array   $data
     * @param boolean $disableRootKey Default is false
     */
    public function __construct(array $data, $disableRootKey = false, $collectionRootKey = null)
    {
        $this->data = $data;
        $this->disableRootKey = $disableRootKey;

        $this->setResultType($collectionRootKey);
    }

    /**
     * Magic method get
     *
     * @{inheritedDoc}
     *
     * @return mixed
     */
    public function __call($name, $arguments = array())
    {
        if (substr($name, 0, 3) == 'get') {
            $parameter = Inflector::tableize(substr($name, 3));
        }

        if ($value = ArrayTools::getParameter($this->data, $parameter, $this->disableRootKey)) {

            // Render nested values as Result object (if first argument is true)
            if (!isset($arguments[0]) || ( isset($arguments[0]) && $arguments[0] != true)) {
                if (is_array($value) && !in_array($parameter, array('links'))) {

                    $resultValues = array();
                    foreach ($value as $key => $val) {
                        $resultValues[$key] = new Result($val, true, $parameter);
                    }

                    return $resultValues;
                }
            }

            return $value;
        }

        return null;
    }

    public function getResultType()
    {
        return $this->resultType;
    }

    protected function setResultType($collectionRootKey = null)
    {
        $this->resultType = Inflector::singularize(($collectionRootKey == null ) ? ArrayTools::getRootKey($this->data) : $collectionRootKey);
    }

    public function getParameter($key)
    {
        return ArrayTools::getParameter($this->data, $key, $this->disableRootKey);
    }
}
