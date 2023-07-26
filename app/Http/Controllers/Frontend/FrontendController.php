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
        $uri_string = \Request::getRequestUri();
        if ($uri_string == "/home") {
            return \Redirect::to(url('/'), 301);
        }

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

    public function surgeon_profile($slug)
    {
        // get doctor & city
        $doctor_details = DB::table('users')->select('*')->where('username', $slug)->get()->first();
        if (!$doctor_details) {
            return abort(404);
        }

        $citiesStr = getCitiesById($doctor_details->city, "html");
        $citiesStrMeta = getCitiesById($doctor_details->city, "meta");
        // get doctor & city

        // Add missing data
        $doctor_userprofiles = DB::table('userprofiles')->select('*')->where('user_id', $doctor_details->id)->get()->first();
        $doctor_details->address = $doctor_userprofiles->address;
        $doctor_details->year_experience = $doctor_userprofiles->bio;
        // Add missing data

        // results before/after
        $all_result_category = DB::table('albums')->where('vendor_id', $doctor_details->id)->where('status', 1)->select('*')->get();

        $album_ids = [];
        if ($all_result_category) {
            $array = json_decode(json_encode($all_result_category), true);
            $album_ids = array_column($array, 'id');
        }

        $all_result_category_imgs = DB::table('images')->whereIn('album_id', $album_ids)->select('*')->get();
        if ($all_result_category_imgs->isEmpty()) {
            $all_result_category = collect([]);
        }
        // results before/after

        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Dr. " . $doctor_details->first_name . " " . $doctor_details->last_name . " – Top Plastic Surgeon in $citiesStrMeta",
            'meta_description' => "Dr. " . $doctor_details->first_name . " " . $doctor_details->last_name . " is one of the best plastic / cosmetic surgeons in $citiesStrMeta. Book your appointment with Board Certified Plastic Surgeon to get the right opinion for your treatment.",
            'meta_keywords' => "",
            'name' => "Dr. " . $doctor_details->first_name . " " . $doctor_details->last_name . " – Top Plastic Surgeon in $citiesStrMeta",
        );

        return view("frontend.doctor-profile", compact('body_class', 'module_name_singular', "$module_name_singular", 'doctor_details', 'citiesStr', 'all_result_category', 'all_result_category_imgs'));
    }

    public function clinics()
    {
        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Top Cosmetic Surgery Clinics in India | Best Plastic Surgeons",
            'meta_description' => "Find the best cosmetic surgery clinic in your city. Book your appointment with Board Certified Cosmetic Surgeon across India.",
            'meta_keywords' => "",
            'name' => "Clinics",
        );

        return view('frontend.clinics', compact('body_class', 'module_name_singular', "$module_name_singular"));
    }

    public function surgeons()
    {
        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Top Cosmetic Surgery Clinics in India | Best Plastic Surgeons",
            'meta_description' => "Find the best cosmetic surgery clinic in your city. Book your appointment with Board Certified Cosmetic Surgeon across India.",
            'meta_keywords' => "",
            'name' => "Find A Surgeon",
        );

        $doctors = DB::table('users')->select('*')->whereNotNull('city')->orderBy("first_name")->get()->toArray();

        return view('frontend.surgeons', compact('body_class', 'module_name_singular', "$module_name_singular", 'doctors'));
    }

    public function procedures()
    {
        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Top Cosmetic Surgery Clinics in India | Best Plastic Surgeons",
            'meta_description' => "Find the best cosmetic surgery clinic in your city. Book your appointment with Board Certified Cosmetic Surgeon across India.",
            'meta_keywords' => "",
            'name' => "Cosmetic Surgery Procedures 
            ",
        );

        return view('frontend.procedures', compact('body_class', 'module_name_singular', "$module_name_singular"));
    }

    public function before_after_results()
    {
        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Cosmetic Surgery Before and After Photos | Videos Results",
            'meta_description' => "Have you ever seen the before and after results of the cosmetic surgeries performed ? Check out our patients results photo gallery here to get an idea",
            'meta_keywords' => "",
            'name' => "Before & After",
        );

        $all_result_category = DB::table('albums')->select('*')->where('status', 1)->groupBy("name")->orderBy('name')->get();

        return view('frontend.before-after-results', compact('body_class', 'module_name_singular', "$module_name_singular", 'all_result_category'));
    }

    public function before_after_result_details($slug)
    {
        $explode = explode("-", $slug);
        $name = ucwords(implode(" ", $explode));

        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "$name Before / After Photos | $name Results",
            'meta_description' => "Have a quick look on $name Before and After Result Photos Gallery of our patients, performed by our Board-Certified Cosmetic Surgeons.",
            'meta_keywords' => "",
            'name' => $name . " " . "Results",
        );

        $result_category = DB::table('albums')->where('name', $name)->select('*')->get();

        $album_ids = json_decode(json_encode($result_category), true);
        if ($album_ids) {
            $album_ids = array_column($album_ids, 'id');
        }

        $result_images = NULL;
        if ($album_ids) {
            $result_images = DB::table('images')->select('*')->whereIn('album_id', $album_ids)->get();
        }

        return view('frontend.before-after-result-details', compact('body_class', 'module_name_singular', "$module_name_singular", 'slug', 'name', 'result_images'));
    }
}