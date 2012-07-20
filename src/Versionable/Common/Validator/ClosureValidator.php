<?php

namespace Versionable\Common\Validator;

/**
 * Description of ClosureValidator
 *
 * @author stuart
 */
class ClosureValidator
{
    private $closure;

    public function __construct(\Closure $closure)
    {
        $this->setClosure($closure);
    }

    public function isValid($value)
    {
        $closure = $this->getClosure();

        return $closure($value);
    }

    public function getClosure()
    {
        return $this->closure;
    }

    public function setClosure($closure)
    {
        $this->closure = $closure;
    }

}
