<?php

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class FloatCollection extends Collection
{

    protected function checkType($item): bool
    {
        return is_numeric($item);
    }

    /**
     * @return Traversable | float[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function offsetSet($offset, $item): void
    {
        if ($this->checkType($item)) {
            $this->offsetSetWithoutCheck($offset, (float)$item);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}