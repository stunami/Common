<?php

namespace Versionable\Common\Collection;

use Versionable\Common\Compare\ComparableInterface;

interface CollectionInterface extends \IteratorAggregate, \Countable
{

    /**
     *
     * @return boolean
     */
    public function add($element);

    /**
     *
     * @return boolean
     */
    public function addAll(CollectionInterface $collection);

    /**
     *
     */
    public function clear();

    /**
     *
     * @return boolean
     */
    public function contains($element);

    /**
     *
     * @return boolean
     */
    public function containsAll(CollectionInterface $collection);

    /**
     *
     * @return string
     */
    public function hashCode();

    /**
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     *
     * @return boolean
     */
    public function remove($element);

    /**
     *
     * @return boolean
     */
    public function removeAll(CollectionInterface $collection);

    /**
     *
     * @return boolean
     */
    public function retainAll(CollectionInterface $collection);

    /**
     *
     * @return array
     */
    public function toArray();
}
