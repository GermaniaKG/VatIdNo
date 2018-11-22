<?php
namespace Germania\VatIdNo;

trait TaxNoAwareTrait
{

    use TaxNoProviderTrait;

    /**
     * @inheritdoc
     */
    public function setTaxNo( $taxno )
    {
        if ($taxno instanceOf TaxNoProviderInterface)
            $taxno = $taxno->getTaxNo();

        $this->taxno = $taxno;
        return $this;
    }
}
