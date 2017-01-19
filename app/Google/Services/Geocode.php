<?php

namespace App\Google\Services;

use function GuzzleHttp\json_decode;

class Geocode extends Service
{
	protected $name = 'geocode';

	public function latLng(string $address) : array
	{
		$address = urlencode($address);

		$response = $this->connect()
                         ->get('json', ['query' => ['address' => $address]])
                         ->getBody();

		$array = json_decode($response, true);

		$latLng = $array['results'][0]['geometry']['location'];

		return $latLng;
	}

}