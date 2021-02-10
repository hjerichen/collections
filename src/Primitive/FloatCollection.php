<?php declare(strict_types=1);

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

    public function offsetGet($offset): ?float
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            $this->offsetSetWithoutCheck($offset, (float)$value);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}