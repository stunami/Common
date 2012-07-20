<?php

namespace Versionable\Common\Collection;

use \Versionable\Common\Validator\ValidatorInterface;
use \Versionable\Common\Validator\ObjectValidator;

abstract class Collection implements CollectionInterface
{
    private $elements = array();

    private $validator;

    public function __construct(array $elements = array(), ValidatorInterface $validator = null)
    {
        if (null === $validator)
        {
            $validator = new ObjectValidator();
        }
        $this->setValidator($validator);

        $this->doAddAll($elements);
    }

    /**
     * Adds a new element to the collection
     *
     * @return boolean
     */
    public function add($element)
    {
        $this->isValid($element);

        $elements = $this->getElements();

        $elements[] = $element;

        $this->setElements($elements);
    }

    /**
     * Adds all the elements to the array
     *
     * @param CollectionInterface $collection
     */
    public function addAll(CollectionInterface $collection = NULL)
    {
        $elements = $collection->toArray();

        $this->doAddAll($elements);

        return true;
    }

    /**
     * Returns whether a element exists in the collection
     *
     * @return boolean
     */
    public function contains($element)
    {
        return \in_array($element, $this->getElements(), true);
    }

    /**
     *
     * @param CollectionInterface $collection
     * @return boolean
     */
    public function containsAll(CollectionInterface $collection)
    {
        $iterator = $collection->getIterator();
        foreach ($iterator as $element) {
            if (!$this->contains($element)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Implements Countable.
     * Returns the number of elements in the collection
     *
     * @return integer
     */
    public function count()
    {
        return count($this->getElements());
    }

    public function clear()
    {
        $this->setElements(array());
    }

    /**
     * Implements ArrayAgregator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getElements());
    }

    /**
     * Returns the hash code
     *
     * @return string
     */
    public function hashCode()
    {
        return sha1(__CLASS__ . serialize($this->getElements()));
    }

    /**
     * Returns whether the collection is empty or not
     *
     * @return boolean
     */
    public function isEmpty()
    {
        $elements = $this->getElements();
        return empty($elements);
    }

    /**
     * Removes the specified element
     *
     * @return boolean
     */
    public function remove($element)
    {
        $key = array_search($element, $this->getElements());

        if ($key !== false) {
            $elements = $this->getElements();
            unset($elements[$key]);

            $this->setElements(array_merge(array(), $elements));

            return true;
        }

        return false;
    }

    /**
     * Removes all the elements found in the passed collection
     *
     * @param CollectionInterface $collection
     * @return boolean
     */
    public function removeAll(CollectionInterface $collection)
    {
        $iterator = $collection->getIterator();

        foreach ($iterator as $index => $element) {
            if ($this->contains($element)) {
                while (array_search($element, $this->getElements()) !== false) {
                    $this->remove($element);
                }
            }
        }

        return true;
    }

    /**
     * Retains elements that are common to both collections
     *
     * @param CollectionInterface $collection
     * @return boolean
     */
    public function retainAll(CollectionInterface $collection)
    {
        $elements = array();

        $iterator = $collection->getIterator();
        foreach ($iterator as $element) {
            if (\in_array($element, $this->getElements())) {
                $elements[] = $element;
            }
        }

        $this->setElements($elements);

        return true;
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function setElements(array $elements)
    {
        $this->elements = $elements;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Returns the collection elements as an array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getElements();
    }

    protected function doAddAll($elements)
    {
        foreach ($elements as $element) {
            $this->isValid($element);
        }

        $this->setElements(\array_merge($this->getElements(), $elements));
    }

    protected function isValid($element)
    {
        if ($this->getValidator()->isValid($element) === false) {
            throw new \InvalidArgumentException('Invalid element value for collection');
        }
    }

}
