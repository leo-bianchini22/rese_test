<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigateController extends Controller
{
    public function nav()
    {
        return view('nav');
    }

    public function previousPage(Request $request)
    {
        $previousUrl = $request->session()->get('previous_url');
        return redirect()->to($previousUrl);
    }
}
