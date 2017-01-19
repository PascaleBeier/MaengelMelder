<?php

return [
    'key' => env('GOOGLE_MAPS_API_KEY', 'AIzaSyASZBHKY1L5Bwc9AcTnPINhuC9dzANOnRk'),
    'location' => [
    	'lat' => env('GOOGLE_MAPS_LOCATION_LAT', 51.601100),
	    'lng' => env('GOOGLE_MAPS_LOCATION_LNG', 7.089090)
    ]
];