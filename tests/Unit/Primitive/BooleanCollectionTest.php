<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\BooleanCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class BooleanCollectionTest extends TestCase
{
    private BooleanCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new BooleanCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testGetType(): void
    {
        $expected = 'bool';
        $actual = $this->collection->getType();
        $this->assertEquals($expected, $actual);
    }

    public function testAddTrue(): void
    {
        $this->collection[] = true;

        $actual = $this->collection[0];
        self::assertTrue($actual);
    }

    public function testAddFalse(): void
    {
        $this->collection[] = false;

        $actual = $this->collection[0];
        self::assertFalse($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddOne(): void
    {
        $this->collection[] = 1;

        $actual = $this->collection[0];
        self::assertTrue($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $actual = $this->collection[0];
        self::assertFalse($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddOneAsString(): void
    {
        $this->collection[] = '1';

        $actual = $this->collection[0];
        self::assertTrue($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $actual = $this->collection[0];
        self::assertFalse($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddEmptyString(): void
    {
        $this->collection[] = '';

        $actual = $this->collection[0];
        self::assertFalse($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddTrueString(): void
    {
        $this->collection[] = 'true';

        $actual = $this->collection[0];
        self::assertTrue($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddFalseString(): void
    {
        $this->collection[] = 'false';

        $actual = $this->collection[0];
        self::assertFalse($actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddSomeString(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 'test';
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddSomeInteger(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 2;
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddSomeFloat(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 2.6;
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddArray(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = [];
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddObject(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = new NormalObject();
    }

    public function testGettingIterator(): void
    {
        $this->collection[] = true;

        foreach ($this->collection as $item) {
            self::assertTrue($item);
        }
    }
}
