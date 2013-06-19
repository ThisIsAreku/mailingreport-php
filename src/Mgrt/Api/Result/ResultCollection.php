<?php

namespace Mgrt\Api\Result;

/**
 * ResultCollection
 */
class ResultCollection implements \Iterator, \Countable
{
    /**
     * @var integer
     */
    private $page = null;

    /**
     * @var integer
     */
    private $limit = null;

    /**
     * @var integer
     */
    private $total = null;

    /**
     * @var integer
     */
    private $position = 0;

    /**
     * @var array Store object in the collection
     */
    private $collection = array();

    /**
     * @var array
     */
    private $metadata = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->collection[$this->position];
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    /**
     * Add an object to the end of the collection
     */
    public function add($value)
    {
        $this->collection[count($this->collection)] = $value;
    }

    /**
     * Set an object to the given offset of the collection
     */
    public function set($key, $value)
    {
        $this->collection[$key] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Getter for limit
     *
     * @return integer
     */
    public function getLimit()
    {
        return $this->getMetadata('limit');
    }

    /**
     * Getter for total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->getMetadata('total');
    }

    /**
     * Getter for page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->getMetadata('page');
    }

    public function getMetadata($key)
    {
        return (isset($this->metadata[$key])) ? $this->metadata[$key] : null;
    }

    public function setMetadata($key, $value)
    {
        $this->metadata[$key] = $value;
    }
}
