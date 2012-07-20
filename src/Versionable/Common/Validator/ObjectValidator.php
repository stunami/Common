<?php

namespace Versionable\Common\Validator;

/**
 * Description of ObjectValidator
 *
 * @author stuart
 */
class ObjectValidator implements ValidatorInterface
{
    public function isValid($value)
    {
        if (is_object($value))
        {
            return true;
        }

        return false;
    }
}
