<?php

namespace Faruh\Smmry;

/**
 * Class SmmryClient
 *
 * @package Faruh\Smmry
 * @author  Faruh Narzullaev <faruh.narzullaev@sibers.com>
 */
class SmmryClient implements SummaryInterface
{
	const BASE_API_URL = 'http://api.smmry.com/';

	/**
     * Curl "resource" type variable.
     *
     * @var resource
     */
    protected $curl;

	/**
     * @var string
     */
    protected $strategy;

    /**
     * Url or long text to summarize.
     *
     * @var string
     */
    protected $resource;

	/**
	 * Smmry's API parameters.
	 * 
	 * @var array
	 */
	private $parameters = [];

    /**
     * @param array $parameters
     */
	public function __construct(array $parameters = [])
	{
		$this->parameters = array_change_key_case($parameters, CASE_UPPER);
	}

    /**
     * @param string $strategy
     *
     * @return SmmryClient
     * @throws \Exception
     */
	public function strategy($strategy)
	{
		if (false === in_array($strategy, ['url', 'text'])) {
			throw new \Exception('Invalid strategy provided.');
		}
		
		$this->strategy = $strategy;

        return $this;
	}

	/**
     * Initialize curl "resource" object with default options
     * and some extra specific options according to strategy.
     */
    private function initializeCurl()
    {
        $url =
            self::BASE_API_URL
            .
            http_build_query($this->parameters);

        $defaults = [
            CURLOPT_URL            => $url,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 20
        ];

        if ('text' === $this->strategy) {
            $specificOptions = [
                CURLOPT_POST       => true,
                CURLOPT_HTTPHEADER => ['Expect:'],
                CURLOPT_POSTFIELDS => 'sm_api_input='.$this->resource
            ];
        } else {
            $specificOptions = [
                CURLOPT_URL => $url.'&SM_URL='.$this->resource
            ];
        }

        $this->curl = curl_init();
        curl_setopt_array($this->curl, ($specificOptions + $defaults));
    }

    /**
     * {@inheritdoc}
     */
    public function setResource($resource)
    {
    	if ('url' === $this->strategy) {
			if (false === filter_var($resource, FILTER_VALIDATE_URL)) {
				throw new \Exception('Invalid URL.');
			}
    	}

        $this->resource = $resource;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function summarize()
    {
        $this->initializeCurl();

        $response = curl_exec($this->curl);

        if (curl_errno($this->curl)) {
            throw new \Exception(curl_error($this->curl));
        }

        curl_close($this->curl);
        $response = json_decode($response, true);

        if (isset($response['sm_api_error'])) {
            throw new \Exception($response['sm_api_message']);
        }
        
		return $response;
    }
}
