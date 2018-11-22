<?php
namespace Germania\VatIdNo;

use Germania\VatIdNo\VatIdNoProviderInterface;

trait VatIdNoAwareTrait
{

    use VatIdNoProviderTrait;

    /**
     * @inheritdoc
     */
    public function setVatIdNo( $vatin )
    {
        if ($vatin instanceOf VatIdNoProviderInterface)
            $vatin = $vatin->getVatIdNo();

        $this->vatin = $vatin;
        return $this;
    }


    /**
     * @inheritdoc
     */
    public function setTaxNo( $taxno )
    {
        if ($taxno instanceOf VatIdNoProviderInterface)
            $taxno = $taxno->getTaxNo();

        $this->taxno = $taxno;
        return $this;
    }
}
