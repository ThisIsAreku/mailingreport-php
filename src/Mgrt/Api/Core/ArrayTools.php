<?php

namespace Mgrt\Api\Core;

class ArrayTools
{
    /**
     * Get the routing key of an array ie : array('foo' => array('bar' =>'foobar'))
     * The rootKey will be foo
     *
     * @param array $data
     *
     * @return string the root key
     */
    public static function getRootKey(array $data)
    {
        $rootKey = array_keys($data);

        return array_shift($rootKey);
    }

    /**
     * Check if the parameter of an array exists and return it
     *
     * @param array   $data           The haystack
     * @param string  $key            The needle
     * @param boolean $disableRootKey
     *
     * @return mixed
     */
    public static function getParameter(array $data, $key, $disableRootKey)
    {
        $value = null;
        if ($disableRootKey == true) {
            if (isset($data[$key])) {
                $value = $data[$key];
            }
        } else {
            if (isset($data[self::getRootKey($data)][$key])) {
                $value = $data[self::getRootKey($data)][$key];
            }
        }

        return $value;
    }
}
