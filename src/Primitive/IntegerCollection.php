<?php

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class IntegerCollection extends Collection
{
    protected function checkType($item): bool
    {
        return is_int($item) || ((string)$item === (string)(int)$item && !is_bool($item));
    }

    /**
     * @return Traversable | int[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function offsetSet($offset, $item): void
    {
        if ($this->checkType($item)) {
            $this->offsetSetWithoutCheck($offset, (int)$item);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}