<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<string>
 */
class StringCollection extends Collection
{
    public function getType(): string
    {
        return 'string';
    }

    /**
     * @param array-key|null $offset
     * @param string $value
     * @psalm-suppress RedundantCastGivenDocblockType
     */
    public function offsetSet($offset, $value): void
    {
        $this->checkType($value);
        $this->offsetSetWithoutCheck($offset, (string)$value);
    }

    protected function isValidType($item): bool
    {
        return is_string($item) || (!is_bool($item) && !is_array($item) && $this->itemCanBeConvertedToString($item));
    }

    /** @param mixed $item */
    private function itemCanBeConvertedToString($item): bool
    {
        return
            (!is_object($item) && settype($item, 'string') !== false) ||
            (is_object($item) && method_exists($item, '__toString'));
    }
}