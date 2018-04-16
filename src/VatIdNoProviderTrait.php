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
     * @inheritdoc
     */
    public function getVatIdNo()
    {
        return $this->vatin;
    }
}
