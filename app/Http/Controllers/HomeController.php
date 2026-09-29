<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $moduls = [
            'Modul 1: Pengenalan Laravel',
            'Modul 2: Routing',
            'Modul 3: Controller & Database',
            'Modul 4: Eloquent ORM',
            'Modul 5: Blade Templating'
        ];
        return view('home', compact('moduls'));
    }

    public function profile()
    {
        return view('profile');
    }
}
