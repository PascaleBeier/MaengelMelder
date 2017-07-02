<?php

namespace App\Helpers;

/**
 * Redirect with Flash Message: toastr for Backend, swal for Frontend.
 *
 * @param string $title Flash Message Title
 * @param string $message Flash Message Body
 * @param string $type Flash Message Type
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

/**
 * Redirect to specified named Route with Flash Message.
 *
 * @param string $title Flash Message Title
 * @param string $message Flash Message Body
 * @param string $route Route Name to redirect to
 * @param string $type Flash Message Type
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function flashTo($title, $message, $route, $type = 'success')
{
    return redirect()->route($route)->with([
        'flash.driver'  => request()->is('admin/*') ? 'toastr' : 'swal',
        'flash.type'    => $type,
        'flash.title'   => $title,
        'flash.message' => $message,
    ]);
}
