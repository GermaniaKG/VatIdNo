<?php
namespace tests;

use Germania\VatIdNo\VatIdNoProviderTrait;
use Germania\VatIdNo\VatIdNoProviderInterface;

class VatIdNoProviderTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testVatIdGetterAndSetter()
    {
        $mock = $this->getMockForTrait(VatIdNoProviderTrait::class);

        $vatin = "XY99999";

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('vatin', $mock);
        $mock->vatin = $vatin;

        $this->assertEquals($vatin, $mock->getVatIdNo());
    }

    public function testTaxNoGetterAndSetter()
    {
        $mock = $this->getMockForTrait(VatIdNoProviderTrait::class);

        $taxno = "XY99999";

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('taxno', $mock);
        $mock->taxno = $taxno;

        $this->assertEquals($taxno, $mock->getTaxNo());
    }
}
