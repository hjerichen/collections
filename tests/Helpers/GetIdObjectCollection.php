<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Helpers;

use HJerichen\Collections\Collection;
use HJerichen\Collections\ObjectCollection;
use HJerichen\Collections\ObjectWithIdCollection;

/**
 * @extends Collection<GetIdObject>
 * @extends ObjectCollection<GetIdObject>
 * @extends ObjectWithIdCollection<GetIdObject>
 */
class GetIdObjectCollection extends ObjectWithIdCollection
{
    /** @param GetIdObject[] $items */
    public function __construct(array $items = []) {
        parent::__construct(GetIdObject::class, $items);
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?GetIdObject
    {
        return parent::offsetGet($offset);
    }
}
