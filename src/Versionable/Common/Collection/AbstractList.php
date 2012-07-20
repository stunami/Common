<?php

namespace Versionable\Common\Collection;

abstract class AbstractList extends Collection implements ListInterface
{
    public function __construct(array $elements = array(), ValidatorInterface $validator = null)
    {
        parent::__construct($elements, $validator);
    }

    /**
     * Inserts the specified element at the specified position in this list.
     * Shifts the element currently at that position (if any) and any subsequent elements to the right (adds one to their indices).
     *
     * @param integer $index
     * @param mixed $element
     * @return <type>
     */
    public function addAt($index, $element)
    {
        $this->isValid($element);

        if ($index == 0 || $index < $this->count()) {

            $elements = $this->getElements();

            $elements[$index] = $element;

            $this->setElements($elements);

            return true;
        }

        throw new \OutOfBoundsException('Invalid index');
    }

    public function addAllAt($index, ListInterface $list)
    {
        foreach ($list as $element) {
            $this->isValid($element);
        }

        $start = array_slice($this->getElements(), 0, $index);
        $end = array_slice($this->getElements(), $index);

        $this->setElements(\array_merge($start, $list->toArray(), $end));
    }

    public function get($index)
    {
        if ($index < $this->count()) {

            $elements = $this->getElements();

            return $elements[$index];
        }

        throw new \OutOfBoundsException('Invalid index');
    }

    public function indexOf($element)
    {
        foreach ($this->getElements() as $index => $elem) {
            if ($elem === $element) {
                return $index;
            }
        }

        return false;
    }

    public function removeAt($index)
    {
        $elements = $this->getElements();
        if (isset($elements[$index])) {
            unset($elements[$index]);

            $this->setElements($elements);

            return true;
        }

        return false;
    }

    public function set($index, $element)
    {
        $elements = $this->getElements();

        if (!isset($elements[$index])) {
            throw new \OutOfBoundsException('Invalid index');
        }

        $this->isValid($element);

        $elements[$index] = $element;

        $this->setElements($elements);

        return true;
    }

    public function subList($fromIndex, $toIndex)
    {
        $elements = $this->getElements();

        if (isset($elements[$fromIndex]) && isset($elements[$toIndex]) && $fromIndex < $toIndex) {
            return array_slice($elements, $fromIndex, $toIndex - $fromIndex);
        }

        throw new \OutOfBoundsException('Invalid range');
    }

}
