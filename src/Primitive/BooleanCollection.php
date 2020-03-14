<?php

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class BooleanCollection extends Collection
{
    protected function checkType($item): bool
    {
        return is_bool($item) ||
            $item === 1 || $item === 0 ||
            $item === '1' || $item === '0' || $item === ''||
            $item === 'true' || $item === 'false';
    }

    /**
     * @return Traversable | bool[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function offsetSet($offset, $item): void
    {
        if ($this->checkType($item)) {
            if ($item === 'false') $item = false;
            $this->offsetSetWithoutCheck($offset, (bool)$item);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}