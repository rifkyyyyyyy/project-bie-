<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('forms'); // pastikan view 'forms.blade.php' ada
    }
}
