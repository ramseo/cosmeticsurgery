<?php

namespace Modules\Cms\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Modules\Cms\Events\PageViewed;
use DB;
use App\Models\leadform;

class PagesController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'pages';

        // module name
        $this->module_name = 'pages';

        // directory path of the module
        $this->module_path = 'pages';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "Modules\Cms\Entities\Page";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::latest()->paginate();

        return view(
            "cms::frontend.$module_path.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular')
        );
    }

    public function lead_form(Request $request)
    {
        parse_str($request->form_data, $post);

        $data = [];
        $data['name'] = $post['name'];
        $data['phone'] = $post['phone'];
        $data['email'] = $post['email'];
        $data['location'] = $post['location'];
        $data['age'] = $post['age'];
        $data['gender'] = $post['gender'];
        $data['appointment_for'] = $post['appointment_for'];
        $data['message'] = $post['message'];
        $data['url'] = $post['url'];
        $data['time'] = $post['time'];

        $status = leadform::create($data);

        $response = [];
        if ($status) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($slug)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        // template functions
        $citiesArr = citiesArr();
        $citiesSurgeriesArr = citiesSurgeriesArr('popular-surgeries');
        $checkForCityView = contains_str($slug, $citiesSurgeriesArr);
        $popular_surgeries_arr = popular_surgeries_arr("popular-surgeries");

        if ($checkForCityView == true) {

            if (in_array($slug, $popular_surgeries_arr)) {

                $$module_name_singular = $module_model::where('slug', '=', $slug)->firstOrFail();
                event(new PageViewed($$module_name_singular));

                $template_view = "popular-surgeries";
                $city = "";
                $surgery_str = "";
            } else {
                $template_view = "rhinoplasty-city";
                $explodeArr = explode('-', $slug);
                $duplicateArr = array_intersect($explodeArr, $citiesArr);

                if ($duplicateArr) {
                    $city = reset($duplicateArr);
                } else {
                    $city = "";
                }

                $surgery_explodeArr = explode('-', $slug);
                $key = array_search($city, $surgery_explodeArr, true);
                if ($key !== false) {
                    unset($surgery_explodeArr[$key]);
                }

                $surgery_str = implode(" ", $surgery_explodeArr);
                $uc_surgery_str = ucwords($surgery_str);
                $uc_city = ucwords($city);

                // dddddd
                if ($surgery_str == "rhinoplasty") {
                    $meta_title = "Rhinoplasty Clinic in $uc_city | Nose Surgery Cost | Nose Job";
                    $meta_description = "Board certified surgeons for Rhinoplasty in $uc_city. Visit the cost-effective Cosmetic surgery clinic for nose surgery or nose job today.";
                } else if ($surgery_str == "blepharoplasty") {
                    $meta_title = "Blepharoplasty Clinic in $uc_city | Eyelid Surgery Cost";
                    $meta_description = "Get consultation from the Board certified surgeons for blepharoplasty. Get rid of unwanted eyelid skin from eyelid surgery clinic in $uc_city at a reasonable cost.";
                } elseif ($surgery_str == "facelift") {
                    $meta_title = "Facelift Clinic in $uc_city | Facelift Surgery Cost";
                    $meta_description = "Reverse your aging effects at the top Facelift surgely clinic in $uc_city by Board certified surgeons at a reasonable cost.";
                } elseif ($surgery_str == "brow lift") {
                    $meta_title = "Brow Lift Clinic in $uc_city | Forehead/Eyebrow Surgery Cost";
                    $meta_description = "The cost of brow lift surgery in $uc_city depends on the clinic and the cosmetic surgeon. Visit our clinic today for reasonable brow lift surgery.";
                } elseif ($surgery_str == "neck lift") {
                    $meta_title = "Neck Lift Clinic in $uc_city | Neck Lift Surgery Cost";
                    $meta_description = "Get consultation from the Board certified surgeons for Necklift procedure. Visit Top cosmetic surgery clinic in $uc_city for Necklift procedure at a reasonable cost.";
                } elseif ($surgery_str == "chin surgery") {
                    $meta_title = "Chin Augmentation Clinic in $uc_city | Chin Surgery Cost";
                    $meta_description = "Get consultation from the Board certified surgeons to perform cost-effective Chin Augmentation surgery at the best cosmetic surgery clinic in $uc_city.";
                } elseif ($surgery_str == "cheek augmentation") {
                    $meta_title = "Cheek Augmentation in $uc_city | Cheek Implant Surgery Cost";
                    $meta_description = "Improve your facial features at Cheek Augmentation surgery clinic in $uc_city. Get consultation from the Board certified surgeons to reshapes the cheek at a reasonable cost.";
                } elseif ($surgery_str == "lip augmentation") {
                    $meta_title = "Lip Fillers Surgeon in $uc_city | Lip Augmentation Cost";
                    $meta_description = "Top Cosmetic surgery clinic for Lip Augmentation surgery in $uc_city. Visit us today, the best surgeons to enhance your lips at reasonable cost.";
                } elseif ($surgery_str == "buccal fat removal") {
                    $meta_title = "Buccal Fat Removal $uc_city | Buccal Fat Removal Surgery Cost";
                    $meta_description = "Top Buccal fat removal clinic in $uc_city to regain facial contours. Go for cost-effective Bichectomy from the Board certified surgeons.";
                } elseif ($surgery_str == "ear surgery") {
                    $meta_title = "Ear Correction Surgery Clinic in $uc_city | Otoplasty Surgery Cost";
                    $meta_description = "Leading cosmetic surgery clinic for Ear Surgery in $uc_city. Get consultation from the Board certified surgeons to perform otoplasty at a reasonable cost.";
                } elseif ($surgery_str == "breast augmentation") {
                    $meta_title = "Breast Augmentation in $uc_city | Breast Implants Surgery Cost";
                    $meta_description = "The best and cost-effective cosmetic surgery clinic in $uc_city to restore your breast size. Visit us today, the Board certified surgeons today.";
                } elseif ($surgery_str == "breast lift") {
                    $meta_title = "Breast Lift Clinic in $uc_city | Breast Lift Surgery Cost";
                    $meta_description = "The Best Cosmetic surgery clinic for breast lift in $uc_city. Get consultation from the Board certified surgeons to enhance your breasts at reasonable cost.";
                } elseif ($surgery_str == "breast reduction") {
                    $meta_title = "Breast Reduction Surgery in $uc_city | Breast Reduction Cost";
                    $meta_description = "Reduce your breasts by Board certified surgeons of $uc_city. All you need is to meet Drs in our cosmetic surgery clinic in $uc_city.";
                } elseif ($surgery_str == "breast implant removal") {
                    $meta_title = "Breast Implant Removal in $uc_city | Breast Surgery Cost";
                    $meta_description = "Cost-effective Breast implant removal in $uc_city, the Board certified surgeons. Visit the best cosmetic surgery clinic today.";
                } elseif ($surgery_str == "breast implant revision") {
                    $meta_title = "Breast Implant Revision in $uc_city | Breast Surgery Cost";
                    $meta_description = "Cost-effective Breast implant revision at the best cosmetic surgery clinic in $uc_city, the Board certified surgeons.";
                } elseif ($surgery_str == "gynecomastia") {
                    $meta_title = "Gynecomastia in $uc_city | Male Breast Reduction Surgery Cost";
                    $meta_description = "Get consultation from the Board certified surgeons for Male Breast reduction at a reasonable cost. Visit top Cosmetic surgery clinic for Gynecomastia in $uc_city.";
                } elseif ($surgery_str == "liposuction") {
                    $meta_title = "Liposuction Clinic in $uc_city | Fat Reduction Surgery Cost";
                    $meta_description = "Top Liposuction clinic in $uc_city. Get consultation from the Board certified surgeons for extra fat removal process at a reasonable cost.";
                } elseif ($surgery_str == "tummy tuck") {
                    $meta_title = "Tummy Tuck Clinic in $uc_city | Abdominoplasty Surgery Cost";
                    $meta_description = "The Board certified surgeons for better abdomen profile. Visit Top Cosmetic surgery clinic for Tummy Tuck in $uc_city at a reasonable cost";
                } elseif ($surgery_str == "buttock enhancement") {
                    $meta_title = "Buttock Enhancement Clinic $uc_city | Buttock Augmentation Cost";
                    $meta_description = "Buttock Enhancement surgery in $uc_city to reshape your Buttocks. Visit us today, the Board certified surgeons for affordable Butt implant.";
                } elseif ($surgery_str == "body lift") {
                    $meta_title = "Body Lift Clinic in $uc_city | Body Countouring Surgery Cost";
                    $meta_description = "The Board certified surgeons for cost-effective saggy skin removal. Vist top Cosmetic surgery clinic for Body Lift in $uc_city today.";
                } elseif ($surgery_str == "arm lift") {
                    $meta_title = "Arm Lift Clinic in $uc_city | Brachioplasty Surgery Cost";
                    $meta_description = "The Board certified surgeons for arm lift and saggy arm skin removal. Visit the best and affordabe cosmetic surgery clinic in $uc_city today.";
                } elseif ($surgery_str == "thigh lift") {
                    $meta_title = "Thigh Lift Clinic in $uc_city | Thigh Reduction Surgery Cost";
                    $meta_description = "Get consultation from thigh lift surgeons in the top cosmetic surgery clinic in $uc_city. Board certified surgeons for affordable saggy thigh skin removal.";
                } elseif ($surgery_str == "body contouring") {
                    $meta_title = "Body Contouring Clinic in $uc_city | Fat Reduction Surgery Cost";
                    $meta_description = "Get consultation from the Board certified surgeons in the top Cosmetic surgery clinic for cost-effective Body Contouring in $uc_city.";
                } elseif ($surgery_str == "mommy makeover") {
                    $meta_title = "Mommy Makeover Clinic in $uc_city | Post Pregnancy Surgery Cost";
                    $meta_description = "Get consultation from the Board certified surgeons for affordable Mommy Makeover in the the top cosmetic surgery, $uc_city.";
                } elseif ($surgery_str == "hair transplant") {
                    $meta_title = "Hair Transplant in $uc_city | Hair Transplant Surgery Cost";
                    $meta_description = "Top Cosmetic surgery clinic for cost-effective Hair Transplant in $uc_city. Consult us today, Board certified surgeons for Hair Transplant process.";
                } elseif ($surgery_str == "men and plastic surgery") {
                    $meta_title = "Men Cosmetic Surgery Clinic in $uc_city | Plastic Surgery Cost";
                    $meta_description = "Top Cosmetic surgery clinic for Men in $uc_city. Visit us today, Board certified surgeons for afforfable Male plastic surgery.";
                } else {
                    $meta_title = "";
                    $meta_description = "";
                }
                // dddddd

                $$module_name_singular = (object) array(
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_keywords' => "",
                    'name' => ucwords("The Most Skilled Cosmetic Surgeon for $uc_surgery_str in $uc_city"),
                );
            }
        } elseif (in_array($slug, $citiesArr)) {
            $city = ucwords($slug);
            $uc_city = ucwords($slug);
            $template_view = "city-temp";
            $surgery_str = "";
            $$module_name_singular = (object) array(
                "meta_title" => "Best Plastic Surgeon Clinic in" . " " . ucwords(str_replace("-", " ", $uc_city)) . " " . "| Cosmetic Surgery Cost",
                'meta_description' => "Top Cosmetic Surgery Clinic in $uc_city. Book your appointment with Board Certified Plastic Surgeon to get the right opinion for your treatment.",
                'meta_keywords' => "",
                'name' => "Find the best Cosmetic Surgeon in $uc_city",
            );
        } else {
            $$module_name_singular = $module_model::where('slug', '=', $slug)->firstOrFail();
            event(new PageViewed($$module_name_singular));

            $template_view = "show";
            $city = "";
            $surgery_str = "";
        }
        // template functions 

        return view(
            "cms::frontend.$module_name.$template_view",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", "city", "surgery_str")
        );
    }
}
