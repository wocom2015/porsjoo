<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    function index(Request $request){
        $province = Province::findOrFail($request->p);
        return $province->cities;
    }
}
