<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanenController extends Controller
{
    public function index()
    {
        return view('data_hasil_panen'); // Mengarah ke view dashboard
    }
}