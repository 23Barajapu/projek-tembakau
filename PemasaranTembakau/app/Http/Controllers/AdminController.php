<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        return view('BackEnd.home');
    }

    function barang()
    {
        return view('BackEnd.daftar_barang');
    }
}
