<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Type;
use DB;

class VendorController extends Controller
{

    public function index($type_slug, $city_slug){
        $body_class = '';
        $city = City::where('slug', $city_slug)->get();
        $type = Type::where('slug', $type_slug)->get();
        $vendors = DB::table('vendors');
        $vendors->where('type_id', $type->id)->where('city_id', $city->id);
        if(1 == 1){

        }
        $vendors->get();

        return view('frontend.vendors.index', compact('body_class', 'vendors'));
    }
}
