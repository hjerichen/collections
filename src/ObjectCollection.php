<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @template T extends object
 * @extends Collection<T>
 */
class ObjectCollection extends Collection
{
    private string $type;

    /**
     * @param class-string<T> $type
     * @param array<int|string,T> $items
     */
    public function __construct(string $type, array $items = [])
    {
        $this->type = $type;
        parent::__construct($items);
    }

    protected function checkType($item): bool
    {
        return $item instanceof $this->type;
    }
}