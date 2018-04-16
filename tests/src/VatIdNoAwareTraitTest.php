<?php
namespace tests;

use Germania\VatIdNo\VatIdNoAwareTrait;
use Germania\VatIdNo\VatIdNoProviderInterface;

class VatIdNoAwareTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetterAndSetter()
    {
        $mock = $this->getMockForTrait(VatIdNoAwareTrait::class);

        $vatin = "XY99999";

        // Make sure we are really changing the number here
        $this->assertNotEquals( $vatin, $mock->getVatIdNo());

        $mock->setVatIdNo($vatin);
        $this->assertEquals( $vatin, $mock->getVatIdNo());

    }

    public function testSetterWithVatIdNoProviderInterface()
    {
        $mock = $this->getMockForTrait(VatIdNoAwareTrait::class);

        // Make sure we are really changing the number here
        $vatin = "XY99999";
        $this->assertNotEquals( $vatin, $mock->getVatIdNo());

        $provider = $this->prophesize( VatIdNoProviderInterface::class );
        $provider->getVatIdNo()->willReturn( $vatin );
        $mock->setVatIdNo( $provider->reveal() );

        $this->assertEquals( $vatin, $mock->getVatIdNo());
    }
}
