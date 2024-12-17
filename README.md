# HanbitGaram Unique Id
## Description
Generates a unique, non-overlapping 14-character ID that is URL-safe.

## Installation
```bash
composer require hanbitgaram/uniqid
```
```bash
composer.phar require hanbitgaram/uniqid
```

## Usage
```php
<?php
use HanbitGaram\UniqueId;

$uniqId = new UniqueId();
echo $uniqId->generate(); // e.g. USQEnxIRF65H1w
```
