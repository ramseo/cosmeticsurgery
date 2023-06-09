<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use App\Models\Content;
use App\Models\Type;
use App\Models\Vendor;
use App\Models\VendorReview;
use App\Models\VendorReviewReply;
use App\Models\CallChat;
use App\Models\Quotation;
use App\Models\UserQuotation;
use DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\Response;
use App\Mail\QuotationUser;
use App\Mail\QuotationAdmin;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;

class VendorController extends Controller
{



    public function typeAjax(Request $request)
    {
        $type = Type::where('slug', $request->type)->first();
        $vendors = DB::table('vendors')
            ->join('users', 'users.id', '=', 'vendors.user_id')
            ->where('type_id', $type->id)
            ->where('email_verified_at', '!=', null)
            ->paginate(6);
        $view = view('frontend.vendors.types.inner.vendors', compact('vendors'))->render();
        return response()->json(['html' => $view]);
    }

    public function types(Request $request)
    {
        $type_slug = $request->segment(1);
        $type = Type::where('slug', $type_slug)->first();
        $body_class = '';
        $cities = getDataArray('cities');
        $vendors_total = DB::table('vendors')
            ->join('users', 'users.id', '=', 'vendors.user_id')
            ->where('email_verified_at', '!=', null)
            ->where('type_id', $type->id)
            ->get()->count();
        // $vendors_total = Vendor::join('users', 'users.id', '=', 'vendors.user_id')->where('type_id', $type->id)->get()->count();
        //        $vendors_total= count($vendors_total);
        $content = Content::where(array('type_id' => $type->id, 'city_id' => null))->first();
        return view('frontend.vendors.types.listing', compact('content', 'body_class', 'cities', 'type', 'vendors_total'));
    }

    public function cityAjax(Request $request)
    {
        $city = City::where('slug', $request->city)->first();
        $type = Type::where('slug', $request->type)->first();

        $service_ids = [];
        if (isset($_GET['service'])) {
            foreach ($_GET['service'] as $service) {
                $service_id = getData('services', 'name', $service);
                array_push($service_ids, $service_id->id);
            }
        }

        $budget = null;
        if (isset($_GET['budget'])) {
            $budget = getData('budgets', 'id', $_GET['budget']);
        }

        $vendorsDB = DB::table('vendors');
        $vendorsDB->join('users', 'users.id', '=', 'vendors.user_id')
            ->where('email_verified_at', '!=', null)
            ->where(array('type_id' => $type->id, 'city_id' => $city->id));

        if (count($service_ids) > 0) {
            $vendorsDB->join('services', 'vendors.type_id', '=', 'services.type_id');
            $vendorsDB->join('prices', 'prices.service_id', '=', 'services.id');
            $vendorsDB->whereIn('services.id', $service_ids);
        }

        if ($budget) {
            if ($budget->filter == 'less_then') {
                $vendorsDB->where('vendors.price', '<', $budget->min);
            } elseif ($budget->filter == 'between') {
                $vendorsDB->where('vendors.price', '>', $budget->min);
                $vendorsDB->where('vendors.price', '<', $budget->max);
            } elseif ($budget->filter == 'above') {
                $vendorsDB->where('vendors.price', '>', $budget->min);
            }
        }

        if (isset($_GET['sort'])) {
            if ($_GET['sort'] == 'low_to_high') {
                $vendorsDB->orderBy('vendors.price', 'ASC');
            } elseif ($_GET['sort'] == 'high_to_low') {
                $vendorsDB->orderBy('vendors.price', 'DESC');
            }
        }

        //        if(isset($_GET['type'])){
        //            $vendorsDB->where('vendors.type_id', $_GET['type']);
        //        }else{
        //            $vendorsDB->where('vendors.type_id', $type->id);
        //        }
        //
        //        if(isset($_GET['city'])){
        //            $vendorsDB->where('vendors.city_id', $_GET['city']);
        //        }else{
        //            $vendorsDB->where('vendors.city_id', $city->id);
        //        }

        $vendors = $vendorsDB->groupBy('vendors.user_id')->paginate(15);

        $view = view('frontend.vendors.types.inner.vendors', compact('vendors'))->render();
        return response()->json(['html' => $view]);
    }

