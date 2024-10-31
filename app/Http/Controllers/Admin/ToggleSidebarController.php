<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ToggleSidebarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sidebarState = Session::get('show_sidebar', true);
        Session::put('show_sidebar', !$sidebarState);

        return response()->json(['show_sidebar' => !$sidebarState]);
    }
}
