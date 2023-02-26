<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Helpers;

use HJerichen\Collections\ObjectWithIdCollection;

/**
 * @extends ObjectWithIdCollection<GetIdObject>
 */
class GetIdObjectCollection extends ObjectWithIdCollection
{
    /** @param GetIdObject[] $items */
    public function __construct(array $items = []) {
        parent::__construct(GetIdObject::class, $items);
    }
}
