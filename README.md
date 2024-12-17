# HanbitGaram Unique Id
## Description
Generates a unique, non-overlapping 14+ character ID that is URL-safe.

## Installation
```bash
composer require hanbitgaram/unique-id
```
```bash
composer.phar require hanbitgaram/unique-id
```

## Usage
```php
<?php
use Hanbitgaram\UniqueId\UniqueId;

$uniqId = new UniqueId();
echo $uniqId->generate(); // e.g. USQEnxIRF65H1w
```
