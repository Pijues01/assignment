<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function getDistance(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'lat1' => 'required|numeric',
            'lng1' => 'required|numeric',
            'lat2' => 'required|numeric',
            'lng2' => 'required|numeric',
        ]);

        $lat1 = $request->lat1;
        $lng1 = $request->lng1;
        $lat2 = $request->lat2;
        $lng2 = $request->lng2;

        $distance = $this->calculateDistance($lat1, $lng1, $lat2, $lng2);

        return response()->json([
            'distance_km' => $distance . ' KM',
        ]);
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2, $unit = 'K')
    {
        $earthRadius = ($unit === 'K') ? 6371 : 3958.8; // Earth radius in KM or Miles

        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;

        $a = sin($dlat / 2) * sin($dlat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dlng / 2) * sin($dlng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2); // Distance rounded to 2 decimal places
    }
}
