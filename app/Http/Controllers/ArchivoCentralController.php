<?php

namespace App\Http\Controllers;

class ArchivoCentralController extends Controller
{
    public function __invoke()
    {
        return view('archivo-central');
    }
}
