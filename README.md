# Germania KG · VAT ID Number

**Interfaces and traits for VAT ID numbers**

[![Build Status](https://travis-ci.org/GermaniaKG/VatIdNo.svg?branch=master)](https://travis-ci.org/GermaniaKG/VatIdNo)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/VatIdNo/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/VatIdNo/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/VatIdNo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/VatIdNo/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/VatIdNo/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/VatIdNo/build-status/master)


## Installation

```bash
$ composer require germania-kg/vatidno
```



## Interfaces and Traits

```php
use Germania\VatIdNo\VatIdNoProviderInterface;
use Germania\VatIdNo\VatIdNoProviderTrait;

// public function getVatIdNo();
```

These ***Aware*** interfaces and traits extend the above **Providers**:

```php
use Germania\VatIdNo\VatIdNoAwareInterface;
use Germania\VatIdNo\VatIdNoAwareTrait;

// $vatin = "XY000000";
// $vatin = Instance of VatIdNoProviderInterface
// public function setVatIdNo( $vatin );
```

## Filters

### WithVatIdNoFilterIterator

Filter for records that *do provide* a VATIN. These may be:

- Arrays with `vatin` key, and non-empty value
- Objects with `vatin` property, and non-empty value
- Instances of `VatIdNoProviderInterface`  where *getVatIdNo* results *not empty*

```php
<?php
use Germania\VatIdNo\Filters\WithVatIdNoFilterIterator;

$records = new \ArrayIterator( ask_database() );

// Allow custom field names in arrays or objects
$records_with_vatin = new WithoutVatIdNoFilterIterator( $records );
$records_with_vatin = new WithoutVatIdNoFilterIterator( $records, "ust_id" );

foreach( $records_with_vatin as $item):
 // Do things like validating
endforeach;
```



### WithoutVatIdNoFilterIterator

Filter for records that do *not* provide a VATIN. These may be:

- Arrays lacking `vatin` key, or empty `vatin` element
- Objects lacking `vatin` property, or empty `vatin` property
- Instances of `VatIdNoProviderInterface`  where *getVatIdNo* results empty

```php
<?php
use Germania\VatIdNo\Filters\WithoutVatIdNoFilterIterator;

$records = new \ArrayIterator( ask_database() );

// Allow custom field names in arrays or objects
$records_lacking = new WithoutVatIdNoFilterIterator( $records );
$records_lacking = new WithoutVatIdNoFilterIterator( $records, "ust_id" );

foreach( $records_lacking as item):
 //...
endforeach;
```





## Validation

To validate the VAT ID numbers, use **David de Boer's [ddeboer/vatin](https://github.com/ddeboer/vatin)** package.


## Development

```bash
$ git clone https://github.com/GermaniaKG/VatIdNo
$ cd VatIdNo
$ composer install
```


## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. 
Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```
