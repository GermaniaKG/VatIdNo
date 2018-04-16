# Germania KG · VAT ID Number

**Interfaces and traits for VAT ID numbers**



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
