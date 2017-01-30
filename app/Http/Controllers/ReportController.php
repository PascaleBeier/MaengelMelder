<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use App\Events\UserSentReportEvent;
use App\Http\Requests\StoreReport;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReport $request)
    {
        $report = new Report();
        $report->fill($request->all());
        $report->save();

        event(new UserSentReportEvent($report, $request));

        return redirect()->back()->with([
            'flash.driver'  => Auth::guest() ? 'swal' : 'toastr',
            'flash.type'    => 'success',
            'flash.title'   => 'Meldung erfolgreich versendet!',
            'flash.message' => 'Vielen Dank für Ihre Mithilfe! Wir haben Ihre Meldung erhalten.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
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
