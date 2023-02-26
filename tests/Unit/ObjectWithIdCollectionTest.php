<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit;

use HJerichen\Collections\ObjectWithIdCollection;
use HJerichen\Collections\Test\Helpers\GetIdObject;
use HJerichen\Collections\Test\Helpers\GetIdObjectCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use HJerichen\Collections\Test\Helpers\StringObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ObjectWithIdCollectionTest extends TestCase
{
    private GetIdObjectCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->collection = new GetIdObjectCollection();
        $this->collection[] = new GetIdObject(4);
        $this->collection[] = new GetIdObject(5);
    }

    /* TESTS */

    public function testGetType(): void
    {
        $expected = GetIdObject::class;
        $actual = $this->collection->getType();
        $this->assertEquals($expected, $actual);
    }

    public function testIdsWithAccessMethod(): void
    {
        $this->collection[8] = new GetIdObject(7);

        $expected = [4, 5, 7];
        $actual = $this->collection->getIds();
        self::assertEquals($expected, $actual);
    }

    public function testIdsWithAccessProperty(): void
    {
        $collection = new ObjectWithIdCollection(NormalObject::class);
        $collection[] = new NormalObject(4);
        $collection[] = new NormalObject(5);

        $expected = [4, 5];
        $actual = $collection->getIds();
        self::assertEquals($expected, $actual);
    }

    public function testIdsWithAccessPropertyAndNotSet(): void
    {
        $object = new NormalObject(4);
        unset($object->id);

        $collection = new ObjectWithIdCollection(NormalObject::class);
        $collection[] = new NormalObject(4);
        $collection[] = $object;

        $expected = [4];
        $actual = $collection->getIds();
        self::assertEquals($expected, $actual);
    }

    public function testGetById(): void
    {
        $expected = $this->collection[1];
        $actual = $this->collection->getById(5);
        self::assertSame($expected, $actual);
    }

    public function testSetIdsAsKey(): void
    {
        $this->collection->setIdsAsKey();

        $expected = [
            4 => new GetIdObject(4),
            5 => new GetIdObject(5),
        ];
        $actual = $this->collection->asArray();
        self::assertEquals($expected, $actual);
    }

    public function testSetIdsAsKeyWithNullId(): void
    {
        $exception = new RuntimeException('Not all items in collection have an id.');
        $this->expectExceptionObject($exception);

        $this->collection[] = new GetIdObject(null);
        $this->collection->setIdsAsKey();
    }

    public function testObjectsNeedsToProvideAnIdAccess(): void
    {
        $exception = new InvalidArgumentException('Class HJerichen\Collections\Test\Helpers\StringObject provides no id access.');
        $this->expectExceptionObject($exception);

        /** @psalm-suppress MissingTemplateParam */
        new class extends ObjectWithIdCollection {
            public function __construct()
            {
                parent::__construct(StringObject::class);
            }
        };
    }
}
