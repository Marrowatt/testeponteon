<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    public function getCities ($estate) {

        $e = \App\Estate::select('code')->find($estate);

        $cities = City::where('state_code', $e->code)->select('id', 'name')->get();

        return $cities->toArray();
    }
}
