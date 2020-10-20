<?php

namespace C201\Support\Tests\Collections;

use C201\Support\Collections\IterableToCollectionConstructionTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tightenco\Collect\Support\Collection;

class IterableToCollectionConstructionTraitTest extends TestCase
{
    public function testCollectionFromIterableReturnsSameCollectionIfCollectionIsPassed(): void
    {
        /** @var MockObject|IterableToCollectionConstructionTrait $trait */
        $trait = $this->getMockForTrait(IterableToCollectionConstructionTrait::class);
        $reflection = new \ReflectionClass(get_class($trait));
        $method = $reflection->getMethod('collectionFromIterable');
        $method->setAccessible(true);

        $collection = Collection::make();
        $result = $method->invokeArgs($trait, [$collection]);
        $this->assertSame($result, $collection);
    }

    public function testCollectionFromIterableReturnsCollectionContainingArrayElementsIfArrayIsPassed(): void
    {
        /** @var MockObject|IterableToCollectionConstructionTrait $trait */
        $trait = $this->getMockForTrait(IterableToCollectionConstructionTrait::class);
        $reflection = new \ReflectionClass(get_class($trait));
        $method = $reflection->getMethod('collectionFromIterable');
        $method->setAccessible(true);

        $arrayElement = new \stdClass();
        $result = $method->invokeArgs($trait, [[$arrayElement]]);
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertContainsOnlyInstancesOf(get_class($arrayElement), $result);
        $this->assertCount(1, $result);
        $this->assertSame($arrayElement, $result[0]);
    }
}
