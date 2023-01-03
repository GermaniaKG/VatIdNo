<?php
namespace Germania\VatIdNo\Filters;

use Germania\VatIdNo\VatIdNoProviderInterface;

class WithTaxNoFilterIterator extends \FilterIterator
{
    /**
     * @var string
     */
    public $field = "taxno";

    public function __construct(\Traversable $iterator, $field = null)
    {
        parent::__construct(new \IteratorIterator($iterator));
        $this->field = $field ?: $this->field;
    }

    #[\ReturnTypeWillChange]
    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if ($current instanceof VatIdNoProviderInterface) {
            return !empty($current->getTaxNo());
        } elseif (is_array($current)) {
            return array_key_exists($this->field, $current)
              and !empty($current[ $this->field ]);
        } elseif (is_object($current)) {
            return isset($current->{$this->field})
              and !empty($current->{$this->field});
        }

        return false;
    }
}
