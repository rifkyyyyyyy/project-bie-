<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        return view('akun'); // sesuaikan dengan nama view
    }
}
