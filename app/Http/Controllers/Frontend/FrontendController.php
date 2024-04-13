<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

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

        $data = DB::table("pages")->where('slug', "homepage")->get()->first();

        if ($data) {
            $meta_title = $data->meta_title;
            $meta_description = $data->meta_description;
        } else {
            $meta_title = "Cosmetic Surgery";
            $meta_description = "Cosmetic Surgery";
        }

        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => "",
            'name' => "Homepage",
        );

        return view('frontend.index', compact('body_class', 'module_name_singular', "$module_name_singular"));
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
        $doctor_details = DB::table('users')->select('*')->Where('is_active', 1)->where('username', $slug)->get()->first();
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

        $doctors = DB::table('users')->select('*')->whereNotNull('city')->Where('is_active', 1)->orderBy("sortable")->get()->toArray();

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
            'name' => "Cosmetic Surgeries 
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

    public function appointment()
    {
        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Book An Appointment",
            'meta_description' => "Book An Appointment",
            'meta_keywords' => "",
            'name' => "Book An Appointment",
        );

        return view('frontend.book-an-appointment', compact('body_class', 'module_name_singular', "$module_name_singular"));
    }


    public function contactus()
    {
        //echo ('view');
       // exit();
        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Contact us",
            'meta_description' => "Contact us",
            'meta_keywords' => "",
            'name' => "Contact us",
        );

        return view('frontend.contact-us', compact('body_class', 'module_name_singular', "$module_name_singular"));
    }

    public function contactlist(Request $request)
    {

       
            // echo "dsdss";
            // exit();
            // DD($request->all());
            // print_r($request->all());
            //$msg = "First line of text\nSecond line of text";
            //.. use wordwrap() if lines are longer than 70 characters
            //$msg = wordwrap($msg,70);
            
             $name = $request->name;
             $phone = $request->phone;
             $email = $request->email;
             $msg = $request->message;
             //echo $name;
             //exit();
            //    echo ('view');
            //     exit();
            $body_class = '';
            $module_name_singular = Str::singular("pages");
            $$module_name_singular = (object) array(
                'meta_title' => "Contact us",
                'meta_description' => "Contact us",
                'meta_keywords' => "",
                'name' => "Contact us",
            );


            $to = "ashwani@seobooklab.com";//change receiver address  
            $subject = "Contact Us";  
           // $message = "<h1>send msg message</h1>";  

                    $message = "
                            <html>
                            <head>
                            <title>Contact Us</title>
                            </head>
                            <body>
                            <h2>Contact Us !</h2>
                            <table>
                                <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>$name</td>    
                                </tr>
                                <tr>
                                <td>User Email</td>
                                <td>:</td>
                                <td>$email</td>    
                                </tr>
                                <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>$phone</td>   
                                </tr>
                                <tr>
                                <td>Message</td>
                                <td>:</td>
                                <td>$msg</td>    
                                </tr> 
                            </table>
                            </body>
                            </html>
                    ";

                   // echo $message;
                //exit();
            
            $header = "From:contact@seobooklab.com \r\n";  
            $header .= "MIME-Version: 1.0 \r\n";  
            $header .= "Content-type: text/html;charset=UTF-8 \r\n";  
            
            $result = mail ($to,$subject,$message,$header);  

        return view('frontend.contact-us', compact('body_class', 'module_name_singular', "$module_name_singular"));
    }

    public function blog_author($slug)
    {
        $slug = str_replace('-', ' ', ucwords($slug));
        $slug1 = $val = str_replace(' ', '', $slug);

        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => "Author" . ' ' . $slug,
            'meta_description' => "",
            'meta_keywords' => "",
            'name' => "What You Need to Know About Traveling Abroad for Cosmetic Surgery",
        );

        $posts = DB::table('posts')->where('author', $slug)->select('*')->paginate(6);
        return view('frontend.blog-author', compact('body_class', 'module_name_singular', "$module_name_singular", 'posts', 'slug', 'slug1'));
    }


    public function blog_category($slug)
    {
        $getCatBySlug = Category::where('slug', $slug)->first();

        $body_class = '';
        $module_name_singular = Str::singular("pages");
        $$module_name_singular = (object) array(
            'meta_title' => $getCatBySlug->meta_title,
            'meta_description' => $getCatBySlug->meta_description,
            'meta_keywords' => $getCatBySlug->meta_keywords,
            'name' => "Blog / Category / $slug",
        );

        $posts = DB::table('posts')->where('category_name', $slug)->select('*')->paginate(6);
        return view('frontend.blog-category', compact('body_class', 'module_name_singular', "$module_name_singular", 'posts', 'slug'));
    }
}
