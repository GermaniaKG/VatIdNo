<?php
namespace Germania\VatIdNo;

interface VatIdNoAwareInterface extends VatIdNoProviderInterface
{
    /**
     * Sets the VAT ID number.
     *
     * @param  string $vatin VAT ID number
     * @return self   Fluent interface
     */
    public function setVatIdNo($vatin);

    /**
     * Sets the tax number.
     *
     * @param  string $taxno Tax number
     * @return self   Fluent interface
     */
    public function setTaxNo($taxno);
}
