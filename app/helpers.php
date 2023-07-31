<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth as Auth;

function getData($table, $column = null, $value = null)
{
    $data = DB::table($table);
    if ($column != null) {
        if (is_array($column)) :
            $data->where($column);
        else :
            $data->where(array($column => $value));
        endif;
    }
    return $data->first();
}


function getDataArray($table, $column = null, $value = null)
{
    $data = DB::table($table);
    if ($column != null) {
        if (is_array($column)) :
            $data->where($column);
        else :
            $data->where(array($column => $value));
        endif;
    }
    if ($table == "vendor_reviews") {
        $data->where(array('is_active' => 1));
    }
    return $data->get();
}

function getDataCustom($table, $column = null, $custom = null, $results = null)
{
    $data = DB::table($table);
    if ($column != null) :
        $data->where($column);
    endif;
    if ($custom != null && is_array($custom) == true) :
        if (isset($custom['sort'])) :
            $data->orderBy($custom['sort']);
        endif;
        if (isset($custom['offset'])) :
            $data->offset($custom['offset']);
        endif;
        if (isset($custom['limit'])) :
            $data->limit($custom['limit']);
        endif;
    endif;
    $data = $data->get();
    if (!$data->isEmpty()) :
        return ($results) ? $data->all() : $data->first();
    endif;
    return false;
}

function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);

        foreach ($objects as $object) {
            if ($object != '.' && $object != '..') {
                if (filetype($dir . '/' . $object) == 'dir') {
                    rrmdir($dir . '/' . $object);
                } else {
                    unlink($dir . '/' . $object);
                }
            }
        }

        reset($objects);
        rmdir($dir);
    }
}

function setData($table, $column = null, $where = null)
{
    $data = DB::table($table);
    if ($where != null) :
        $data->where($where);
        $data->update($column);
    else :
        $data->insert($column);
    endif;
}

function getLatestBlogs()
{
    $data = DB::table('posts')->take(5)->orderBy('id', 'desc');
    return $data->get();
}


function custom_array_coloum($array, $key, $value, $default = '')
{
    $array = $array->toArray();
    if ($default) : @array_unshift($array, array($key => '', $value => $default));
    endif;
    return @array_combine(array_column($array, $key), array_column($array, $value));
}

function fileUpload(Request $request, $key, $folder, $realName = true)
{
    if ($request->has($key)) {
        $image = $request->file($key);
        if ($realName) {
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
        }
        if ($request->{$key}->move(storage_path('app/public/' . $folder), $imageName)) {
            return $imageName;
        }
    }
    return false;
}

function multiFileUpload($file, $folder, $realName = true)
{
    if ($file) {
        if ($realName) {
            $imageName = $file->getClientOriginalName();
        } else {
            $imageName = time() . '.' . $file->getClientOriginalExtension();
        }
        if ($file->move(storage_path('app/public/' . $folder), $imageName)) {
            return $imageName;
        }
    }
    return false;
}

function get_vendor_services($vendor_id, $position = '')
{
    $data = DB::table('services')
        ->join('prices', 'services.id', '=', 'prices.service_id')
        ->select('services.*', 'prices.input_type_value', 'prices.description')
        ->where('prices.vendor_id', $vendor_id)
        ->where('services.positions', $position)
        ->get();
    return $data;
}

function get_vendor_selected_services($vendor_id, $position = '', $service_id)
{
    $data = DB::table('services')
        ->join('prices', 'services.id', '=', 'prices.service_id')
        ->select('services.*', 'prices.input_type_value', 'prices.description')
        ->where('prices.vendor_id', $vendor_id)
        ->where('services.positions', $position)
        ->where('services.id', $service_id)
        ->first();
    return $data;
}

function get_featured_vendors()
{
    $data = DB::table('vendors')
        ->where('vendors.is_featured', 1)
        ->limit(6)
        ->get();
    return $data;
}

function get_similar_vendors($type_id)
{
    $data = DB::table('vendors')
        ->where('vendors.type_id', $type_id)
        ->limit(9)
        ->get();
    return $data;
}

function getTotalVendorUserMenu($type_id)
{
    $user_id = Auth::id();
    $data = DB::table('vendor_quotation')
        ->join('vendors', 'vendors.id', '=', 'vendor_quotation.vendor_id')
        ->where('vendors.type_id', $type_id)
        ->where('vendor_quotation.user_id', $user_id)
        ->get();

    if (count($data) > 0) {
        return count($data);
    }

    return false;
}

