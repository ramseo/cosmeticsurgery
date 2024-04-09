<div class="container-fluid position-relative" style="background-color:#1a508b">
   <footer>
      <div class="container">
         <div class="row">
            <?php
            $about_menu = dynamic_menu('menutype', 'url', 'about');
            if ($about_menu) {
            ?>
               <div class="col-lg-3 col-md-6 col-sm-12">
                  <h2>About</h2>
                  <ul>
                     <?php foreach ($about_menu as $about_item) { ?>
                        <li>
                           <a href="<?= url("/") . "/" . $about_item->url ?>">
                              <?= $about_item->title ?>
                           </a>
                        </li>
                     <?php } ?>

                     <li>
                     <a href="<?= url('contact-us') ?>">Contact us</a>
                        </li>

                  </ul>
               </div>
            <?php
            }

            $useful_links = dynamic_menu('menutype', 'url', 'useful-links');
            if ($useful_links) {
            ?>
               <div class="col-lg-3 col-md-6 col-sm-12">
                  <h2>Useful Links</h2>
                  <ul>
                     <?php foreach ($useful_links as $useful_links_item) { ?>
                        <li>
                           <a href="<?= url("/") . "/" . $useful_links_item->url ?>">
                              <?= $useful_links_item->title ?>
                           </a>
                        </li>
                     <?php } ?>
                  </ul>
               </div>
            <?php
            }

            $top_procedures = dynamic_menu('menutype', 'url', 'top-procedures');
            if ($top_procedures) {
            ?>
               <div class="col-lg-3 col-md-6 col-sm-12">
                  <h2>Top Procedures</h2>
                  <ul>
                     <?php foreach ($top_procedures as $top_procedures_item) { ?>
                        <li>
                           <a href="<?= url("/") . "/" . $top_procedures_item->url ?>">
                              <?= $top_procedures_item->title ?>
                           </a>
                        </li>
                     <?php } ?>
                  </ul>
               </div>
            <?php } ?>

            <div class="col-lg-3 col-md-6 col-sm-12">
               <h2>Contact</h2>
               <ul>
                  <li>
                     <a href="#">
                        <img src="<?= asset('img/logo-cosmeticsurgery.png') ?>">
                     </a>
                  </li>
                  <br>
                  <li>
                     <a href="mailto:<?= Setting('email') ?>">
                        <i class="icon_mail_alt"></i>
                        <?= Setting('email') ?>
                     </a>
                  </li>
               </ul>
               <div class="links">
                  <h4 style="text-align:center">Follow US</h4>
                  <ul class="company-social" style="text-align:center; padding:0;">
                     <li><a target="_blank" href="https://www.facebook.com/CosmeticSurgery.in"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                     <li><a target="_blank" href="https://twitter.com/CosmeticSurgIN"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                     <li><a target="_blank" href="https://www.linkedin.com/company/cosmeticsurgeryindia/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                     <li><a target="_blank" href="https://www.instagram.com/cosmeticsurgery.in"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- <a id="button-scroll" style="visibility: visible; opacity: 1;display:none">
         <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
      </a> -->
   </footer>
</div>

<div class="container-fluid position-relative" style="background-color: #1a508b; border-top:1px dashed #fff">
   <div class="small-footer">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
               <p class="color-white">Clinic Locations :</p>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 citi-locat">
               <ul class="footer-list">
                  <?php
                  $citiesArr = citiesArr();
                  $i = 0;
                  $len = count($citiesArr);

                  if ($citiesArr) {
                     foreach ($citiesArr as $city) {
                        $slash = "<span>|</span>";
                        if ($i == ($len - 1)) {
                           $slash = "";
                        }
                  ?>
                        <li>
                           <a href="<?= url(strtolower($city)) ?>">
                              <?= ucwords($city) ?>
                           </a>
                        </li>
                        <?= $slash ?>
                  <?php
                        $i++;
                     }
                  }
                  ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container-fluid small-footer-parent position-relative">
   <div class="small-footer">
      <div class="floatt-left">
         <?= "Copyright ©" . " " . date('Y') . " - " . $_SERVER['SERVER_NAME'] . " - " . "All rights reserved" ?>
      </div>
      <div class="floatt-right">
         <a href="<?= url('disclaimer') ?>">Disclaimer</a>
         <span>|</span>
         <a href="<?= url('privacy') ?>">Privacy Policy</a>
         <span>|</span>
         <a href="<?= url('terms') ?>">Terms</a>
      </div>
   </div>
   <div class="split"></div>
</div>

<!-- LEAD FORM CODE -->
<?php
$url = strtok(\Request::getRequestUri(), '?');
if ($url != "/book-an-appointment") {
?>

<?php
//if (\Request::getRequestUri() != "/book-an-appointment") {
?>
   <div class="sidebar-form">
      <div class="call-action">
         <span>Enquiry Form</span>
         <span>
            <i id="chevron-icon" class="fa fa-chevron-up"></i>
         </span>
      </div>
      <form style="box-shadow:none; background:none; padding:0;" id="google-sheet" method="post" name="google-sheet">
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
         function browser_url()
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
         ?>

         <input type="hidden" name="city_url" value="<?= browser_url() ?>">
         <input type="hidden" name="url" value="<?= browser_url() ?>">
         <input type="hidden" name="time" value="<?= $current_time ?>">
         <button type="submit" name="submit" class="submit-button-contact">
            Submit
         </button>
      </form>
   </div>
   <div id="chatbutton">
      <a href="https://wa.me/919888550489" target="_blank" class="chat-cls">
         <img src="<?= asset('images/whatsapp-6273368_960_720.webp') ?>">
      </a>
   </div>
<?php } ?>
<!-- LEAD FORM CODE -->


<!--Model Popup starts-->
<div class="container">
   <div class="row">
      <div class="modal fade" id="popup" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="thank-you-pop">
                     <img src="<?= asset('img/Green-Round-Tick.png') ?>" alt="img">
                     <div class="thank-you-head">
                        Thank You!
                     </div>
                     <p>
                        We have received your enquiry, we'll get back to you within 24-48 hours.
                        (Mon-Sat 10am-6pm IST)
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Model Popup ends-->

@push('after-scripts')
<script>
   var lead_form_path = "<?= route('frontend.pages.lead_form') ?>";
   var surgeons_filter_path = "<?= route('frontend.pages.surgeon_filter') ?>";
   var csrf_token = "<?= csrf_token() ?>";
   var base_url = "<?= url('/') . '/' ?>";

   $(document).ready(function() {
      $('.sidebar-form .call-action').click(function() {
         $(this).parents(".sidebar-form").toggleClass("show");
         var cls = $('#chevron-icon').attr("class");

         if (cls == "fa fa-chevron-up") {
            $('#chevron-icon').attr("class", "fa fa-chevron-down");
         } else {
            $('#chevron-icon').attr("class", "fa fa-chevron-up");
         }
      });
   });
</script>
@endpush