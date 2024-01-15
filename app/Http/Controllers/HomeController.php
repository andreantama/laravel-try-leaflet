<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    public function index() {
        $mapImage = Storage::disk('s3_bucket_api_public_sandbox')->temporaryUrl("PETA-SOETOMO.png",  now()->addMinutes(1));
            // Baca konten gambar
            $gambarData = file_get_contents($mapImage);
            // Encode gambar ke dalam format Base64
            $gambarBase64 = base64_encode($gambarData);
            // Format data sebagai URL data
            $mapImage = 'data:image/jpeg;base64,' . $gambarBase64;

        return view("home",[
            "mapImage" => $mapImage
        ]);
    }
}
