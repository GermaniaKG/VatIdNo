<?php
namespace Germania\VatIdNo;

trait TaxNoProviderTrait
{

    /**
     * tax number
     * @var string
     */
    public $taxno;

    /**
     * @inheritdoc
     */
    public function getTaxNo()
    {
        return $this->taxno;
    }
}
