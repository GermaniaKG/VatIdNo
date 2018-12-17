<?php
namespace Germania\VatIdNo\Filters;

use Germania\VatIdNo\VatIdNoProviderInterface;

class WithVatIdNoFilterIterator extends \FilterIterator
{
    public $field = "vatin";

    public function __construct(\Traversable $iterator, $field = null)
    {
        if ($iterator instanceof \Iterator) {
            parent::__construct($iterator);
        } else {
            parent::__construct($iterator->getIterator());
        }

        $this->field = $field ?: $this->field;
    }

    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if ($current instanceof VatIdNoProviderInterface) {
            return !empty($current->getVatIdNo());
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
