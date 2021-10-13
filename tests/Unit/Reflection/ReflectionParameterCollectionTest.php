<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Reflection\ReflectionParameterCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use PHPUnit\Framework\TestCase;
use ReflectionParameter;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionParameterCollectionTest extends TestCase
{
    private ReflectionParameterCollection $collection;
    private ReflectionParameter $reflectionParameter;

    protected function setUp(): void
    {
        parent::setUp();

        /** @psalm-suppress UnusedClosureParam */
        $function = static function(string $test): void {};
        $this->reflectionParameter = new ReflectionParameter($function, 'test');
        $this->collection = new ReflectionParameterCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        $expected = Collection::class;
        $actual = $this->collection;
        self::assertInstanceOf($expected, $actual);
    }

    public function testInitializeWitReflectionParameter(): void
    {

        $this->collection = new ReflectionParameterCollection([$this->reflectionParameter]);

        $expected = $this->reflectionParameter;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddReflectionParameter(): void
    {
        $this->collection[] = $this->reflectionParameter;

        $expected = $this->reflectionParameter;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddOtherObject(): void
    {
        $this->expectException(TypeError::class);

        /** @psalm-suppress InvalidArgument */
        $this->collection[] = new NormalObject();
    }

    public function testIterator(): void
    {
        $this->collection[] = $this->reflectionParameter;

        foreach ($this->collection as $item) {
            $expected = $this->reflectionParameter;
            $actual = $item;
            self::assertSame($expected, $actual);
        }
    }
}
