# Germania KG · VAT ID Number

**Interfaces, traits, and filters for dealing with VAT ID numbers**

[![Packagist](https://img.shields.io/packagist/v/germania-kg/vatidno.svg?style=flat)](https://packagist.org/packages/germania-kg/vatidno)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/vatidno.svg)](https://packagist.org/packages/germania-kg/vatidno)
[![Tests](https://github.com/GermaniaKG/VatIdNo/actions/workflows/tests.yml/badge.svg)](https://github.com/GermaniaKG/VatIdNo/actions/workflows/tests.yml)


## Installation

```bash
$ composer require germania-kg/vatidno
```



## Interfaces

### VatIdNoProviderInterface

Provides a method **VatIdNo** to retrieve the VATIN as string.

```php
use Germania\VatIdNo\VatIdNoProviderInterface;

/**	
 * @return string
 */
public function getVatIdNo();
```

### VatIdNoAwareInterface

Extends *VatIdNoProviderInterface* and provides a method **setVatIdNo**, allowing you to set the VATIN.

```php
use Germania\VatIdNo\VatIdNoProviderInterface;

/**	
 * @param  string $vatin
 * @return self
 */
public function setVatIdNo( $vatin );
public function getVatIdNo();
```



## Traits

### VatIdNoProviderTrait

Implements the **VatIdNoProviderInterface** and provides a public property **vatin:**

```php
use Germania\VatIdNo\VatIdNoProviderInterface;
use Germania\VatIdNo\VatIdNoProviderTrait;

class MyClass implements VatIdNoProviderInterface {

	use VatIdNoProviderTrait;
	
	public function __construct( $vatin ) {
		$this->vatin = $vatin;
	}
}
```


### VatIdNoAwareTrait

Implements the **VatIdNoAwareInterface**. Utilizes the *VatIdNoProviderTrait*. 

```php
use Germania\VatIdNo\VatIdNoAwareInterface;
use Germania\VatIdNo\VatIdNoAwareTrait;

class MyClass implements VatIdNoAwareInterface {
	use VatIdNoAwareTrait;
}

// Simple example
$object1 = new MyClass;
$object1->setVatIdNo( "XY000000" );

// Fluent interface
echo $object1->setVatIdNo( "XY000000" )->vatin;

// Setting using VatIdNoProviderInterface
$object2 = new MyClass;
$object2->setVatIdNo( $object1 );

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

To validate the VAT ID numbers, use a dedicated package like **David de Boer's [ddeboer/vatin](https://github.com/ddeboer/vatin)** package.

## Development

```bash
$ git clone https://github.com/GermaniaKG/VatIdNo.git
$ cd VatIdNo
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

