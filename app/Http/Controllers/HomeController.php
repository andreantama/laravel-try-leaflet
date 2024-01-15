<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    public function index() {
    
        $mapImage = Route("peta");

        return view("home",[
            "mapImage" => $mapImage
        ]);
    }
}
