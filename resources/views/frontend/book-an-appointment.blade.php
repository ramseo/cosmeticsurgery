@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->meta_title}} @endsection

@section('site-meta-tags')
<meta name="description" content="{{ $$module_name_singular->meta_description ? $$module_name_singular->meta_description : setting('meta_keyword') }}">
@endsection


@section('content')

<style type="text/css">
    .thank-you-pop {
        width: 100%;
        padding: 20px;
        text-align: center;
    }

    .thank-you-pop img {
        width: 76px;
        height: auto;
        margin: 0 auto;
        display: block;
        margin-bottom: 25px;
    }

    .thank-you-pop h1 {
        font-size: 42px;
        margin-bottom: 25px;
        color: #5C5C5C;
    }

    .thank-you-pop p {
        font-size: 20px;
        color: #5C5C5C;
        margin-bottom: 0;
    }

    .thank-you-pop h3.cupon-pop {
        font-size: 25px;
        margin-bottom: 40px;
        color: #222;
        display: inline-block;
        text-align: center;
        padding: 10px 20px;
        border: 2px dashed #222;
        clear: both;
        font-weight: normal;
    }

    .thank-you-pop h3.cupon-pop span {
        color: #03A9F4;
    }

    .thank-you-pop a {
        display: inline-block;
        margin: 0 auto;
        padding: 9px 20px;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
        background-color: #8BC34A;
        border-radius: 17px;
    }

    .thank-you-pop a i {
        margin-right: 5px;
        color: #fff;
    }

    #popup .modal-header {
        border: 0px;
    }

    .mail-redr {
        color: #fff;
    }

    a:hover {
        color: none;
    }
