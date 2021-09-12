<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\OtcProduct;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function nearbyPharmacy(Request $request)
    {
        $userlat = $request->lat;
        $userlon = $request->lon;

        $pharmacies = Pharmacy::all();
        foreach ($pharmacies as $pharmacy) {
            $distance = $this->distance($userlat, $userlon, $pharmacy->latitude, $pharmacy->longitude,'K');
            $pharmacy->distance = $distance;
        }

        $data1 = $pharmacies->toArray();
        $data = $pharmacies->sortBy('distance');

        return $data1;
    }

    /**
     * view Otc Product
     *
     * @return Response
     */
    public function viewOtc()
    {
        $otcProducts = OtcProduct::paginate();
        return $this->jsonResponse($otcProducts, "Success");
    }
    
    /**
     * calculate distance
     *
     * @param  mixed $lat1
     * @param  mixed $lon1
     * @param  mixed $lat2
     * @param  mixed $lon2
     * @param  mixed $unit
     * @return float
     */
    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }



}
