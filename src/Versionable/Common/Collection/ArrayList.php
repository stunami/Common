<?php

namespace Versionable\Common\Collection;

/**
 * General purpose list
 */
class ArrayList extends AbstractList implements ListInterface
{
        public function removeRange($fromIndex, $toIndex)
    {
        $elements = $this->getElements();

        if (isset($elements[$fromIndex]) && isset($elements[$toIndex]) && $fromIndex < $toIndex) {

            $remove = array_slice($elements, $fromIndex, $toIndex);
            $start = array_slice($elements, 0, $fromIndex);

            $end = array_slice($elements, $toIndex);
            $elements = array_merge($start, $end);

            $this->setElements($elements);

            return $remove;
        }

        throw new \OutOfBoundsException('Invalid range');
    }

}