</style>

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>
            <?= $$module_name_singular->name ?>
        </p>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row row-flex-cls">
            <div class="col-lg-8 one_order">
                <form id="google-sheet" method="post" name="google-sheet">
                    <h4 class="book-app">Book An Appointment</h4>
                    <div class="form-new">
                        <div class="form-group margin-bottom-5">
                            <div class="position-relative">
                                <i class="fa fa-user icon" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="name" class="form-controler name-cls" id="exampleInputName1" aria-describedby="emailHelp" placeholder="Patient's Name*">
                            <div class="name-err"></div>
                        </div>

                        <div class="form-group margin-bottom-5">
                            <div class="position-relative">
                                <i class="fa fa-phone icon" aria-hidden="true"></i>
                            </div>
                            <input type="number" name="phone" class="form-controler phone-cls" id="exampleInputPhone" placeholder="Phone Number*">
                            <div class="phone-err"></div>
                        </div>

                        <div class="form-group margin-bottom-5">
                            <div class="position-relative">
                                <i class="fa fa-envelope icon" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="email" class="form-controler email-cls" id="exampleInputEmail" placeholder="Email Address*">
                            <div class="email-err"></div>
                        </div>

                        <div class="form-group margin-bottom-5">
                            <div class="position-relative">
                                <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                            </div>
                            <select id="city" name="location" class="form-controler1">
                                <option value="">City Location*</option>
                                <?php
                                $citiesArr = citiesArr();
                                foreach ($citiesArr as $item) {
                                ?>
                                    <option value="<?= ucwords($item) ?>">
                                        <?= ucwords($item) ?>
                                    </option>
                                <?php } ?>
                                <option value="Other Cities">Other Cities</option>
                                <option value="Other Countries">Other Countries</option>
                            </select>
                            <div class="city-err"></div>
                        </div>

                        <div class="form-group margin-bottom-5">
                            <div class="position-relative">
                                <i class="fa fa-id-badge icon" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="age" class="form-controler age-cls" id="exampleInputAge" placeholder="Age in Years*">
                            <div class="age-err"></div>
                        </div>

                        <div class="form-group d-flex margin-bottom-5">
                            <div class="position-relative">
                                <i class="fa fa-venus-mars icon" aria-hidden="true"></i>
                            </div>
                            <span class="gender-contact">Gender*</span>
                            <div class="px-3">
                                <input type="radio" value="male" id="male" name="gender" checked />
                                <label for="male" class="radio radioo_icon ">Male</label>
                            </div>
                            <div>
                                <input type="radio" value="female" id="female" name="gender" />
                                <label for="female" class="radio radioo_icon ">Female</label>
                            </div>
                        </div>

                        <div class="form-group margin-bottom-5">

                            <div class="position-relative">
                                <i class="fa fa-user-md icon" aria-hidden="true"></i>
                            </div>
                            <select id="appointment_for" name="appointment_for" class="form-controler1">
                                <option value="">Select Treatment*</option>
                                <?php
                                $popular_surgeries = popular_cities_surgeries("all", $skip = false, $take = false);
                                foreach ($popular_surgeries as $item) {
                                ?>
                                    <option value="<?= $item->title ?>">
                                        <?= $item->title ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="appointment-err"></div>
                        </div>

                        <div class="form-group margin-bottom-5">

                            <div class="position-relative">
                                <i class="fa fa-comment icon" aria-hidden="true"></i>
                            </div>

                            <textarea maxlength="3000" name="message" class="form-controler message-cls" id="exampleFormControlTextarea1" rows="1" placeholder="Message*"></textarea>
                            <div class="msg-err"></div>

                        </div>
                        <div class="form-group margin-bottom-5">
                            <div class="g-recaptcha" data-theme="light" data-sitekey="<?= env('DATA_SITEKEY_V2') ?>"></div>
                            <div class="captcha-err"></div>
                        </div>

                        <?php

                        use Illuminate\Support\Facades\Session;

                        function input_url()
                        {
                            return sprintf(
                                "%s://%s%s",
                                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                                $_SERVER['SERVER_NAME'],
                                $_SERVER['REQUEST_URI']
                            );
                        }

                        date_default_timezone_set('Asia/Kolkata');
                        $current_time = date('H:i:s A');

                        $target_url = URL::to('/') .  "/book-an-appointment";

                        if (isset($_GET['code'])) {
                            Session::put('access_token', $_GET['code']);
                        }

                        $code = "";
                        $access_token = Session::get('access_token');
                        if ($access_token) {
                            $code = $access_token;
                        }
                        ?>

                        <input type="hidden" name="city_url" value="<?= input_url() ?>">
                        <input type="hidden" name="url" value="<?= input_url() ?>">
                        <input type="hidden" name="time" value="<?= $current_time ?>">
                        <input type="hidden" name="code" value="<?= $code ?>">
                        <!-- <button type="submit" name="submit" class="submit-button-contact">
                            Submit
                        </button> -->
                        <div class="zoho-crm-oauth">
                            <a href="<?= "https://accounts.zoho.in/oauth/v2/auth?response_type=code&client_id=1000.2IKVBF4JGWRGEW8MOLEFC7ZB350KXZ&scope=ZohoCRM.modules.ALL&redirect_uri=$target_url&prompt=consent" ?>">
                                <?php if ($code) { ?>
                                    <button type="submit" name="submit" class="submit-button-contact">
                                        <?= ($code) ? "Connected With Zoho CRM" : "Click to Connect With Zoho CRM" ?>
                                    </button>
                                <?php } else { ?>
                                    <div type="submit" name="submit" class="submit-button-contact">
                                        <?= ($code) ? "Connected With Zoho CRM" : "Click to Connect With Zoho CRM" ?>
                                    </div>
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4 form-bg-2">
                <h3 class="reach_us">Reach us at</h3>
                <div class="icon_sec">
                    <div>
                        <a class="font-weight-cls color-inherit" href="tel:<?= setting('support_telephone') ?>">
                            <i class="fa fa-phone icon_sec1 " aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="icon_space">
                        <p>Phone</p>
                        <p>
                            <a class="font-weight-cls color-inherit" href="tel:<?= setting('support_telephone') ?>">
                                <?= setting('support_telephone') ?>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="icon_sec">
                    <div class="display-flex book-an-app">
                        <a href="https://wa.me/919888550489">
                            <i class="fa fa-whatsapp" aria-hidden="true">
                                <span>
                                    WhatsApp us
                                </span>
                            </i>
                        </a>
                    </div>
                </div>

                <div class="icon_sec">
                    <div>
                        <i class="fa fa-envelope icon_sec1" aria-hidden="true"></i>
                    </div>
                    <div class="icon_space">
                        <p>Email</p>
                        <a href="mailto:<?= setting('email') ?>">
                            <p>
                                <?= setting('email') ?>
                            </p>
                        </a>
                    </div>
                </div>

                <div class="icon_sec">
                    <div>
                        <i class="fa fa-calendar icon_sec1 " aria-hidden="true"></i>
                    </div>
                    <div class="icon_space">
                        <p class="text-white bold-cls">Clinic Timing</p>
                        <div class="row clac-100-cls">
                            <div class="col-md-12 font-weight-cls">
                                <p class="text-white">
                                    <span>Monday - Friday</span>
                                    <span class="pull-right">9am - 7pm</span>
                                </p>
                                <p class="text-white">
                                    <span>Saturday</span>
                                    <span class="pull-right">9am - 2pm</span>
                                </p>
                                <p class="text-white">
                                    <span>Sunday</span>
                                    <span class="pull-right">Closed!</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="spacer">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="item-middle">
                        <div class="ico">
                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                            <h6>For any query related to treatment email us</h6>
                            <h6>
                                <a href="mailto:<?= Setting('email') ?>">
                                    <?= Setting('email') ?>
                                </a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push ("after-scripts")

@endpush