<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<string>
 */
class StringCollection extends Collection
{
    protected function checkType($item): bool
    {
        return is_string($item) || (!is_bool($item) && !is_array($item) && $this->itemCanBeConvertedToString($item));
    }

    private function itemCanBeConvertedToString($item): bool
    {
        return
            (!is_object($item) && settype($item, 'string') !== false) ||
            (is_object($item) && method_exists($item, '__toString'));
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?string
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            $this->offsetSetWithoutCheck($offset, (string)$value);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}