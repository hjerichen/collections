<?php declare(strict_types=1);

namespace HJerichen\Collections;

use InvalidArgumentException;
use RuntimeException;

/**
 * @template T of object
 * @extends Collection<T>
 * @extends ObjectCollection<T>
 */
class ObjectWithIdCollection extends ObjectCollection
{
    /** @var callable(T):(int|null) */
    protected $idAccess;

    /**
     * @param class-string<T> $type
     * @param array<array-key,T> $items
     */
    public function __construct(string $type, array $items = []) {
        parent::__construct($type, $items);
        $this->idAccess = $this->getIdAccess();
    }

    /** @return list<int|null> */
    public function getIds(): array
    {
        $ids = $this->map($this->idAccess);
        return array_values($ids);
    }

    /**
     * @param int $id
     * @return T|null
     */
    public function getById(int $id): ?object
    {
        $getId = $this->idAccess;
        /** @psalm-suppress InvalidArgument */
        $filter = fn(object $item): bool => $getId($item) === $id;

        return $this->findOne($filter);
    }

    public function setIdsAsKey(): void
    {
        $ids = array_values(array_filter($this->getIds()));
        if (count($ids) === $this->count()) {
            $this->replaceKeys($ids);
            return;
        }
        throw new RuntimeException('Not all items in collection have an id.');
    }

    /**
     * @return callable(T):(int|null)
     * @psalm-suppress MixedInferredReturnType
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedMethodCall
     */
    protected function getIdAccess(): callable
    {
        if (method_exists($this->type, 'getId')) {
            return static fn(object $item): ?int => $item->getId();
        }
        if (property_exists($this->type, 'id')) {
            return static fn(object $item): ?int => $item->id;
        }
        throw new InvalidArgumentException("Class $this->type provides no id access.");
    }
}
