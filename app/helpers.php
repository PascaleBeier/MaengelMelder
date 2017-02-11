<?php

/**
 * @param string $title
 * @param string $message
 * @param string $type
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function flash(string $title, string $message, string $type = 'success') : Illuminate\Http\RedirectResponse
{
    return redirect()->back()->with([
        'flash.driver'  => Auth::guest() ? 'swal' : 'toastr',
        'flash.type'    => $type,
        'flash.title'   => $title,
        'flash.message' => $message,
    ]);
}
