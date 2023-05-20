<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LandingController extends Controller
{
    public function admin(): View
    {
        return view('admin.landing');
    }
}
