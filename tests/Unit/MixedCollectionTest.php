<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit;

use HJerichen\Collections\Collection;
use HJerichen\Collections\MixedCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class MixedCollectionTest extends TestCase
{
    private MixedCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new MixedCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testGetType(): void
    {
        $expected = 'mixed';
        $actual = $this->collection->getType();
        $this->assertEquals($expected, $actual);
    }

    public function testAddToCollection(): void
    {
        $normalObject = new NormalObject();

        $this->collection[] = 'test';
        $this->collection[] = 3;
        $this->collection[] = true;
        $this->collection[] = $normalObject;

        self::assertSame('test', $this->collection[0]);
        self::assertSame(3, $this->collection[1]);
        self::assertTrue($this->collection[2]);
        self::assertSame($normalObject, $this->collection[3]);
    }
}
