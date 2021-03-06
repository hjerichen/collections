<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\FloatCollection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class FloatCollectionTest extends TestCase
{
    private FloatCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new FloatCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testInitializeWithFloat(): void
    {
        $this->collection = new FloatCollection([5.2, 6.3]);

        $expected = 6.3;
        $actual = $this->collection[1];
        self::assertSame($expected, $actual);
    }

    public function testAddFloat(): void
    {
        $this->collection[] = 7.2;

        $expected = 7.2;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddFloatAsString(): void
    {
        $this->collection[] = '7.2';

        $expected = 7.2;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddInteger(): void
    {
        $this->collection[] = 7;

        $expected = 7.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddIntegerAsString(): void
    {
        $this->collection[] = '7';

        $expected = 7.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $expected = 0.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $expected = 0.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddSomeString(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 'test';
    }

    public function testAddTrue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = true;
    }

    public function testAddFalse(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = false;
    }

    public function testAddArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = [];
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function testIterator(): void
    {
        $this->collection[] = 4.6;

        $expected = 4.6;
        $actual = $this->collection->getIterator()->current();
        self::assertSame($expected, $actual);
    }
}
