<?php declare(strict_types=1);

namespace HJerichen\Collections;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use RuntimeException;
use Traversable;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @template T
 */
abstract class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    /** @var array<array-key,T> */
    protected array $items = [];
    private bool $typeCheckEnabled = true;

    /** @param array<array-key,T> $items*/
    public function __construct(array $items = [])
    {
        foreach ($items as $key => $item) {
            $this[$key] = $item;
        }
    }

    abstract public function getType(): string;

    public function enableTypeCheck(): void
    {
        $this->typeCheckEnabled = true;
    }

    public function disableTypeCheck(): void
    {
        $this->typeCheckEnabled = false;
    }

    /** @param T $item */
    public function push($item): void
    {
        $this[] = $item;
    }

    /** @param array<array-key,T> $items */
    public function pushMultiple(array $items): void
    {
        foreach ($items as $item) {
            $this[] = $item;
        }
    }

    /**
     * @return Traversable<T>|T[]
     * @psalm-return Traversable<T>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @param array-key $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param array-key $offset
     * @return T|null
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    /**
     * @param array-key|null $offset
     * @param T $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->checkType($value);
        $this->offsetSetWithoutCheck($offset, $value);
    }

    /** @param array-key $offset */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /** @return T[] */
    public function asArray(): array
    {
        return $this->items;
    }

    /** @param Collection<T> ...$collections */
    public function merge(Collection ...$collections): void
    {
        $arrays = [];
        foreach ($collections as $collection) {
            $this->checkCollectionForMerge($collection);
            $arrays[] = $collection->asArray();
        }
        $this->items = array_merge($this->items, ...$arrays);
    }

    /**
     * @template TValue
     * @param callable(T):TValue $callable
     * @return array<array-key,TValue>
     */
    public function map(callable $callable): array
    {
        return array_map($callable, $this->items);
    }

    /** @param callable(T):void $callable */
    public function forEach(callable $callable): void
    {
        /** @psalm-suppress PossiblyInvalidPropertyAssignmentValue */
        array_walk($this->items, $callable);
    }

    /**
     * @param callable(T):bool $callable
     * @return T[]
     */
    public function find(callable $callable): array
    {
        return array_filter($this->items, $callable);
    }

    /**
     * @param callable(T):bool $callable
     * @return T|null
     */
    public function findOne(callable $callable)
    {
        $found = $this->find($callable);
        return empty($found) ? null : reset($found);
    }

    /** @param callable(T):bool $callable */
    public function filter(callable $callable): void
    {
        $this->items = $this->find($callable);
    }

    /** @param T $item */
    public function contains($item): bool
    {
        return in_array($item, $this->items, true);
    }

    public function resetIndex(): void
    {
        $this->items = array_values($this->items);
    }

    /** @param array-key[] $keys */
    public function replaceKeys(array $keys): void
    {
        $this->checkKeysForReplace($keys);
        $this->items = array_combine($keys, $this->items);
    }

    /** @param mixed $item */
    abstract protected function isValidType($item): bool;

    /** @param mixed $item */
    protected function checkType($item): void
    {
        if ($this->typeCheckEnabled && !$this->isValidType($item)) {
            throw new TypeError('invalid type');
        }
    }

    /**
     * @param array-key|null $offset
     * @param T $item
     */
    protected function offsetSetWithoutCheck($offset, $item): void
    {
        $offset !== null ? $this->items[$offset] = $item : $this->items[] = $item;
    }

    private function checkCollectionForMerge(Collection $collection): void
    {
        if (!$this->canCollectionBeMerged($collection)) {
            $message = 'Collections of different types can not be merged.';
            throw new TypeError($message);
        }
    }

    private function canCollectionBeMerged(Collection $collection): bool
    {
        return get_class($this) === get_class($collection);
    }

    private function checkKeysForReplace(array $keys): void
    {
        if (count(array_unique($keys)) !== count($keys)) {
            throw new RuntimeException('Provided keys are not unique.');
        }
        if (count($keys) !== count($this->items)) {
            throw new RuntimeException('Number of keys do not match number of items.');
        }
    }
}