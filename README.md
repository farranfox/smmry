# Smmry PHP Client [![Build Status](https://travis-ci.org/FaruhNarzullaev/smmry.svg?branch=master)](https://travis-ci.org/FaruhNarzullaev/smmry)

By Faruh Narzullaev

[![Smmry](http://smmry.com/sm_images/sm_logo.png)](http://smmry.com/)

### Installing via Composer

The recommended way to install Smmry PHP Client is through [Composer](http://getcomposer.org).

```bash
composer require faruh/smmry
```

## Usage

```php
<?php
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
```

Go to http://smmry.com/partner to obtain your key.

Documentation: http://smmry.com/api
