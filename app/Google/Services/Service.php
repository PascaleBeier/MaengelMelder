<?php

namespace App\Google\Services;

use GuzzleHttp\Client;

class Service
{
	/**
	 * @var Client Guzzle HTTP Client Object
	 */
	protected $client;

	/**
	 * @var string base url
	 */
	protected $url = 'https://maps.googleapis.com/maps/api/';

	/**
	 * @var string name of the service
	 */
	protected $name = '';

	/**
	 * Service constructor.
	 *
	 * Mainly used for Dependency Injection.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client) {
		$this->client = $client;
	}

	/**
	 * Connect to a Service and return
	 * a Guzzle HTTP Client Object.
	 *
	 * @return Client
	 */
	protected function connect() : Client
	{
		return new $this->client([
			'base_uri' => $this->url.$this->name.'/',
		]);
	}
}
