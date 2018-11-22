<?php
namespace tests;

use Germania\VatIdNo\Filters\WithTaxNoFilterIterator;
use Germania\VatIdNo\VatIdNoProviderInterface;

use Prophecy\Argument;

class WithTaxNoFilterIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideCtorArguments
     */
    public function testInstantiation( $iterator, $field )
    {
        $sut = new WithTaxNoFilterIterator( $iterator, $field );
        $this->assertFalse( empty($sut->field) );
    }


    /**
     * @dataProvider provideValidVatIdArguments
     */
    public function testWithVatIdField( $iterator, $expected_count )
    {
        $sut = new WithTaxNoFilterIterator( $iterator );
        $this->assertEquals($expected_count, iterator_count( $sut) );
    }


    /**
     * @dataProvider provideNoVatIdArguments
     */
    public function testWithoutVatIdField( $iterator, $expected_count )
    {
        $sut = new WithTaxNoFilterIterator( $iterator );
        $this->assertEquals( $expected_count, iterator_count( $sut) );
    }




    public function provideCtorArguments()
    {
        $foo_arr = array('taxno' => 'XY000');
        $foo_obj = (object) $foo_arr;

        $field = "taxno";

        return array(
            [ new \ArrayIterator(), $field ],
            [ new \ArrayObject( ), $field]
        );
    }


    public function provideValidVatIdArguments()
    {
        $taxno = "XY00000";

        $foo_arr = array('taxno' => $taxno);
        $foo_obj = (object) $foo_arr;

        $vatprovider1 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider1->getTaxNo()->willReturn( $taxno );

        $iterator_elements = [
            $foo_arr,
            $foo_obj,
            $vatprovider1->reveal()
        ];

        $expected_iterator_count = count( $iterator_elements );

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
        $vatprovider1->getTaxNo()->willReturn( false );

        $vatprovider2 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider2->getTaxNo()->willReturn( null );

        $vatprovider3 = $this->prophesize( VatIdNoProviderInterface::class );
        $vatprovider3->getTaxNo()->willReturn( "" );


        $iterator_elements = [
            $foo_arr,
            $foo_obj,
            $vatprovider1->reveal(),
            $vatprovider2->reveal(),
            $vatprovider3->reveal(),
            "something else"
        ];

        // Value is 0 here because the SUT filters for items
        // that do NOT provide a taxno

        $expected_iterator_count = 0;

        return array(
            [ new \ArrayIterator( $iterator_elements ), $expected_iterator_count ],
            [ new \ArrayObject( $iterator_elements ),   $expected_iterator_count ]
        );
    }

}
