<?php
namespace tests;

use Germania\VatIdNo\VatIdNoAwareTrait;
use Germania\VatIdNo\VatIdNoProviderInterface;

class VatIdNoAwareTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testVatIdGetterAndSetter()
    {
        $mock = $this->getMockForTrait(VatIdNoAwareTrait::class);

        $vatin = "XY99999";

        // Make sure we are really changing the number here
        $this->assertNotEquals($vatin, $mock->getVatIdNo());

        $mock->setVatIdNo($vatin);
        $this->assertEquals($vatin, $mock->getVatIdNo());
    }

    public function testTaxNoGetterAndSetter()
    {
        $mock = $this->getMockForTrait(VatIdNoAwareTrait::class);

        $taxno = "XY99999";

        // Make sure we are really changing the number here
        $this->assertNotEquals($taxno, $mock->getTaxNo());

        $mock->setTaxNo($taxno);
        $this->assertEquals($taxno, $mock->getTaxNo());
    }


    public function testVatIdSetterWithVatIdNoProviderInterface()
    {
        $mock = $this->getMockForTrait(VatIdNoAwareTrait::class);

        // Make sure we are really changing the number here
        $vatin = "XY99999";
        $this->assertNotEquals($vatin, $mock->getVatIdNo());

        $provider = $this->prophesize(VatIdNoProviderInterface::class);
        $provider->getVatIdNo()->willReturn($vatin);
        $mock->setVatIdNo($provider->reveal());

        $this->assertEquals($vatin, $mock->getVatIdNo());
    }


    public function testTaxNoSetterWithVatIdNoProviderInterface()
    {
        $mock = $this->getMockForTrait(VatIdNoAwareTrait::class);

        // Make sure we are really changing the number here
        $taxno = "XY99999";
        $this->assertNotEquals($taxno, $mock->getTaxNo());

        $provider = $this->prophesize(VatIdNoProviderInterface::class);
        $provider->getTaxNo()->willReturn($taxno);
        $mock->setTaxNo($provider->reveal());

        $this->assertEquals($taxno, $mock->getTaxNo());
    }
}
