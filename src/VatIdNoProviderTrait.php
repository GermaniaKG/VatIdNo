<?php
namespace Germania\VatIdNo;

trait VatIdNoProviderTrait
{

    /**
     * VAT ID number
     * @var string
     */
    public $vatin;


    /**
     * tax number
     * @var string
     */
    public $taxno;


    /**
     * @inheritdoc
     */
    public function getVatIdNo()
    {
        return $this->vatin;
    }


    /**
     * @inheritdoc
     */
    public function getTaxNo()
    {
        return $this->taxno;
    }
}
