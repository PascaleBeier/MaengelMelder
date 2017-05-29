<?php

namespace App\Http\Controllers;

use App\Category;
use GuzzleHttp\Client;
use Illuminate\Database\QueryException;

class FrontController extends Controller
{
    /**
     * @var Category
     */
    protected $category;

    /** @var Client */
    protected $client;

    /**
     * FrontController constructor.
     * @param Category $category
     * @param Client $client
     */
    public function __construct(Category $category, Client $client)
    {
        $this->category = $category;
        $this->client = $client;
    }

    /**
     * Homepage Controller.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Redirect to Setup if not yet installed
        if (! file_exists(storage_path('install.lock'))) {
            return redirect('setup');
        }

        // Get all active Categories
        $categories = $this->category->active();

        // Geocode client location from configured address
        $apiResponse = $this->client->get(
            'https://maps.googleapis.com/maps/api/geocode/json',
            ['query' => [
                'address' => config('app.location'),
                'key' => config('googlemaps.apiKey'),
                ]
            ])
            ->getBody()
            ->getContents();

        $bounds = json_decode($apiResponse)->results[0]->geometry->bounds;

        return view('frontend.index', compact('bounds', 'categories'));
    }
}
