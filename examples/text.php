<?php

require_once '../vendor/autoload.php';

use Faruh\Smmry\SmmryClient;

$client = new SmmryClient([
	'sm_api_key'       => 'key',
	'sm_length'        => 7,
	'sm_keyword_count' => 2
//	'sm_with_break'    => true,
//	'sm_quote_avoid'   => true
]);

$result = $client
	->strategy('text')
	->setResource('Long Text Here...')
	->summarize();

dump($result);
