<?php

namespace C201\Support\Tests\Enum;

use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testFromStringReturnsEnumWithPassedValidValue(): void
    {
        $value = EnumTestProxy::TEST_KONST_1;
        $enum = EnumTestProxy::fromString($value);
        $this->assertEquals($value, $enum->asString());
    }

    public function testFromStringThrowsLogicExceptionIfInvalidValueIsPassed(): void
    {
        $this->expectException(\LogicException::class);
        EnumTestProxy::fromString('foobar');
    }

    public function testAllReturnsCollectionWithAllEnumConstants(): void
    {
        $reflection = new \ReflectionClass(EnumTestProxy::class);
        $expectedConstants = $reflection->getConstants();
        $actualConstants = EnumTestProxy::all();
        $this->assertSameSize($expectedConstants, $actualConstants);
        foreach ($expectedConstants as $expected) {
            $found = false;
            foreach ($actualConstants as $actual) {
                if ($expected === $actual->asString()) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found);
        }
    }

    public function testCallingMagicStaticCreateMethodCorrespondingToValidConstantReturnsEnumContainingThatConstantAsValue(): void
    {
        $enum = EnumTestProxy::testKonst1();
        $this->assertEquals(EnumTestProxy::TEST_KONST_1, $enum->asString());
    }

    public function testCallingMagicStaticCreateMethodCorrespondingToNoConstantThrowsLogicException(): void
    {
        $this->expectException(\LogicException::class);
        EnumTestProxy::nonexistingConstant();
    }
}
