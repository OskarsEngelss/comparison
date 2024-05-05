<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeCar;

class CarController extends Controller
{
    public function create()
    {
        return view('items.create_cars');
    }

}