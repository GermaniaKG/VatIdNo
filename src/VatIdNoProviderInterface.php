<?php
namespace Germania\VatIdNo;

interface VatIdNoProviderInterface
{

    /**
     * Returns the VAT ID number.
     *
     * @return string
     */
    public function getVatIdNo();


    /**
     * Returns the tax number.
     *
     * @return string
     */
    public function getTaxNo();
}
