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

        $expected = true;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddFalse(): void
    {
        $this->collection[] = false;

        $expected = false;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddOne(): void
    {
        $this->collection[] = 1;

        $expected = true;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $expected = false;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddOneAsString(): void
    {
        $this->collection[] = '1';

        $expected = true;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $expected = false;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddEmptyString(): void
    {
        $this->collection[] = '';

        $expected = false;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddTrueString(): void
    {
        $this->collection[] = 'true';

        $expected = true;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddFalseString(): void
    {
        $this->collection[] = 'false';

        $expected = false;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddSomeString(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 'test';
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddSomeInteger(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 2;
    }

    /** @psalm-suppress InvalidScalarArgument */
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
            $expected = true;
            $actual = $item;
            self::assertSame($expected, $actual);
        }
    }
}
