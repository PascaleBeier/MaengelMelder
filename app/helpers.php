<?php

/**
 * Redirect with Flash Message: toastr for Backend, swal for Frontend.
 *
 * @param string $title
 * @param string $message
 * @param string $type
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function flash($title, $message, $type = 'success')
{
    return redirect()->back()->with([
        'flash.driver'  => request()->is('admin/*') ? 'toastr' : 'swal',
        'flash.type'    => $type,
        'flash.title'   => $title,
        'flash.message' => $message,
    ]);
}