function averageReview($reviews, $default = 0)
{
    $average = $default;
    if (!$reviews->isEmpty()) {
        $avg = array_column($reviews->toArray(), 'rating');
        $a = array_filter($avg);
        $average = round(array_sum($a) / count($a));
    }
    return $average;
}

/*
 * Global helpers file with misc functions.
 */
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

/*
 * Global helpers file with misc functions.
 */
if (!function_exists('user_registration')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function user_registration()
    {
        $user_registration = false;

        if (env('USER_REGISTRATION') == 'true') {
            $user_registration = true;
        }

        return $user_registration;
    }
}

/*
 *
 * label_case
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('label_case')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function label_case($text)
    {
        $order = ['_', '-'];
        $replace = ' ';

        $new_text = trim(\Illuminate\Support\Str::title(str_replace('"', '', $text)));
        $new_text = trim(\Illuminate\Support\Str::title(str_replace($order, $replace, $text)));
        $new_text = preg_replace('!\s+!', ' ', $new_text);

        return $new_text;
    }
}

/*
 *
 * show_column_value
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('show_column_value')) {
    /**
     * Return Column values as Raw and formatted.
     *
     * @param string $valueObject Model Object
     * @param string $column Column Name
     * @param string $return_format Return Type
     *
     * @return string Raw/Formatted Column Value
     */
    function show_column_value($valueObject, $column, $return_format = '')
    {
        $column_name = $column->Field;
        $column_type = $column->Type;

        $value = $valueObject->$column_name;

        if ($return_format == 'raw') {
            return $value;
        }

        if (($column_type == 'date') && $value != '') {
            $datetime = \Carbon\Carbon::parse($value);

            return $datetime->isoFormat('LL');
        } elseif (($column_type == 'datetime' || $column_type == 'timestamp') && $value != '') {
            $datetime = \Carbon\Carbon::parse($value);

            return $datetime->isoFormat('LLLL');
        } elseif ($column_type == 'json') {
            $return_text = json_encode($value);
        } elseif ($column_type != 'json' && \Illuminate\Support\Str::endsWith(strtolower($value), ['png', 'jpg', 'jpeg', 'gif', 'svg'])) {
            $img_path = asset($value);

            $return_text = '<figure class="figure">
                                <a href="' . $img_path . '" data-lightbox="image-set" data-title="Path: ' . $value . '">
                                    <img src="' . $img_path . '" style="max-width:200px;" class="figure-img img-fluid rounded img-thumbnail" alt="">
                                </a>
                                <figcaption class="figure-caption">Path: ' . $value . '</figcaption>
                            </figure>';
        } else {
            $return_text = $value;
        }

        return $return_text;
    }
}

/*
 *
 * fielf_required
 * Show a * if field is required
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('fielf_required')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function fielf_required($required)
    {
        $return_text = '';

        if ($required != '') {
            $return_text = '<span class="text-danger">*</span>';
        }

        return $return_text;
    }
}

/*
 * Get or Set the Settings Values
 *
 * @var [type]
 */
if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        if (is_null($key)) {
            return new App\Models\Setting();
        }

        if (is_array($key)) {
            return App\Models\Setting::set($key[0], $key[1]);
        }

        $value = App\Models\Setting::get($key);

        return is_null($value) ? value($default) : $value;
    }
}

/*
 * Show Human readable file size
 *
 * @var [type]
 */
if (!function_exists('humanFilesize')) {
    function humanFilesize($size, $precision = 2)
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision) . $units[$i];
    }
}

/*
 *
 * Encode Id to a Hashids\Hashids
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('encode_id')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function encode_id($id)
    {
        $hashids = new Hashids\Hashids(config('app.salt'), 3, 'abcdefghijklmnopqrstuvwxyz1234567890');
        $hashid = $hashids->encode($id);

        return $hashid;
    }
}

/*
 *
 * Decode Id to a Hashids\Hashids
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('decode_id')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function decode_id($hashid)
    {
        $hashids = new Hashids\Hashids(config('app.salt'), 3, 'abcdefghijklmnopqrstuvwxyz1234567890');
        $id = $hashids->decode($hashid);

        if (count($id)) {
            return $id[0];
        } else {
            abort(404);
        }
    }
}

/*
 *
 * Prepare a Slug for a given string
 * Laravel default str_slug does not work for Unicode
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('slug_format')) {

    /**
     * Format a string to Slug.
     */
    function slug_format($string)
    {
        $base_string = $string;

        $string = preg_replace('/\s+/u', '-', trim($string));
        $string = str_replace('/', '-', $string);
        $string = str_replace('\\', '-', $string);
        $string = strtolower($string);

        $slug_string = $string;

        return $slug_string;
    }
}

