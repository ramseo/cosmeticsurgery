<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $body_class = '';

        return view('frontend.index', compact('body_class'));
    }

    public function home()
    {

        $body_class = '';

        return view('frontend.home', compact('body_class'));
    }

    public function listing()
    {
        $body_class = '';

        return view('frontend.vendor', compact('body_class'));
    }

    public function detail()
    {
        $body_class = '';

        return view('frontend.detail', compact('body_class'));
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $body_class = '';

        return view('frontend.privacy', compact('body_class'));
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $body_class = '';

        return view('frontend.terms', compact('body_class'));
    }

    public function doctor_profile($id)
    {
        // get doctor & city
        $doctor_details = DB::table('users')->select('*')->where('id', $id)->get()->first();
        $city = getCityById($doctor_details->city);
        // get doctor & city

        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Dr. " . $doctor_details->first_name . " " . $doctor_details->last_name . " – Top Plastic Surgeon in $city->name",
            'meta_description' => "Dr. " . $doctor_details->first_name . " " . $doctor_details->last_name . " is one of the best plastic / cosmetic surgeons in $city->name. Book your appointment with Board Certified Plastic Surgeon to get the right opinion for your treatment.",
            'meta_keywords' => "",
            'name' => "Dr. " . $doctor_details->first_name . " " . $doctor_details->last_name . " – Top Plastic Surgeon in $city->name",
        );

        return view("frontend.doctor-profile", compact('body_class', 'module_name_singular', "$module_name_singular", 'doctor_details', 'city'));
    }
}
