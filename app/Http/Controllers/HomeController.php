<?php

namespace App\Http\Controllers;

use App\Models\Bazaar;
use App\Models\Deal;
use App\Models\Destination;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'destinations' => Destination::all(),
                'travelPackages' => TravelPackage::all(),
                'bazaars' => Bazaar::all(),
                'deals' => Deal::all()
            ]
        ]);
    }
}
