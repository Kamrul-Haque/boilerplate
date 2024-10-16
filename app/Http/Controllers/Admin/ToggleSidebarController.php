<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToggleSidebarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sidebarState = $request->session()->get('show_sidebar', true);
        $request->session()->keep('show_sidebar', !$sidebarState);

        return response()->json(['show_sidebar' => !$sidebarState]);
    }
}
