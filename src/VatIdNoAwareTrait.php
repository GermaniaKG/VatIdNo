<?php
namespace Germania\VatIdNo;

use Germania\VatIdNo\VatIdNoProviderInterface;

trait VatIdNoAwareTrait
{
    use VatIdNoProviderTrait;

    /**
     * @inheritdoc
     */
    public function setVatIdNo($vatin)
    {
        if ($vatin instanceof VatIdNoProviderInterface) {
            $vatin = $vatin->getVatIdNo();
        }

        $this->vatin = $vatin;
        return $this;
    }


    /**
     * @inheritdoc
     */
    public function setTaxNo($taxno)
    {
        if ($taxno instanceof VatIdNoProviderInterface) {
            $taxno = $taxno->getTaxNo();
        }

        $this->taxno = $taxno;
        return $this;
    }
}
