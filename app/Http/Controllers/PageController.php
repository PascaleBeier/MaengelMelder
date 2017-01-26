<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ {
    Report,
    Category
};
use Validator;

class PageController extends Controller
{
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $report = new Report();
        $report->fill($request->all());
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
