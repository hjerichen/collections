<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit;

use HJerichen\Collections\Collection;
use HJerichen\Collections\ObjectCollection;
use HJerichen\Collections\Primitive\BooleanCollection;
use HJerichen\Collections\Primitive\IntegerCollection;
use HJerichen\Collections\Primitive\StringCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class CollectionTest extends TestCase
{
    /* TESTS */

    /** @psalm-suppress InvalidScalarArgument */
    public function testDisablingTypeCheck(): void
    {
        $collection = new BooleanCollection();
        $collection->disableTypeCheck();
        $collection[] = 'test';

        $this->expectException(TypeError::class);

        $collection->enableTypeCheck();
        $collection[] = 'test';
    }

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

    /** @psalm-suppress InvalidScalarArgument */
    public function testMergingWithDifferentCollectionTypes(): void
    {
        $collection1 = new StringCollection();
        $collection2 = new IntegerCollection();

        $this->expectException(TypeError::class);

        $collection1->merge($collection2);
    }

    public function testMappingWithCallable(): void
    {
        $collection = $this->createNewCollection([1, 9, 3]);
        $addOne = static fn(int $number): int => $number + 1;

        $expected = [2, 10, 4];
        $actual = $collection->map($addOne);
        self::assertEquals($expected, $actual);
    }

    public function testExecutingCallableForEachItem(): void
    {
        $collection = new ObjectCollection(NormalObject::class);
        $collection[] = new NormalObject(1);
        $collection[] = new NormalObject(2);

        $addName = function (NormalObject $item): void {
            $item->name = "name-$item->id";
        };
        $collection->forEach($addName);

        self::assertEquals('name-1', $collection[0]->name ?? '');
        self::assertEquals('name-2', $collection[1]->name ?? '');
    }

    public function testFindItems(): void
    {
        $collection = $this->createNewCollection([1, 9, 3]);
        $filter = fn(int $number): bool => $number > 1;

        $expected = [1 => 9, 2 => 3];
        $actual = $collection->find($filter);
        self::assertEquals($expected, $actual);
    }

    public function testFindOneItem(): void
    {
        $collection = $this->createNewCollection([1, 9, 3]);
        $filter = fn(int $number): bool => $number > 1;

        $expected = 9;
        $actual = $collection->findOne($filter);
        self::assertEquals($expected, $actual);
    }

    public function testFindOneItemWithNoMatch(): void
    {
        $collection = $this->createNewCollection([1, 9, 3]);
        $filter = fn(int $number): bool => $number > 40;

        $expected = null;
        $actual = $collection->findOne($filter);
        self::assertSame($expected, $actual);
    }

    public function testFilterCollection(): void
    {
        $collection = $this->createNewCollection([1, 9, 3]);
        $filter = fn(int $number): bool => $number > 1;

        $collection->filter($filter);

        $expected = [1 => 9, 2 => 3];
        $actual = $collection->asArray();
        self::assertEquals($expected, $actual);
    }

    public function testResettingIndex(): void
    {
        $collection = $this->createNewCollection([1, 9, 3]);
        $filter = fn(int $number): bool => $number > 1;

        $collection->filter($filter);
        $collection->resetIndex();

        $expected = [9, 3];
        $actual = $collection->asArray();
        self::assertEquals($expected, $actual);
    }

    public function testReplaceKeys(): void
    {
        $collection = $this->createNewCollection([100, 200, 300]);
        $collection->replaceKeys([4, 6, 8]);

        $expected = [4 => 100, 6 => 200, 8 => 300];
        $actual = $collection->asArray();
        self::assertEquals($expected, $actual);
    }

    public function testReplaceKeysWithNotUniqueKeys(): void
    {
        $exception = new RuntimeException('Provided keys are not unique.');
        $this->expectExceptionObject($exception);

        $collection = $this->createNewCollection([100, 200, 300]);
        $collection->replaceKeys([4, 6, 6]);
    }

    public function testReplaceKeysWithWrongKeyCount(): void
    {
        $exception = new RuntimeException('Number of keys do not match number of items.');
        $this->expectExceptionObject($exception);

        $collection = $this->createNewCollection([100, 200, 300]);
        $collection->replaceKeys([4, 6]);
    }


    /* HELPERS */

    /**
     * @param list<int> $items
     * @return Collection<int>
     */
    private function createNewCollection(array $items): Collection
    {
        return new IntegerCollection($items);
    }
}