    public function cities(Request $request, $city_slug)
    {

        Session::put('vendor_city', $city_slug);
        // dd(Session::get('vendor_city'));
        $type_slug = $request->segment(1);
        $body_class = '';
        $city = City::where('slug', $city_slug)->first();
        $type = Type::where('slug', $type_slug)->first();

        //        $service_ids = [];
        //        if(isset($_GET['service'])){
        //            foreach($_GET['service'] as $service){
        //                $service_id = getData('services', 'name', $service);
        //                array_push($service_ids, $service_id->id);
        //            }
        //        }
        //
        //        $budget = null;
        //        if(isset($_GET['budget'])){
        //            $budget = getData('budgets', 'id', $_GET['budget']);
        //        }
        //
        //        $vendorsDB = DB::table('vendors');
        //
        //        if(count($service_ids) > 0){
        //            $vendorsDB->join('services', 'vendors.type_id', '=', 'services.type_id');
        //            $vendorsDB->join('prices', 'prices.service_id', '=', 'services.id');
        //            $vendorsDB->whereIn('services.id', $service_ids);
        //        }
        //
        //        if($budget){
        //            if($budget->filter == 'less_then'){
        //                $vendorsDB->where('vendors.price', '<' , $budget->min);
        //            }elseif($budget->filter == 'between'){
        //                $vendorsDB->where('vendors.price', '>' , $budget->min);
        //                $vendorsDB->where('vendors.price', '<' , $budget->max);
        //            }elseif($budget->filter == 'above'){
        //                $vendorsDB->where('vendors.price', '>' , $budget->min);
        //            }
        //        }
        //
        //        if(isset($_GET['sort'])){
        //            if($_GET['sort'] == 'low_to_high'){
        //                $vendorsDB->orderBy('vendors.price', 'ASC');
        //            }elseif($_GET['sort'] == 'high_to_low'){
        //                $vendorsDB->orderBy('vendors.price', 'DESC');
        //            }
        //        }
        //
        //        if(isset($_GET['type'])){
        //            $vendorsDB->where('vendors.type_id', $_GET['type']);
        //        }else{
        //            $vendorsDB->where('vendors.type_id', $type->id);
        //        }
        //
        //        if(isset($_GET['city'])){
        //            $vendorsDB->where('vendors.city_id', $_GET['city']);
        //        }else{
        //            $vendorsDB->where('vendors.city_id', $city->id);
        //        }
        //
        //        $vendors = $vendorsDB->groupBy('vendors.user_id')->paginate(15);

        $content = Content::where(array('type_id' => $type->id, 'city_id' => $city->id))->first();
        $vendors_total = DB::table('vendors')
            ->join('users', 'users.id', '=', 'vendors.user_id')
            ->where('email_verified_at', '!=', null)
            ->where(array('type_id' => $type->id, 'city_id' => $city->id))->get()->count();
        return view('frontend.vendors.types.cities.listing', compact('content', 'body_class', 'city', 'type', 'vendors_total'));
    }


    public function details(Request $request, $city_slug, $vendor_slug)
    {
        $type_slug = $request->segment(1);
        $body_class = '';
        $city = City::where('slug', $city_slug)->first();
        $type = Type::where('slug', $type_slug)->first();



        $vendor_details = DB::table('vendors')->where('type_id', $type->id)->where('city_id', $city->id)->where('slug', $vendor_slug)->first();
        return view('frontend.vendors.details', compact('body_class', 'vendor_details', 'city', 'type'));
    }

