<?php

namespace HJerichen\Collections;

use ArrayAccess;
use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

abstract class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    /**
     * @var array
     */
    private $items = [];

    public function __construct(array $items = [])
    {
        $this->pushMultiple($items);
    }

    public function pushMultiple(array $items): void
    {
        foreach ($items as $key => $item) {
            $this->offsetSet($key, $item);
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet($offset, $item): void
    {
        if ($this->checkType($item)) {
            $this->offsetSetWithoutCheck($offset, $item);
        } else {
            $this->throwInvalidTypeException();
        }
    }

    protected function offsetSetWithoutCheck($offset, $item): void
    {
        $offset !== null ? $this->items[$offset] = $item : $this->items[] = $item;
    }

    protected function throwInvalidTypeException(): void
    {
        throw new InvalidArgumentException('invalid type');
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function asArray(): array
    {
        return $this->items;
    }

    abstract protected function checkType($item): bool;
}