<?php

namespace Faruh\Smmry\Test;

use Faruh\Smmry\SmmryClient;

/**
 * Class SmmryClientTest
 *
 * @package Faruh\Smmry\Test
 * @author  Faruh Narzullaev <faruh.narzullaev@sibers.com>
 */
class SmmryClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SmmryClient
     */
    protected $client;

    public function setUp()
    {
        if (!isset($_ENV['API_KEY'])) {
            $this->markTestSkipped('No API key available');
        }

        $this->client = new SmmryClient([
            'sm_api_key' => $_ENV['API_KEY']
        ]);
    }

    public function testSummarizeFromUrl()
    {
        $response = $this->makeApiCall(
            'url',
            'https://en.wikipedia.org/wiki/PHP'
        );

        $this->assertArrayNotHasKey('sm_api_error', $response);
    }

    public function testSummarizeFromText()
    {
        $response = $this->makeApiCall(
            'text',
            file_get_contents(__DIR__.'/longText.txt')
        );

        $this->assertArrayNotHasKey('sm_api_error', $response);
    }

    private function makeApiCall($strategy, $resource)
    {
        return  $this->client
            ->strategy($strategy)
            ->setResource($resource)
            ->summarize();
    }
}
