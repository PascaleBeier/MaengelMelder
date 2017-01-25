<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Report;
use Validator;
use App\Google\Services\Geocode;

class PageController extends Controller
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }


    public function index()
    {
        $categories = Category::all();

        return view('frontend.index', compact('categories'));
    }

    public function store(Request $request, Geocode $geocode)
    {
        $this->validate($request, [
            'category_id' => 'required|integer|max:255',
            'body' => 'required',
            'image' => 'image',
            'address' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $latLng = $geocode->latLng($request->get('address'));

        $report = new Report();
        $report->category_id = $request->get('category_id');
        $report->body = $request->get('body');
        $report->name = $request->get('name');
        $report->address = $request->get('address');
        $report->lat = $latLng['lat'];
        $report->lng = $latLng['lng'];

        $report->save();

        if ($request->hasFile('image')) {
            $report->addMedia($request->file('image'))->toCollection('images');
        }

        return redirect()->back()->with([
            'type' => 'success',
            'title' => 'Meldung erfolgreich versendet!',
            'message' => 'Vielen Dank für Ihre Mithilfe! Wir haben Ihre Meldung erhalten.'
        ]);
    }
}
