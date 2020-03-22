<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\TestHelpers\NormalObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionClassCollectionTest extends TestCase
{
    /**
     * @var ReflectionClassCollection
     */
    private $collection;
    /**
     * @var ReflectionClass
     */
    private $reflectionClass;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->reflectionClass = new ReflectionClass(NormalObject::class);
        $this->collection = new ReflectionClassCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        $expected = Collection::class;
        $actual = $this->collection;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testInitializeWitReflectionClasses(): void
    {
        $this->collection = new ReflectionClassCollection([$this->reflectionClass]);

        $expected = $this->reflectionClass;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddReflectionClass(): void
    {
        $this->collection[] = $this->reflectionClass;

        $expected = $this->reflectionClass;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddOtherObject(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = new NormalObject();
    }

    public function testIterator(): void
    {
        $this->collection[] = $this->reflectionClass;

        $expected = $this->reflectionClass;
        $actual = $this->collection->getIterator()->current();
        $this->assertSame($expected, $actual);
    }
}