    public function postReview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'rating' => 'required|not_in:0',
            'description' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        if ($validator->passes()) {
            $data = $request->all();
            $vendor = new VendorReview();

            $vendor->user_id = $data['doctor_id'];
            $vendor->rating = $data['rating'];
            $vendor->description = $data['description'];
            $vendor->title = $data['name'];
            $vendor->phone = $data['phone'];
            $vendor->email = $data['email'];
            $vendor->created_at = date("Y-m-d", time());
            $vendor->save();
            return response()->json(['success' => true, 'message' => 'Review posted successfully!']);
        }
        $var_err = "";
        $var_err .= "<ul style='list-style:none;padding:0'>";
        foreach ($validator->errors()->all() as $error) {
            $var_err .=  "<li>"   . $error . "</li>";
        }
        $var_err .= "</ul>";

        return response()->json(['success' => false, 'message' => $var_err]);
    }

    public function postReply(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'your_reply' => 'required',
            'name' => 'required',
        ]);

        $html = "";
        if ($validator->passes()) {
            $data = $request->all();
            $vendor = new VendorReviewReply();

            $vendor->description = $data['your_reply'];
            $vendor->name = $data['name'];
            $vendor->review_id = $data['review_id'];
            $vendor->save();

            // Ajax code
            $replyData = DB::table('vendor_reviews_reply')->select('*')->where("review_id", $request->review_id)->orderBy("id", 'desc')->get();

            if ($replyData) {
                foreach ($replyData as $item) {
                    $html .= '<div class="admin-reply">';
                    $html .= '<div class="col-xs-12 reply-review-cls">';
                    $html .= '<div class="review-header">';
                    $html .= '<ul class="list-inline space-list">';
                    $html .= '<li>';
                    $html .= '<div class="rev-flex-cls">';
                    $html .= '<div class="img-col">';

                    $user_profile_img = asset('img/default-avatar.jpg');

                    if ($item->name == "Super Admin") {
                        $user_profile_img = asset('img/default-avatar.jpg');
                    } else {
                        if ($data['avatar']) {
                            if (file_exists(public_path() . '/storage/user/profile/' . $data['avatar'])) {
                                $user_profile_img = asset('storage/user/profile/' . $data['avatar']);
                            }
                        }
                    }

                    $html .= '<img src="' . $user_profile_img . '" class="img-fluid" alt="alt img">';
                    $html .= '</div>';

                    $html .= '<div class="text-col">';
                    $html .= '<p class="name review-title">' .  $item->name . '</p>';
                    $html .= '<ul class="list-inline rating-list">';
                    $html .= '<li class="list-inline-item">';
                    $html .= '<ul class="list-inline">';
                    $html .= '<li class="list-inline-item review-listing">';
                    $html .= date('d', strtotime($item->created_at)) . " , " . date("F", strtotime($item->created_at)) . " , " . date('Y', strtotime($item->created_at));
                    $html .= '</li>';
                    $html .= '</ul>';
                    $html .= '</li>';
                    $html .= '</ul>';

                    $html .= '</div>';

                    $html .= '</div>';
                    $html .= '</li>';
                    $html .= '</ul>';
                    $html .= '</div>';
                    $html .= '<div class="review-body">';
                    $html .=  $item->description;
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                }
            }

            // Ajax code

            return response()->json(['success' => true, 'message' => 'Reply posted successfully!', 'reply_html' => $html, 'review_id' => $data['review_id']]);
        }

        $var_err = "";
        $var_err .= "<ul style='list-style:none;padding:0'>";
        foreach ($validator->errors()->all() as $error) {
            $var_err .=  "<li>"   . $error . "</li>";
        }
        $var_err .= "</ul>";

        return response()->json(['success' => false, 'message' => $var_err, 'reply_html' => $html, 'review_id' => $request->review_id]);
    }


    public function callView(Request $request)
    {
        $data = $request->all();

        if ($data['user_id'] != '' && $data['vendor_id'] != '') {
            $callChat = getData('call_chat', array('user_id' => $data['user_id'], 'vendor_id' => $data['vendor_id']));
            if ($callChat == '') {
                $vendor = new CallChat();
                $vendor->user_id = $data['user_id'];
                $vendor->vendor_id = $data['vendor_id'];
                $vendor->view = 1;
                $vendor->save();
                return response()->json(['success' => true, 'message' => 'successfully!']);
            }
        }

        return response()->json(['success' => true, 'message' => 'Already Viewed']);
    }


    public function callReview(Request $request)
    {
        $data = $request->all();
        if ($data['user_id'] != '' && $data['vendor_id'] != '') {
            $callChat = CallChat::where(array('user_id' => $data['user_id'], 'vendor_id' => $data['vendor_id']))->first();
            if ($callChat != '') {
                $callChat->review = $data['review'];
                $callChat->save();
                return response()->json(['success' => true, 'message' => 'Successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Already Reviewed']);
    }

    public function saveQuotation($vendor_slug)
    {

        // $vendor_id = base64_decode($vendor_id);
        $body_class = '';
        $vendor = DB::table('vendors')->where('slug', $vendor_slug)->first();


        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user_id = Auth::user()->id;
        $user_quotation = UserQuotation::where('type_id', $vendor->type_id)->where('user_id', $user_id)->first();

        $vendor_details = $vendor;
        $top_services  = DB::table('services')
            ->join('prices', 'services.id', '=', 'prices.service_id')
            ->select('services.*', 'prices.input_type_value', 'prices.description')
            ->where('prices.vendor_id', $vendor->id)
            ->where('services.positions', 'top')
            ->where('services.input_type', 'price')
            ->get();
        return view('frontend.vendors.quotation', compact('user_quotation', 'vendor_details', 'top_services'));
    }

    public function storeQuotation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email:rfc',
            'phone' => 'required',
            'city' => 'required',
        ]);
        if ($validator->passes()) {
            $data = $request->all();
            $services = [];
            if (isset($data['service'])) {
                foreach ($data['service'] as $service) {
                    if (!isset($service['service_val'])) {
                        $tmp = [];
                        $tmp['service_id'] = $service['service_id'];
                        $tmp['quantity'] = $service['quantity'];
                        array_push($services, $tmp);
                    }
                }
            }

            $vendor = Vendor::where('id',  $data['vendor_id'])->first();
            $vendor_user = User::where('id', $vendor->user_id)->first();
            $city = City::where('id', $vendor->city_id)->first();
            $type = Type::where('id', $vendor->type_id)->first();

            $data['dates'] =  date('Y-m-d');


            $quotation = Quotation::where('vendor_id', $data['vendor_id'])->where('user_id', Auth::user()->id)->first();
            if ($quotation == '') {
                $quotation = new Quotation();
            }
            $quotation->vendor_id = $data['vendor_id'];
            $quotation->user_id = Auth::user()->id;
            $quotation->city_id = $data['city'];
            $quotation->name = $data['name'];
            $quotation->email = $data['email'];
            $quotation->phone = $data['phone'];
            $quotation->budget = $data['budget'];
            $quotation->dates = $data['dates'];
            $quotation->service_json = json_encode($services);
            $quotation->save();

            $vendor_url = url('/') . '/' . $type->slug . '/' . $city->slug . '/' . $vendor->slug;
            $vendor_data =  array('vendor_business_name' => $vendor->business_name,            'vendor_url' => $vendor_url);

            $quotation->vendor_data = array('vendor_business_name' => $vendor->business_name,            'vendor_url' => $vendor_url, 'city' => $city->name);

            // Mail::to($vendor->email)->send(new QuotationUser($quotation));
            // Mail::to(env('MAIL_FROM_ADDRESS'))->send(new QuotationUser($quotation));
            // Mail::to($vendor_user->email)->send(new QuotationAdmin($quotation));

            return response()->json(['success' => true, 'message' => 'Quotation requested successfully!']);
        }

        $err_html = "";
        $err_html .= "<ul class='padding-null list-style-none'>";
        foreach ($validator->errors()->all() as $er) {
            $err_html .= "<li>$er</li>";
        }
        $err_html .= "</ul>";

        return response()->json(['success' => false, 'message' => $err_html]);
    }

    public function saveQuotationType($type_alias)
    {
        $type = DB::table('types')->where('slug', $type_alias)->first();
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user_id = Auth::user()->id;
        $user_quotation = UserQuotation::where('type_id', $type->id)->where('user_id', $user_id)->first();
        $top_services  = DB::table('services')
            ->select('services.*')
            ->where('services.type_id', $type->id)
            ->where('services.positions', 'top')
            ->where('services.input_type', 'price')
            ->get();
        return view('frontend.vendors.type', compact('user_quotation', 'type', 'top_services'));
    }

    public function storeQuotationType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
        ]);
        if ($validator->passes()) {
            $data = $request->all();
            $services = [];
            if (isset($data['service'])) {
                foreach ($data['service'] as $service) {
                    if (!isset($service['service_val'])) {
                        $tmp = [];
                        $tmp['service_id'] = $service['service_id'];
                        $tmp['quantity'] = $service['quantity'];
                        array_push($services, $tmp);
                    }
                }
            }

            $quotation = UserQuotation::where('type_id', $data['type_id'])->where('user_id', Auth::user()->id)->first();
            if ($quotation == '') {
                $quotation = new    UserQuotation();
            }
            $dates = '';
            if (isset($data['start_date']) && isset($data['end_date'])) {
                $dates =  $data['start_date'] . ' - ' . $data['end_date'];
            }
            $quotation->user_id = Auth::user()->id;
            $quotation->type_id = $data['type_id'];
            $quotation->city_id = $data['city'];
            $quotation->name = $data['name'];
            $quotation->email = $data['email'];
            $quotation->phone = $data['phone'];
            $quotation->budget = $data['budget'];
            $quotation->dates = $dates;
            $quotation->service_json = json_encode($services);
            $quotation->save();

            // $vendor_url = url('/').'/'.$type->slug.'/'.$city->slug.'/'.$vendor->slug;
            // $vendor_data =  array( 'vendor_business_name' => $vendor->business_name,            'vendor_url' => $vendor_url );

            // $quotation->vendor_data = array( 'vendor_business_name' => $vendor->business_name,            'vendor_url' => $vendor_url , 'city' => $city->name);

            // Mail::to($vendor->email)->send(new QuotationUser($quotation));
            // Mail::to(env('MAIL_FROM_ADDRESS'))->send(new QuotationUser($quotation));
            // Mail::to($vendor_user->email)->send(new QuotationAdmin($quotation));

            return response()->json(['success' => true, 'message' => 'Quotation requested successfully!']);
        }

        $errArry = [];
        foreach ($validator->errors()->all() as $error) {
            $errArry[] =  '<li>' . $error . '</li>';
        }

        return response()->json(['success' => false, 'message' => $errArry]);
    }

    public function vendorSearch()
    {
        $types = Type::All()->toArray();
        $type_vendors = array();
        foreach ($types as $type) {
            $vendors = Vendor::where('type_id',  $type['id'])->limit(8)->get()->toArray();
            if ($vendors) {
                $type_vendors[$type['id']] = $vendors;
            }
        }


        return view('frontend.vendors.search-vendor', compact('types', 'type_vendors'));
    }

    public function citySearch()
    {
        $cities = City::All()->toArray();
        $city_vendors = array();
        foreach ($cities as $city) {
            $types = Type::All()->toArray();
            foreach ($types as $type) {
                $vendor = Vendor::where('city_id',  $city['id'])->where('type_id',  $type['id'])->first();
                if ($vendor) {
                    $city_vendors[$city['id']][$type['id']] = $vendor;
                }
            }
        }
        return view('frontend.vendors.search-city', compact('cities', 'city_vendors'));
    }
}
