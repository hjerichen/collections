<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Reflection\ReflectionClassCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionClassCollectionTest extends TestCase
{
    private ReflectionClassCollection $collection;
    /** @var ReflectionClass<object>  */
    private ReflectionClass $reflectionClass;

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
        self::assertInstanceOf($expected, $actual);
    }

    public function testInitializeWitReflectionClasses(): void
    {
        $this->collection = new ReflectionClassCollection([$this->reflectionClass]);

        $expected = $this->reflectionClass;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddReflectionClass(): void
    {
        $this->collection[] = $this->reflectionClass;

        $expected = $this->reflectionClass;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddOtherObject(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = new NormalObject();
    }

    public function testIterator(): void
    {
        $this->collection[] = $this->reflectionClass;

        foreach ($this->collection as $class) {
            $expected = $this->reflectionClass;
            $actual = $class;
            self::assertSame($expected, $actual);
        }
    }
}
