<?php
namespace Germania\VatIdNo;

interface TaxNoProviderInterface
{
    /**
     * Returns the tax number.
     *
     * @return string
     */
    public function getTaxNo();
}
