<?php

namespace App\Http\Controllers;

use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    protected $rajaOngkir;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }
    public function index(){
        return view("cek-ongkir");
    }
    public function getProvinces()
    {
        $provinces = $this->rajaOngkir->getProvince();
        return response()->json($provinces);
    }

    public function getCities($province_id)
    {
        $cities = $this->rajaOngkir->getCities($province_id);
        return response()->json($cities);
    }

    public function getCost(Request $request)
    {
        $cost = $this->rajaOngkir->getCost($request->origin, $request->destination, $request->weight, $request->courier);
        return response()->json($cost);
    }
}