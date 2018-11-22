<?php
namespace Germania\VatIdNo;

interface TaxNoAwareInterface extends TaxNoProviderInterface
{
    /**
     * Sets the tax number.
     *
     * @param  string $taxno Tax number
     * @return self   Fluent interface
     */
    public function setTaxNo( $taxno );
}
