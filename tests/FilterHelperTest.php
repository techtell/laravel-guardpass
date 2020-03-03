<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Techtell\LaravelGuardPass\Traits\StringToArrayTrait;

final class FilterHelperTest extends TestCase
{
    /**
     * 
     */
    public function testCallsgetDefaultsWhenWithoutArguements(): void
    {
        $mock = $this->getMockForTrait(StringToArrayTrait::class);
        $mock->expects($this->once())
            ->method('getDefaults')
            ->will($this->returnValue([true]));

        $this->assertEquals([true], $mock->StringToArray());
    }

    /**
     * 
     */
    public function testReturnsArrayWhenWithStringArguement(): void
    {
        $mock = $this->getMockForTrait(StringToArrayTrait::class);

        $string = 'email, is_admin';
        $arr = ['id', 'email', 'is_admin'];

        $this->assertEquals(
            $arr,
            $mock->StringToArray($string)
        );
    }

    /**
     * 
     */
    public function testReturnArrayWithoutDuplicates(): void
    {
        $mock = $this->getMockForTrait(StringToArrayTrait::class);

        $string = 'email,email,id';
        $arr = ['id', 'email'];

        $this->assertEquals(
            $arr,
            $mock->StringToArray($string)
        );
    }

    /**
     * 
     */
    public function testArrayValuesAreTrimmed(): void
    {
        $mock = $this->getMockForTrait(StringToArrayTrait::class);

        $string = 'email , is_admin , fname';
        $arr = ['id', 'email', 'is_admin', 'fname'];

        $this->assertEquals(
            $arr,
            $mock->StringToArray($string)
        );
    }

    /**
     * 
     */
    public function testArrayIsFilteredForEmptyValues(): void
    {
        $mock = $this->getMockForTrait(StringToArrayTrait::class);

        $string = 'email,, ,,id';
        $arr = ['id', 'email'];

        $this->assertEquals(
            $arr,
            $mock->StringToArray($string)
        );
    }
}
