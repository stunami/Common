<?php

namespace Versionable\Common\Collection;

use Versionable\Common\Validator\ValidatorInterface;
use Versionable\Common\Validator\ObjectValidator;

class Map implements MapInterface
{
    private $elements = array();

    private $validator;

    public function __construct(ValidatorInterface $validator = null)
    {
        if (null === $validator)
        {
            $validator = new ObjectValidator();
        }

        $this->setValidator($validator);
    }

    public function clear()
    {
        $this->elements = array();
    }

    public function containsKey($key)
    {
        if (array_key_exists($key, $this->elements)) {
            return true;
        }

        return false;
    }

    public function containsValue($value)
    {
        if (in_array($value, $this->elements, true)) {
            return true;
        }

        return false;
    }

    public function count()
    {
        return count($this->elements);
    }

    public function entrySet()
    {
        return new Set(array_values($this->elements));
    }

    public function equals(MapInterface $map)
    {
        if ($map->toArray() === $this->toArray()) {
            return true;
        }

        return false;
    }

    public function get($key)
    {
        if (isset($this->elements[$key])) {
            return $this->elements[$key];
        }

        return null;
    }

    /**
     * Implements ArrayAgregator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    public function hashCode()
    {
        return sha1(__CLASS__ . serialize($this->elements));
    }

    public function isEmpty()
    {
        if (empty($this->elements)) {
            return true;
        }

        return false;
    }

    public function keySet()
    {
        return new Set(array_keys($this->elements));
    }

    public function put($key, $value)
    {
        $this->isValid($value);

        $this->elements[$key] = $value;
    }

    public function putAll(MapInterface $map)
    {
        foreach ($map->toArray() as $value) {
            $this->isValid($value);
        }

        $this->elements = array_merge($this->elements, $map->toArray());
    }

    public function remove($key)
    {
        if ($this->containsKey($key)) {
            unset($this->elements[$key]);
        }

        return null;
    }

    public function toArray()
    {
        return $this->elements;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function values()
    {
        return array_values($this->elements);
    }

    protected function isValid($element)
    {
        if ($this->getValidator()->isValid($element) === false) {
            throw new \InvalidArgumentException('Invalid element value for Map');
        }
    }

}
