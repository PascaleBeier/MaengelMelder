<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Report;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|integer|max:255',
            'body' => 'required',
            'image' => 'image',
            'address' => 'required|max:255',
            'prename' => 'max:255',
            'name' => 'max:255',
        ]);

        $report = $this->report->create($request->only([
            'category_id',
            'body',
            'address',
            'prename',
            'name'
        ]));

        $report->addMedia($request->file('image'))->toCollection('images');

        return redirect()->back()->with('success', 'Meldung erfolgreich versendet!');
    }
}
