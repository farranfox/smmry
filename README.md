# Smmry PHP Client

By Faruh Narzullaev

[![Build Status](https://travis-ci.org/FaruhNarzullaev/smmry.svg?branch=master)](https://travis-ci.org/FaruhNarzullaev/smmry)

[![Smmry](http://smmry.com/sm_images/sm_logo.png)](http://smmry.com/)

### Installing via Composer

The recommended way to install Smmry PHP Client is through [Composer](http://getcomposer.org).

```bash
composer require faruh/smmry
```

## Usage

```php
<?php
    require 'vendor/autoload.php';

    use Faruh\Smmry\SmmryClient;

    $client = new SmmryClient([
        'sm_api_key'       => 'API_KEY',
        'sm_length'        => 7,
        'sm_keyword_count' => 2
    ]);

    $result = $client
    	->strategy('url')
    	->setResource('http://randomtextgenerator.com/')
    	->summarize();

    dump($result);
```

