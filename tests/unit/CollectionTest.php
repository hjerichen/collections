<?php

namespace HJerichen\Collections;

use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class CollectionTest extends TestCase
{
    /* TESTS */

    public function testConvertingToArray(): void
    {
        $items = [1, 2];
        $collection = $this->createNewCollection($items);

        $expected = $items;
        $actual = $collection->asArray();
        $this->assertEquals($expected, $actual);
    }


    /* HELPERS */

    private function createNewCollection(array $items): Collection
    {
        return new class($items) extends Collection {
            protected function checkType($item): bool
            {
                return true;
            }
        };
    }
}