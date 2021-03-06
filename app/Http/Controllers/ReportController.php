<?php

namespace App\Http\Controllers;

use App\Image;
use App\Report;
use Illuminate\Http\Request;
use function App\Helpers\flash;
use App\Http\Requests\StoreReport;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    /**
     * @var Report
     */
    protected $report;

    /**
     * ReportController constructor.
     *
     * @param Report $report
     * @param Helpers $helpers
     */
    public function __construct(Report $report, Helpers $helpers)
    {
        $this->report = $report;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = $this->report->all();

        return view('backend.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreReport  $request
     * @return RedirectResponse
     */
    public function store(StoreReport $request)
    {
        $this->report
            ->fill($request->all())
            ->save();

        // Attach image to Report if existent
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = uniqid('img').'.'.$file->getClientOriginalExtension();
            $path = public_path('images');
            $file->move($path, $name);
            $image = new Image();
            $image->path = 'images';
            $image->name = $name;
            $image->save();
            $this->report->image()->save($image);
        }

        return flash(
            'Meldung erfolgreich versendet!',
            'Vielen Dank für Ihre Mithilfe! Wir haben Ihre Meldung erhalten.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('backend.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
