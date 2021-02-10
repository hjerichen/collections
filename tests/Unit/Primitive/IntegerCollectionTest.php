<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\IntegerCollection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class IntegerCollectionTest extends TestCase
{
    private IntegerCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new IntegerCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testAddInteger(): void
    {
        $this->collection[] = 45;

        $expected = 45;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddIntegerAsString(): void
    {
        $this->collection[] = '45';

        $expected = 45;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $expected = 0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $expected = 0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddNegativeInteger(): void
    {
        $this->collection[] = -10;

        $expected = -10;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddNegativeIntegerAsString(): void
    {
        $this->collection[] = '-10';

        $expected = -10;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddFloat(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 44.6;
    }

    public function testAddFloatAsString(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = '44.6';
    }

    public function testAddString(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 'true';
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

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function testGettingIterator(): void
    {
        $this->collection[] = 3;

        $expected = 3;
        $actual = $this->collection->getIterator()->current();
        self::assertSame($expected, $actual);
    }
}
