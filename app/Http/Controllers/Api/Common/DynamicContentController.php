<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Diagnostic;
use App\Models\District;
use App\Models\Division;
use App\Models\LabTest;
use App\Models\Pet;
use Illuminate\Http\Request;

class DynamicContentController extends Controller
{
    public function get_lab_test(): \Illuminate\Http\JsonResponse
    {
        $tests = LabTest::pluck('name');
        return response()->json($tests, 200);
    }
    public function get_districts(): \Illuminate\Http\JsonResponse
    {
        $districts = Division::select('id', 'name', 'bn_name')->orderBy('name', 'ASC')->get();
        return response()->json($districts, 200);
    }

    public function get_pets($district_id)
    {
        $pets = Pet::where('district_id', $district_id)->select('id', 'name', 'address', 'phone')->get();
        return response()->json($pets, 200);
    }

    public function get_diagnostics($district_id)
    {
        $pets = Diagnostic::where('district_id', $district_id)->select('id', 'name', 'address', 'phone')->get();
        return response()->json($pets, 200);
    }

    public function get_ambulancs($district_id)
    {
        $pets = Ambulance::where('district_id', $district_id)->select('id', 'name', 'address', 'phone')->get();
        return response()->json($pets, 200);
    }

}
