<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\ {
    Http\Requests\StoreReport,
    Report,
    Category,
    Mail\ReportSent
};
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('frontend.index', compact('categories'));
    }

    /**
     * Store the incoming report.
     *
     * @param StoreReport $request
     * @return Response
     */
    public function store(StoreReport $request)
    {
        $report = new Report();
        $report->fill($request->all());
        $report->save();

        // If an image was uploaded an validated, attach it to the just created report.
        if ($request->hasFile('image')) {
            $report->addMedia($request->file('image'))->toCollection('images');
        }

        // Send a confirmation E-Mail
        Mail::to($request->email)
            ->send(new ReportSent($report));

        return redirect()->back()->with([
            'flash.driver' => 'swal',
            'flash.type' => 'success',
            'flash.title' => 'Meldung erfolgreich versendet!',
            'flash.message' => 'Vielen Dank für Ihre Mithilfe! Wir haben Ihre Meldung erhalten.'
        ]);
    }
}
