<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estate;

class EstateController extends Controller
{
    public function getEstates () {

        $estates = Estate::select('id', 'name')->get();

        return $estates->toArray();
    }
}
