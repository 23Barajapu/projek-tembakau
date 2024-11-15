<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use Illuminate\Http\JsonResponse;

class LahanController extends Controller
{
    public function index(): JsonResponse
    {
        $lahan = Lahan::all(); // Ambil semua data lahan dari database
        return response()->json($lahan);
    }
}