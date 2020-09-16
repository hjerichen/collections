<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\IntegerCollection;
use HJerichen\Collections\Primitive\StringCollection;
use InvalidArgumentException;
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
        self::assertEquals($expected, $actual);
    }

    public function testMergingTwoCollections(): void
    {
        $items1 = [1, 2];
        $items2 = [3, 4];

        $collection1 = $this->createNewCollection($items1);
        $collection2 = $this->createNewCollection($items2);

        $collection1->merge($collection2);
        $expected = $collection1->asArray();
        $actual = [1, 2, 3, 4];
        self::assertEquals($expected, $actual);
    }

    public function testMergingMultipleCollections(): void
    {
        $items1 = [1, 2];
        $items2 = [3, 4];
        $items3 = [5, 6];

        $collection1 = $this->createNewCollection($items1);
        $collection2 = $this->createNewCollection($items2);
        $collection3 = $this->createNewCollection($items3);

        $collection1->merge($collection2, $collection3);
        $expected = $collection1->asArray();
        $actual = [1, 2, 3, 4, 5, 6];
        self::assertEquals($expected, $actual);
    }

    public function testMergingWithDifferentCollectionTypes(): void
    {
        $collection1 = new StringCollection();
        $collection2 = new IntegerCollection();

        $expectedException = new InvalidArgumentException('Collections of different types can not be merged.');
        $this->expectExceptionObject($expectedException);

        $collection1->merge($collection2);
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