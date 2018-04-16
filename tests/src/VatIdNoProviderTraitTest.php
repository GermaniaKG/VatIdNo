<?php
namespace tests;

use Germania\VatIdNo\VatIdNoProviderTrait;
use Germania\VatIdNo\VatIdNoProviderInterface;

class VatIdNoProviderTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetterAndSetter()
    {
        $mock = $this->getMockForTrait(VatIdNoProviderTrait::class);

        $vatin = "XY99999";

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('vatin', $mock);
        $mock->vatin = $vatin;

        $this->assertEquals( $vatin, $mock->getVatIdNo());
    }
}
