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
}