/*
 *
 * icon
 * A short and easy way to show icon fornts
 * Default value will be check icon from FontAwesome
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('icon')) {

    /**
     * Format a string to Slug.
     */
    function icon($string = 'fas fa-check')
    {
        $return_string = "<i class='" . $string . "'></i>";

        return $return_string;
    }
}

/*
 *
 * logUserAccess
 * Get current user's `name` and `id` and
 * log as debug data. Additional text can be added too.
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('logUserAccess')) {

    /**
     * Format a string to Slug.
     */
    function logUserAccess($text = '')
    {
        $auth_text = '';

        if (\Auth::check()) {
            $auth_text = 'User:' . \Auth::user()->name . ' (ID:' . \Auth::user()->id . ')';
        }

        \Log::debug(label_case($text) . " | $auth_text");
    }
}

/*
 *
 * bn2enNumber
 * Convert a Bengali number to English
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('bn2enNumber')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function bn2enNumber($number)
    {
        $search_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $replace_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        $en_number = str_replace($search_array, $replace_array, $number);

        return $en_number;
    }
}

/*
 *
 * bn2enNumber
 * Convert a English number to Bengali
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('en2bnNumber')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function en2bnNumber($number)
    {
        $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];

        $bn_number = str_replace($search_array, $replace_array, $number);

        return $bn_number;
    }
}

/*
 *
 * bn2enNumber
 * Convert a English number to Bengali
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('en2bnDate')) {

    /**
     * Convert a English number to Bengali.
     */
    function en2bnDate($date)
    {
        // Convert numbers
        $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $bn_date = str_replace($search_array, $replace_array, $date);

        // Convert Short Week Day Names
        $search_array = ['Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu'];
        $replace_array = ['শুক্র', 'শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        // Convert Month Names
        $search_array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $replace_array = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগষ্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        // Convert Short Month Names
        $search_array = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $replace_array = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগষ্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        // Convert AM-PM
        $search_array = ['am', 'pm', 'AM', 'PM'];
        $replace_array = ['পূর্বাহ্ন', 'অপরাহ্ন', 'পূর্বাহ্ন', 'অপরাহ্ন'];
        $bn_date = str_replace($search_array, $replace_array, $bn_date);

        return $bn_date;
    }
}

/*
 *
 * banglaDate
 * Get the Date of Bengali Calendar from the Gregorian Calendar
 * By default is will return the Today's Date
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('banglaDate')) {
    function banglaDate($date_input = '')
    {
        if ($date_input == '') {
            $date_input = date('Y-m-d');
        }

        $date_input = strtotime($date_input);

        $en_day = date('d', $date_input);
        $en_month = date('m', $date_input);
        $en_year = date('Y', $date_input);

        $bn_month_days = [30, 30, 30, 30, 31, 31, 31, 31, 31, 31, 29, 30];
        $bn_month_middate = [13, 12, 14, 13, 14, 14, 15, 15, 15, 16, 14, 14];
        $bn_months = ['পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র', 'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন', 'কার্তিক', 'অগ্রহায়ণ'];

        // Day & Month
        if ($en_day <= $bn_month_middate[$en_month - 1]) {
            $bn_day = $en_day + $bn_month_days[$en_month - 1] - $bn_month_middate[$en_month - 1];
            $bn_month = $bn_months[$en_month - 1];

            // Leap Year
            if (($en_year % 400 == 0 || ($en_year % 100 != 0 && $en_year % 4 == 0)) && $en_month == 3) {
                $bn_day += 1;
            }
        } else {
            $bn_day = $en_day - $bn_month_middate[$en_month - 1];
            $bn_month = $bn_months[$en_month % 12];
        }

        // Year
        $bn_year = $en_year - 593;
        if (($en_year < 4) || (($en_year == 4) && (($en_date < 14) || ($en_date == 14)))) {
            $bn_year -= 1;
        }

        $return_bn_date = $bn_day . ' ' . $bn_month . ' ' . $bn_year;
        $return_bn_date = en2bnNumber($return_bn_date);

        return $return_bn_date;
    }
}

/*
 *
 * Decode Id to a Hashids\Hashids
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('generate_rgb_code')) {

    /**
     * Prepare the Column Name for Lables.
     */
    function generate_rgb_code($opacity = '0.9')
    {
        $str = '';
        for ($i = 1; $i <= 3; $i++) {
            $num = mt_rand(0, 255);
            $str .= "$num,";
        }
        $str .= "$opacity,";
        $str = substr($str, 0, -1);

        return $str;
    }
}

