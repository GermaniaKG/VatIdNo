<?php
namespace tests;

use Germania\VatIdNo\Filters\WithoutVatIdNoFilterIterator;
use Germania\VatIdNo\VatIdNoProviderInterface;

use Prophecy\Argument;

class WithoutVatIdNoFilterIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideCtorArguments
     */
    public function testInstantiation( $iterator, $field )
    {
        $sut = new WithoutVatIdNoFilterIterator( $iterator, $field );
        $this->assertFalse( empty($sut->field) );
    }


    /**
     * @dataProvider provideValidVatIdArguments
     */
    public function testWithVatIdField( $iterator, $expected_count )
    {
        $sut = new WithoutVatIdNoFilterIterator( $iterator );
        $this->assertEquals($expected_count, iterator_count( $sut) );
    }


    /**
     * @dataProvider provideNoVatIdArguments
     */
    public function testWithoutVatIdField( $iterator, $expected_count )
    {
        $sut = new WithoutVatIdNoFilterIterator( $iterator );
        $this->assertEquals( $expected_count, iterator_count( $sut) );
    }




    public function provideCtorArguments()
    {
        $foo_arr = array('vatin' => 'XY000');
        $foo_obj = (object) $foo_arr;

        $field = "vatin";

        return array(
            [ new \ArrayIterator(), $field ],
            [ new \ArrayObject( ), $field]
        );
    }


    public function provideValidVatIdArguments()
    {
        $vatin = "XY00000";

        $foo_arr = array('vatin' => $vatin);
        $foo_obj = (object) $foo_arr;

        $vatprovider1 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider1->getVatIdNo()->willReturn( $vatin );

        $iterator_elements = [
            $foo_arr,
            $foo_obj,
            $vatprovider1->reveal()
        ];

        // Value is 0 here because the SUT filters for items
        // that do NOT provide a vatin
        $expected_iterator_count = 0;

        return array(
            [ new \ArrayIterator( $iterator_elements ), $expected_iterator_count ],
            [ new \ArrayObject( $iterator_elements ),   $expected_iterator_count ]
        );
    }

    public function provideNoVatIdArguments()
    {
        $foo_arr = array('foobar' => 'foobar');
        $foo_obj = (object) $foo_arr;

        $vatprovider1 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider1->getVatIdNo()->willReturn( false );

        $vatprovider2 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider2->getVatIdNo()->willReturn( null );

        $vatprovider3 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider3->getVatIdNo()->willReturn( "" );


        $iterator_elements = [
            $foo_arr,
            $foo_obj,
            $vatprovider1->reveal(),
            $vatprovider2->reveal(),
            $vatprovider3->reveal(),
            "something else"
        ];

        $expected_iterator_count = count( $iterator_elements );

        return array(
            [ new \ArrayIterator( $iterator_elements ), $expected_iterator_count ],
            [ new \ArrayObject( $iterator_elements ),   $expected_iterator_count ]
        );
    }

}