/*
 *
 * Return Date with weekday
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('date_today')) {

    /**
     * Return Date with weekday.
     *
     * Carbon Locale will be considered here
     * Example:
     * শুক্রবার, ২৪ জুলাই ২০২০
     * Friday, July 24, 2020
     */
    function date_today()
    {
        $str = \Carbon\Carbon::now()->isoFormat('dddd, LL');

        return $str;
    }

    function dynamic_menu($table, $column, $slug)
    {
        $data = DB::table($table);
        if ($column != null) {
            if (is_array($column)) :
                $data->where($column);
            else :
                $data->where(array($column => $slug));
            endif;
        }
        $item = $data->first();
        if ($item) {
            return DB::table('menuitem')->select('*')
                ->where('menu_id', $item->menu_id)
                ->where('parent_id', 0)
                ->orderBy('sort', 'ASC')
                ->get();
        } else {
            return [];
        }
    }

    function dynamicMenuChildItem($menuId)
    {
        $data = DB::table('menuitem')
            ->where('parent_id', $menuId)
            ->select('*')
            ->limit('10')
            ->get()->toArray();
        $array = json_decode(json_encode($data), true);

        if ($array) {
            return $array;
        } else {
            return [];
        }
    }

    function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }


    function getServiceByType($table, $column = null, $value = null, $type_id)
    {
        $data = DB::table($table);
        if ($column != null) {
            if (is_array($column)) :
                $data->where($column);
            else :
                $data->where(array($column => $value));
            endif;
            $data->where('type_id', $type_id);
        }
        return $data->get();
    }

    function getVendorById($vendor_id)
    {
        $data = DB::table('vendors');
        $data->select('business_name');
        $data->where('id', $vendor_id);
        $rs = $data->first();
        return $rs->business_name;
    }

    function getReviewArray($table, $column = null, $value = null)
    {
        $data = DB::table($table);
        if ($column != null) {
            if (is_array($column)) :
                $data->where($column);
            else :
                $data->where(array($column => $value));
            endif;
            $data->where(array("is_active" => 1));
            $data->orderBy("id", 'desc');
        }
        return $data->get();
    }

    function getContent($vendor)
    {
        $data = DB::table('contents');
        $data->select('description', 'content');
        $data->where('type_id', $vendor->type_id);
        $data->where('city_id', $vendor->city_id);
        $rs = $data->first();
        if ($rs) {
            return $rs->description;
        } else {
            return "";
        }
    }

    function getMenuItems($menu_id)
    {
        $data = DB::table('menuitem');
        $data->select('id', 'title', 'url', 'parent_id');
        $data->where('menu_id', $menu_id);
        $data->where('parent_id', 0);
        return $data->get();
    }

    function getParentItem($parent_id)
    {
        if ($parent_id == 0) {
            return [];
        };

        $data = DB::table('menuitem');
        $data->select('id', 'title');
        $data->where('id', $parent_id);
        return $data->first();
    }

    function isParent($itemId)
    {
        if ($itemId == 0) {
            return [];
        }
        $data = DB::table('menuitem');
        $data->select('id', 'title', 'parent_id');
        $data->where('parent_id', $itemId);
        $rr = $data->get()->toArray();
        $array = json_decode(json_encode($rr), true);
        return $array;
    }

    function getSelectedTagVal($tags)
    {
        if (!$tags) {
            return;
        }

        $data = DB::table('tags');
        $data->select('id', 'name', 'slug');
        $data->whereIn('id', $tags);
        $rr = $data->get()->toArray();
        $array = json_decode(json_encode($rr), true);
        return $array;
    }

    function getSelectedCityVal($cities)
    {
        if (!$cities) {
            return;
        }

        $data = DB::table('cities');
        $data->select('id', 'name', 'slug');
        $data->whereIn('id', $cities);
        $rr = $data->get()->toArray();
        $array = json_decode(json_encode($rr), true);
        return $array;
    }

    function getPostsByTag($tagId)
    {
        $data = DB::table('posts')
            ->select('*')
            ->whereJsonContains('tag_ids', ["$tagId"])
            ->paginate(6);
        return $data;
    }

    function getPostCat($catIds)
    {
        if (!$catIds) {
            return [];
        }

        $data = DB::table('categories');
        $data->select('id', 'name', 'slug', 'image', 'alt');
        $data->whereIn('id', $catIds);
        $rr = $data->get()->toArray();
        $array = json_decode(json_encode($rr), true);
        return $array;
    }

    function getNextPost($id)
    {
        $nextUser = DB::table('posts')->where('id', '>', $id)->select('id', 'slug')->orderby('id', 'asc')->first();
        return $nextUser;
    }

    function getPrevPost($id)
    {
        $previousUser = DB::table('posts')->where('id', '<', $id)->select('id', 'slug')->orderby('id', 'desc')->first();
        return $previousUser;
    }

    function getIdBySlug($slug)
    {
        $data = DB::table('vendors');
        $data->select('id');
        $data->where('slug', $slug);
        return $data->first();
    }

    function getBlogsByVendor($type_id)
    {
        $data = DB::table('posts')->where('vendor_type', $type_id)->take(5)->orderBy('id', 'desc');
        return $data->get();
    }

    function getBlogViaSlug($lastUri)
    {
        $data = DB::table('posts')->select('featured_image', 'content')->where('slug', $lastUri);
        return $data->get()->first();
    }

    function getVendorTypes($cityId)
    {
        $data = DB::table('vendors')->select('business_name', 'slug', 'type_id')->where("city_id", $cityId);
        $vendors = $data->get();
        $vendors =  json_decode($vendors, true);
        if ($vendors) {
            $vendors = array_column($vendors, 'type_id');
            $vendors = array_unique($vendors);

            $data = DB::table('types')->select('name', 'slug')->whereIn("id", $vendors);
            $vendors_return = $data->get();
            return $vendors_return;
        }
    }

    function getReviewReply($reviewId)
    {
        $data = DB::table('vendor_reviews_reply')->select('name', 'description', 'review_id', 'created_at')->where("review_id", $reviewId)->orderBy("id", 'desc');
        $replies = $data->get();
        return $replies;
    }

    function getUserAvatar($user_id)
    {
        $data = DB::table('users')->select('avatar')->where("id", $user_id)->get()->first();
        return $data;
    }

    function getUserProvider($user_id)
    {
        $data = DB::table('user_providers')->select('provider')->where("user_id", $user_id)->get()->first();
        return $data;
    }


    function getAllCities()
    {
        $getAllCities = DB::table('cities')->select('name', 'slug', 'id')->get()->toArray();

        $array = json_decode(json_encode($getAllCities), true);

        $city_options = [];
        if ($array) {
            foreach ($array as $item) {
                $city_options[$item['id']] = $item['name'];
            }
        }
        return $city_options;
    }

    function getCityById($cityId)
    {
        return DB::table('cities')->select('name', 'slug', 'id')->where('id', $cityId)->get()->first();
    }

    function getCitiesById($jsonData, $dataType)
    {
        $html = "";
        $array = json_decode($jsonData, true);

        $data = DB::table('cities')->select('name')->whereIn('id', $array)->get()->toArray();
        if ($data) {
            $numItems = count($data);

            if ($dataType == "html") {

                $i = 0;
                foreach ($data as $item) {
                    if (++$i === $numItems) {
                        $delimiter = "";
                    } else {
                        $delimiter = ",";
                    }
                    $html .= "<a target='_blank' href='" . url('/') . "/" . strtolower($item->name) . "'>" . $item->name . "</a>" . $delimiter;
                }
            } elseif ($dataType == "pipe") {
                $i = 0;
                foreach ($data as $item) {
                    if (++$i === $numItems) {
                        $delimiter = "";
                    } else {
                        $delimiter = " | ";
                    }
                    $html .= "<a target='_blank' href='" . url('/') . "/" . strtolower($item->name) . "'>" . $item->name . "</a>" . $delimiter;
                }
            } else {
                $array_column = array_column($data, "name");
                $html = implode(",", $array_column);
            }
        }

        return $html;
    }

    function generate_multiple_pages($data)
    {
        // dd($data);

        $getCityName = getCityById($data['city']);
        $getCityName = $getCityName->name;

        $citiesArray = array(
            "$getCityName",
            "rhinoplasty-$getCityName",
            "blepharoplasty-$getCityName",
            "facelift-$getCityName",
            "brow-lift-$getCityName",
            "neck-lift-$getCityName",
            "chin-surgery-$getCityName",
            "cheek-augmentation-$getCityName",
            "lip-augmentation-$getCityName",
            "buccal-fat-removal-$getCityName",
            "ear-surgery-$getCityName",
            "breast-augmentation-$getCityName",
            "breast-lift-$getCityName",
            "breast-reduction-$getCityName",
            "breast-implant-removal-$getCityName",
            "breast-implant-revision-$getCityName",
            "gynecomastia-$getCityName",
            "liposuction-$getCityName",
            "tummy-tuck-$getCityName",
            "buttock-enhancement-$getCityName",
            "body-lift-$getCityName",
            "arm-lift-$getCityName",
            "thigh-lift-$getCityName",
            "body-contouring-$getCityName",
            "mommy-makeover-$getCityName",
            "hair-transplant-$getCityName",
            "men-and-plastic-surgery-$getCityName",
        );

        $target = [];
        foreach ($citiesArray as $key => $item) {
            $target[$key] = [
                '_token' => $data['_token'],
                'name' => ucwords(str_replace("-", " ", $item)),
                'slug' => $item,
                'content' => $data['content'],
                'created_by_name' => $data['created_by_name'],
                'status' => 1,
            ];
        }

        return $target;
    }



    function contains_str($str, array $arr)
    {
        foreach ($arr as $a) {
            if (stripos($str, $a) !== false) return true;
        }
        return false;
    }

    function citiesArr()
    {
        $all_cities = DB::table('cities')->select('slug')->get()->toArray();
        if ($all_cities) {
            return array_column($all_cities, 'slug');
        } else {
            return [];
        }
    }

    function citiesSurgeriesArr($menu_alias)
    {
        $array = [];
        $menu_id = DB::table('menutype')->where('url', $menu_alias)->select('menu_id')->get()->first();
        if ($menu_id) {
            $menu_items = DB::table('menuitem')->where('menu_id', $menu_id->menu_id)->select('*')->get()->toArray();
            if ($menu_items) {
                $array = array_column($menu_items, 'url');
            }
        }

        return $array;
    }


    function getAssignedDoctors($city)
    {
        $cityId = DB::table('cities')->select('id')->where('name', $city)->get()->first();
        if ($cityId) {
            $jsonId = "$cityId->id";
            $doctors = DB::table('users')->select('*')->whereJsonContains('city', $jsonId)->get();
            return $doctors;
        } else {
            return collect([]);
        }
    }

    function popular_cities_surgeries($uri, $skip, $take)
    {
        if ($uri == "popular-surgeries") {
            $menu_id = DB::table('menutype')->where('url', $uri)->select('menu_id')->get()->first();
            if ($menu_id) {
                return DB::table('menuitem')->where('menu_id', $menu_id->menu_id)->select('*')->skip($skip)->take($take)->get();
            } else {
                return collect([]);
            }
        } else if ($uri == "cities") {
            return DB::table($uri)->select('*')->skip($skip)->take($take)->get();
        } else {
            $menu_id = DB::table('menutype')->where('url', "popular-surgeries")->select('menu_id')->get()->first();
            if ($menu_id) {
                return DB::table('menuitem')->where('menu_id', $menu_id->menu_id)->select('*')->get();
            } else {
                return collect([]);
            }
        }
    }

    function popular_surgeries_arr($uri)
    {
        $menu_id = DB::table('menutype')->where('url', $uri)->select('menu_id')->get()->first();
        if ($menu_id) {
            $menu_items = DB::table('menuitem')->where('menu_id', $menu_id->menu_id)->select('*')->get()->toArray();
            $array = json_decode(json_encode($menu_items), true);
            if ($array) {
                return array_column($array, 'url');
            }
        }

        return Null;
    }

    function get_userprofiles($user_id)
    {
        return DB::table('userprofiles')->where('user_id', $user_id)->select('*')->get()->first();
    }

    function getResultImgs($user_id)
    {
        return DB::table('images')->where('album_id', $user_id)->get();
    }


    function get_tab_images($cat)
    {
        return DB::table('images')->where('album_id', $cat->id)->get();
    }

    function get_doctor($album_id)
    {
        $data = DB::table('albums')->where('id', $album_id)->get()->first();
        $doctor = NULL;
        if ($data) {
            $doctor = DB::table('users')->where('id', $data->vendor_id)->get()->first();
        }

        return $doctor;
    }

    function getCommentById($id)
    {
        $data = DB::table('comments')->where('id', $id)->get()->first();
        if ($data == NULL) {
            return "";
        } else {
            return $data->name;
        }
    }

    function browser_title($slug, $table, $column_index)
    {
        $data = DB::table($table)->where($column_index, $slug)->get()->first();
        if ($data) {
            return $data->meta_title;
        } else {
            return "";
        }
    }
}
