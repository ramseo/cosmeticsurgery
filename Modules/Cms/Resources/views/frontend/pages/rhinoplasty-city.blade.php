@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->meta_title}} @endsection

@section('site-meta-tags')
<meta name="description" content="{{ $$module_name_singular->meta_description ? $$module_name_singular->meta_description : setting('meta_keyword') }}">
@endsection


@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container top-head-padd-null">
        <p>{{$$module_name_singular->name}}</p>
    </div>
</div>

<!-- Doctors Listing -->
<?php
$getAssignedDoctors = getAssignedDoctors(ucwords($city));
if ($getAssignedDoctors->isNotEmpty()) {
?>
    <div class="container-fluid">
        <div class="container">
            <!-- <div class="row"> -->
            <p class="identity width-100">
                top cosmetic surgeons in <?= ucwords($city) ?>
            </p>
            <div class="col-lg-12 doc-flex-cls padd-null">
                <?php
                $getAssignedDoctors = getAssignedDoctors(ucwords($city));
                if ($getAssignedDoctors) {
                    foreach ($getAssignedDoctors as $item) {
                        $reviews = getDataArray('vendor_reviews', 'user_id', $item->id);
                        $average = averageReview($reviews);
                ?>
                        <div class="col-lg-4">
                            <div class="col-12 doc-flex-cls doctor-box-shadow">
                                <div class="col-lg-4 padd-null">
                                    <div class="doc-img-div">
                                        <a target="_blank" href="<?= url("surgeon/dr-$item->username") ?>">
                                            <?php if (file_exists(public_path() . '/storage/user/profile/' . $item->avatar)) { ?>
                                                <img src="<?= asset('/storage/user/profile/' . $item->avatar) ?>" alt="doctor img" />
                                            <?php } else { ?>
                                                <img src="<?= asset("img/default-avatar.jpg") ?>" alt="doctor img" />
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="doc-star-rating">
                                        <ul class="list-inline space-list">
                                            <li class="list-inline-item">
                                                <ul class="list-inline">
                                                    <?php
                                                    $totalRating = 5;
                                                    $starRating = $average;

                                                    for ($i = 1; $i <= $totalRating; $i++) {
                                                        if ($starRating < $i) {
                                                            if (is_float($starRating) && (round($starRating) == $i)) {
                                                                echo "";
                                                            } else {
                                                                echo "<li class='list-inline-item yellow-star'>
                                                                       <i class='fa fa-star-o' aria-hidden='true'></i>
                                                                     </li>";
                                                            }
                                                        } else {
                                                            echo "<li class='list-inline-item yellow-star'>
                                                                   <i class='fa fa-star'></i>
                                                                 </li>";
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="star-rating-count">
                                        (<?= count($reviews) ?>)
                                    </div>
                                </div>
                                <div class="col-lg-8 doc-details-sec padd-null">
                                    <div class="doc-name">
                                        <a target="_blank" href="<?= url("surgeon/dr-$item->username") ?>">
                                            Dr. <?= $item->first_name . " " . $item->last_name . ", MD" ?>
                                        </a>
                                    </div>
                                    <div class="doc-tagline">
                                        Plastic/Cosmetic
                                    </div>
                                    <div class="doc-tagline">
                                        Surgeon
                                    </div>
                                    <div class="doc-tagline">
                                        <?php
                                        $get_userprofiles = get_userprofiles($item->id);
                                        echo $get_userprofiles->degree;
                                        ?>
                                    </div>
                                    <div class="doc-city">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <?= getCitiesById($item->city, 'pipe') ?>
                                    </div>
                                    <div class="doc-view-btn">
                                        <a target="_blank" href="<?= url("surgeon/dr-$item->username") ?>">
                                            view full profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="row">
                <div class="col">
                    <p>
                        Our Board-Certified Plastic Surgeons in <?= ucwords($city) ?> hold dexterity in performing complex cosmetic surgeries with ease.
                        Our experts have a commendable record of operating countless surgeries with success.
                        Among their expertise, include Liposuction, Rhinoplasty, Blepharoplasty, Gynecomastia, Breast Augmentation, Tummy Tuck, and more.
                        Our surgeons are immensely qualified and possess adept expertise in performing surgery with great precision.
                        They make sure to give personal attention to each individual, listen carefully to the problems of the patients, and try to grasp their expectations from the surgery.
                        This helps them appreciably in suggesting and performing the most suitable procedure in a safe and hygienic environment, well-equipped with advanced surgery tools.
                    </p>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
<?php } ?>
<!-- Doctors Listing -->

<div class="container-fluid city-surgery-cls">
    <div class="container">
        <?php if ($surgery_str == "rhinoplasty") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Are you planning to reshape your nose to accentuate your features?
                        </strong>
                    </p>
                    <p>
                        Well, <?= $surgery_str ?>, or ‘nose job’, will give you the desired results.
                        Performed as an outpatient procedure, it has a minimal recovery time.
                        With the efforts of our experienced cosmetic surgeons in <?= ucwords($city) ?>,
                        you can get regain your sculpted nose with a striking resemblance
                        to your natural appearance.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our <?= $surgery_str ?> Surgeons in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        We enable you to find the most experienced,
                        and skilled cosmetic surgeons for <?= $surgery_str ?> in <?= ucwords($city) ?>.
                    </li>
                    <li>
                        Exponential success rates for <?= $surgery_str ?> surgeries with a satisfying
                        patient experience.
                    </li>
                    <li>
                        Renowned cosmetic surgeons certified by the reputed national
                        and international boards for plastic surgeons.
                    </li>
                    <li>
                        Expertise in performing varied types of <?= $surgery_str ?> treatments in <?= ucwords($city) ?>,
                        including revision <?= $surgery_str ?>, reduction <?= $surgery_str ?>, augmentation <?= $surgery_str ?>,
                        filler <?= $surgery_str ?>, reconstruction <?= $surgery_str ?>, and post-traumatic <?= $surgery_str ?>
                        depending on the specific condition and expectation of the patient.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The cost of <?= $surgery_str ?> surgery depends on various factors including the complexity
                    of the operation, any additional requirements like nasal implants, etc.
                    It would be good to visit our cosmetic surgeon to discuss all the requisite details.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Enhance your overall facial appearance with <?= $surgery_str ?>
                    from one of our best cosmetic surgery surgeons in <?= ucwords($city) ?>!
                    Experience the most attentive patient care in state-of-the-art
                    facilities and experienced medical staff
                    supervised by our accomplished cosmetic surgeons.
                </p>

                <p class="identity">
                    FAQs on <?= $surgery_str ?> Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for <?= $surgery_str ?>?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you satisfy below points, you are a good candidate for <?= $surgery_str ?>
                            surgery in <?= ucwords($city) ?>
                        </p>
                        <ul>
                            <li>Your facial growth has attained its completion</li>
                            <li>You are a healthy person</li>
                            <li>
                                You have informed your surgeon about the allergies and medical conditions
                                that you are undergoing
                            </li>
                            <li>You are not allergic to anesthesia or other medicines related to nose surgery</li>
                            <li>
                                You are a non-smoker and a non-alcoholic (If not, be the one at least
                                for the duration recommended by your surgeon)
                            </li>
                            <li>You have realistic goals with respect to the nose surgery</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of <?= $surgery_str ?>?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            On average, the cost of <?= $surgery_str ?> in <?= ucwords($city) ?> may vary between
                            50,000 INR to 2,50,000 depending on various factors.
                            The cost may fluctuate further subject to the treatment necessities.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to <?= $surgery_str ?>?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Whether you opt for <?= $surgery_str ?> in <?= ucwords($city) ?> or elsewhere,
                            there may arise certain risks after the surgery, such as:
                        </p>
                        <ul>
                            <li>Bleeding, infection, adverse reaction to anesthesia</li>
                            <li>Visible scars</li>
                            <li>The chance of an un-even nose appearance as the outcome</li>
                            <li>Problem with breathing through the nose</li>
                            <li>Persistent swelling, skin discoloration, or pain</li>
                            <li>Urgent need for a revision nose surgery</li>
                            <li>Possibility of a hole in the septum</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for <?= $surgery_str ?>?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The best to go for <?= $surgery_str ?> in <?= ucwords($city) ?> is when your facial structure
                            is fully developed. Hence, the surgery is not advisable for children,
                            as they are still in their growing phase. Usually,
                            females between the age of 15-16 and beyond can go for <?= $surgery_str ?>, Likewise,
                            males of 17-18 years of age and beyond can opt for it.
                        </p>

                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before <?= $surgery_str ?> surgery
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>Give your body complete rest to enable prompt healing after the surgery</li>
                            <li>Clean your face at least twice a day to get rid of dead skin</li>
                            <li>Keep yourself hydrated</li>
                            <li>Have some to take you back home after the surgery</li>
                            <li>
                                Prepare your things in advance so that you don’t face
                                hassles after returning from the surgery
                            </li>
                            <li>Avoid drinking and smoking</li>
                            <li>
                                Avoid using over-the-counter medicated creams that include salicylic acid, Retin-A,
                                benzoyl peroxide, etc.
                            </li>
                            <li>Minimize exposure to the sun</li>
                            <li>
                                Consult your surgeon to know about the medications to avoid and abide by all
                                the instructions
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of <?= $surgery_str ?> surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                If you are opting for nose surgery, it clearly indicates your uneasiness with your
                                existing nose shape. Hence, you would expect to have a better
                                appearance of your nose with the <?= $surgery_str ?> surgery.
                            </li>
                            <li>
                                However, make sure that you have realistic expectations with the surgery, and be prepared
                                to face the outcome. Anticipating miracles would only hurt your sentiments.
                            </li>
                            <li>
                                On the day of the surgery, you could expect the surgeon to take around 2-3 hours
                                to complete the procedure.
                            </li>
                            <li>
                                After the surgery, you may expect mild discomfort, which will vanish with time.
                            </li>
                            <li>
                                The surgeon would recommend you several post-operation instructions and medication
                                for quick healing. So, make sure to follow them strictly.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
            </div>
        <?php } elseif ($surgery_str == "blepharoplasty") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Are droopy eyelids affecting your appearance?
                        </strong>
                    </p>
                    <p>
                        While healthy eyes can transform your entire look, sagging upper eyelids or dark circles
                        can make you appear dull. Blepharoplasty is a suitable cosmetic surgery for correcting
                        droopy or sagging upper eyelids and removing unwanted skin on the lower eyelids.
                        When performed aesthetically by our expert cosmetic surgeons in <?= ucwords($city) ?>, your eyes
                        will look as fresh, bright, and young as ever.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Blepharoplasty in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Trusted and most experienced cosmetic surgeons in <?= ucwords($city) ?> to perform eyelid surgery
                    </li>
                    <li>
                        Leverage laser treatments and other latest techniques to get rid of the wrinkles
                        around the eyes
                    </li>
                    <li>
                        Expert cosmetic surgeons with certification from reputed national and international
                        boards for cosmetic surgeons
                    </li>
                    <li>
                        Adept expertise in making your eyes naturally youthful by considering the facial muscle structure, bone structure,
                        and the symmetry of the eyebrows
                    </li>
                </ul>

                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The cost of Blepharoplasty surgery depends on the complexity of the surgery.
                    If your eyelids are obstructing the vision, you may get medical insurance cover
                    for the same. Else, it will come under aesthetic purposes and hence will not qualify
                    for the insurance claim. It is better to consult our cosmetic surgeon in <?= ucwords($city) ?>
                    if you want to know the treatment cost. Depending on your expectations and any other
                    additional treatments needed, you can get a better estimate.
                </p>
                <p class="identity">
                    OUR SERVICES
                </p>
                <p>
                    The liveliness of your eyes has a great impact on your appearance. Due to the age factor,
                    you can end up with sagging eyelids and dark circles. Blepharoplasty is the right
                    cosmetic treatment to turn you into a better-looking self. Schedule a consultation
                    session with <?= ucwords($city) ?>’s renowned cosmetic surgeons now.
                </p>

                <p class="identity">
                    FAQs on Blepharoplasty Surgery in <?= ucwords($city) ?>
                </p>

                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Blepharoplasty?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            An ideal candidate for eyelid surgery in <?= ucwords($city) ?> should adhere
                            to several essential criteria, as mentioned here:
                        </p>
                        <ul>
                            <li>
                                Suffering from droopy eyelids, exposing an increased portion of eye white
                            </li>
                            <li>
                                Sagging upper eyelids resulting due to fatty tissue building up beneath
                                the skin
                            </li>
                            <li>
                                Suffering from peripheral vision problems that need immediate intervention
                            </li>
                            <li>
                                Want to get rid of dark circles and under-eye bags
                            </li>
                            <li>
                                Have a good physical health
                            </li>
                            <li>
                                Does not have any pre-existing medical condition
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Blepharoplasty?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            On average, the cost of Eyelid Surgery or Blepharoplasty in <?= ucwords($city) ?> varies
                            between 80,000 INR and 2,00,000 INR. The cost may fluctuate both ways depending
                            on the doctor your approach, the clinic you choose for the surgery,
                            and several other factors.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Blepharoplasty?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Allergic reaction to anesthesia
                            </li>
                            <li>
                                Surgical risks, which may include bleeding and infection
                            </li>
                            <li>
                                Numbness in the treated area
                            </li>
                            <li>
                                Blurred or impaired sight temporarily
                            </li>
                            <li>
                                Possibility of ectropion, which refers to slack and outward-rolling of the lower eyelid
                            </li>
                            <li>
                                Watery eyes or dry eyes
                            </li>
                            <li>
                                Lump in the lower eyelid, which could irritate the surface of the eye
                            </li>
                            <li>
                                Loss of vision in rare cases
                            </li>
                            <li>
                                Revision surgery due to faulty surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Blepharoplasty?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            When you start noticing droopy or baggy upper eyelids, Blepharoplasty surgery in <?= ucwords($city) ?>
                            could help to remedy the situation. In addition, when you observe problems in peripheral
                            vision due to the generation of excess skin in the upper eyelids or lower eyelids,
                            you can always opt for Blepharoplasty. The ideal age to get eyelid surgery is 30 plus,
                            as most people get droopy eyelids in their 30s itself.
                        </p>

                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Blepharoplasty Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                It is good to visit a lab to test and find the existing medical condition
                                of your eyes.
                            </li>
                            <li>
                                Consult with your surgeon about your ongoing medications, so that the expert could suggest necessary adjustments
                            </li>
                            <li>
                                Stop drinking and smoking at least 4-6 months before the surgery
                            </li>
                            <li>
                                Avoid the consumption of anti-inflammatory drugs or herbal supplements as it could lead to bruising or bleeding
                            </li>
                            <li>
                                Make sure you are aware of all the risks and side effects of the surgery
                            </li>
                            <li>
                                Be prepared for the surgery so that you could go under the knife with a calm
                                mind
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Blepharoplasty surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of Blepharoplasty surgery, arrive at the clinic with a positive
                                frame of mind
                            </li>
                            <li>
                                One of the staff members will administer anesthesia to help you ensure a
                                painless surgery
                            </li>
                            <li>
                                You could expect the staff to take several tests before the surgery to check your
                                current health, such as your sugar level, oxygen level, BP, and more
                            </li>
                            <li>
                                You could expect the surgery to continue for 1-2 hours.
                                Much will depend if the surgeon is repositioning the fat on the upper eyelids,
                                lower eyelids, or both. It may take additional time for a cheek lift.
                            </li>
                            <li>
                                After the surgery, the doctor will stitch the treated area, which will remain
                                for around a week.
                            </li>
                            <li>
                                For upper eyelid surgery, the expected recovery time is 7-10 days. Likewise,
                                for lower eyelid surgery, it may take 10-14 days for complete recovery.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
            </div>
        <?php } elseif ($surgery_str == "facelift") {  ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Has your face started showing wrinkles and fine lines too early? If yes,
                        then facelift surgery can restore your youthful skin appreciably! Facelift surgery
                        or Rhytidectomy enhances the complete appearance of your face thereby reducing
                        wrinkles, fine lines, and sagging.
                    </p>
                    <p>
                        Turn back the time and get your youthful looks back with facelift surgery
                        from one of our top cosmetic surgeons in <?= ucwords($city) ?>!
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Facelift Surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Most skilled surgeons in <?= ucwords($city) ?> for facelift surgery
                    </li>
                    <li>
                        Highly proficient at performing different facelift procedures like standard facelift,
                        mini facelift, mid facelift, and low facelift
                    </li>
                    <li>
                        Dexterous in performing customized facelifts in combination with other non-invasive
                        procedures for transformative results.
                    </li>
                    <li>
                        Extend complete support throughout the recovery phase
                    </li>
                    <li>
                        Board-certified surgeons with accreditations from multiple national organizations
                        for cosmetic surgeries
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The cost of a facelift varies depending on the extent of the surgery.
                    Some prefer to have a mini facelift on their forehead or cheeks while
                    others go for a total facelift. Hence, the price of the treatment
                    continues to differ.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    When nothing else works to restore your youthful look, a facelift is the best
                    treatment. In just one procedure by one of our experienced surgeons
                    in <?= ucwords($city) ?>, you can notice a visible difference in your
                    facial appearance.
                </p>

                <p class="identity">
                    FAQs on Facelift Surgery Surgery in <?= ucwords($city) ?>
                </p>

                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Facelift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Satisfying the below-mentioned conditions will make
                                you a suitable candidate for Facelift Surgery.
                            </li>
                            <li>
                                You should have a good overall skin condition with sufficient
                                elasticity and flexibility with the ability to bounce
                                back on pinching
                            </li>
                            <li>
                                Your lifestyle does not include smoking or extreme exposure to the sun
                            </li>
                            <li>
                                Your face has a strong underlying bone structure
                            </li>
                            <li>
                                You have a clear understanding of the healing process
                            </li>
                            <li>
                                You have fair expectations with the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Facelift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Approaching a certified and experienced cosmetic surgeon in <?= ucwords($city) ?>
                            can cost you anywhere around 1,00,000 INR – 2,00,000 INR for
                            facelift surgery.
                            You can also choose to customize your surgery by including Chin Surgery,
                            Lip Augmentation, etc. at additional costs.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Facelift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Facelift surgery can lead to several complications
                        </p>
                        <ul>
                            <li>
                                Hematoma, the collection of blood under the skin can happen within
                                24 hours of the surgery, thus leading to pressure and swelling
                            </li>
                            <li>
                                Permanent Facelift scars that can be hidden by hairline or natural
                                contours of ear and face
                            </li>
                            <li>
                                Possibility of infection
                            </li>
                            <li>
                                Damaged blood vessels resulting in bleeding
                            </li>
                            <li>
                                Slow healing of wounds
                            </li>
                            <li>
                                Injury to nerves in rare instances, leading to uneven facial
                                expression or appearance
                            </li>
                            <li>
                                Hampered blood supply to blood tissues,
                                resulting in hair and skin loss
                            </li>
                            <li>
                                Weight changes may change the condition of the skin and face
                            </li>
                            <li>
                                Possibility of revision surgeries in case the procedure did not go well
                                in rare instances
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Facelift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            People mostly opt for Facelifts to improve their facial structure that has been
                            worn out with age. Hence, individuals from 40 to 60 years
                            of age are more likely to undergo this surgery in <?= ucwords($city) ?>
                            to get rid of fine lines, wrinkles, deep lines,
                            and sagging skin in the face and neck area.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Facelift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Get medical evaluation and tests from a lab in <?= ucwords($city) ?> to make
                                sure that your body is fit enough to undergo the surgery
                            </li>
                            <li>
                                Have the required budget to pay for the treatment
                            </li>
                            <li>
                                Inform your surgeon about your existing medications for proper adjustments
                                to ensure a safe facelift procedure
                            </li>
                            <li>
                                Stop smoking as the contained nicotine can restrict blood flow,
                                thus causing complications during the surgery and even later on
                            </li>
                            <li>
                                Start drinking plenty of water many days before the surgery,
                                as it will facilitate quick recovery
                            </li>
                            <li>
                                Be prepared with loose clothes or those with buttons, zip, etc.
                                to avoid taking off and wearing your shirts
                                repeatedly over your head
                            </li>
                            <li>
                                You will need someone to drive you home, take care of yourself
                                and do the cleaning after the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Facelift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of the surgery in <?= ucwords($city) ?>, you should be at the clinic
                                with a positive attitude
                            </li>
                            <li>
                                Your surgeon will clear all your apprehensions and doubts
                                if you have any, in a candid interaction
                            </li>
                            <li>
                                In the surgery room, the anesthesia expert will inquire if you have
                                allergic behavior to anesthesia and will
                                adjust the dose accordingly.
                            </li>
                            <li>
                                Usually, a facelift surgery in <?= ucwords($city) ?> might take around 3-6 hours
                                depending on the severity of your case. However,
                                opting for additional cosmetic procedures will
                                take more time.
                            </li>
                            <li>
                                During the surgery, you could expect the surgeon to do skin elevation
                                followed by tightening of muscles and tissues of the face
                                with the help of advanced tools and techniques.
                            </li>
                            <li>
                                You should have realistic expectations with the surgery so that the results
                                could not leave you upset.
                            </li>
                            <li>
                                After the surgery, you may feel pain in the treated areas, which will subside
                                in a day or two
                            </li>
                            <li>
                                You may also experience bruising and swelling on the face,
                                which will vanish in 1-2 weeks
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->

                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Facelift Surgery?
                    </p>
                    <ul>
                        <li>
                            Satisfying the below-mentioned conditions will make
                            you a suitable candidate for Facelift Surgery.
                        </li>
                        <li>
                            You should have a good overall skin condition with sufficient
                            elasticity and flexibility with the ability to bounce
                            back on pinching
                        </li>
                        <li>
                            Your lifestyle does not include smoking or extreme exposure to the sun
                        </li>
                        <li>
                            Your face has a strong underlying bone structure
                        </li>
                        <li>
                            You have a clear understanding of the healing process
                        </li>
                        <li>
                            You have fair expectations with the surgery
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        2. What is the cost of Facelift Surgery?
                    </p>
                    <p>
                        Approaching a certified and experienced cosmetic surgeon in <?= ucwords($city) ?>
                        can cost you anywhere around 1,00,000 INR – 2,00,000 INR for
                        facelift surgery.
                        You can also choose to customize your surgery by including Chin Surgery,
                        Lip Augmentation, etc. at additional costs.
                    </p>

                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Facelift Surgery?
                    </p>
                    <p>
                        Facelift surgery can lead to several complications
                    </p>
                    <ul>
                        <li>
                            Hematoma, the collection of blood under the skin can happen within
                            24 hours of the surgery, thus leading to pressure and swelling
                        </li>
                        <li>
                            Permanent Facelift scars that can be hidden by hairline or natural
                            contours of ear and face
                        </li>
                        <li>
                            Possibility of infection
                        </li>
                        <li>
                            Damaged blood vessels resulting in bleeding
                        </li>
                        <li>
                            Slow healing of wounds
                        </li>
                        <li>
                            Injury to nerves in rare instances, leading to uneven facial
                            expression or appearance
                        </li>
                        <li>
                            Hampered blood supply to blood tissues,
                            resulting in hair and skin loss
                        </li>
                        <li>
                            Weight changes may change the condition of the skin and face
                        </li>
                        <li>
                            Possibility of revision surgeries in case the procedure did not go well
                            in rare instances
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        4. When can you go for Facelift Surgery?
                    </p>
                    <p>
                        People mostly opt for Facelifts to improve their facial structure that has been
                        worn out with age. Hence, individuals from 40 to 60 years
                        of age are more likely to undergo this surgery in <?= ucwords($city) ?>
                        to get rid of fine lines, wrinkles, deep lines,
                        and sagging skin in the face and neck area.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Facelift surgery?
                    </p>
                    <ul>
                        <li>
                            Get medical evaluation and tests from a lab in <?= ucwords($city) ?> to make
                            sure that your body is fit enough to undergo the surgery
                        </li>
                        <li>
                            Have the required budget to pay for the treatment
                        </li>
                        <li>
                            Inform your surgeon about your existing medications for proper adjustments
                            to ensure a safe facelift procedure
                        </li>
                        <li>
                            Stop smoking as the contained nicotine can restrict blood flow,
                            thus causing complications during the surgery and even later on
                        </li>
                        <li>
                            Start drinking plenty of water many days before the surgery,
                            as it will facilitate quick recovery
                        </li>
                        <li>
                            Be prepared with loose clothes or those with buttons, zip, etc.
                            to avoid taking off and wearing your shirts
                            repeatedly over your head
                        </li>
                        <li>
                            You will need someone to drive you home, take care of yourself
                            and do the cleaning after the surgery
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Facelift surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of the surgery in <?= ucwords($city) ?>, you should be at the clinic
                            with a positive attitude
                        </li>
                        <li>
                            Your surgeon will clear all your apprehensions and doubts
                            if you have any, in a candid interaction
                        </li>
                        <li>
                            In the surgery room, the anesthesia expert will inquire if you have
                            allergic behavior to anesthesia and will
                            adjust the dose accordingly.
                        </li>
                        <li>
                            Usually, a facelift surgery in <?= ucwords($city) ?> might take around 3-6 hours
                            depending on the severity of your case. However,
                            opting for additional cosmetic procedures will
                            take more time.
                        </li>
                        <li>
                            During the surgery, you could expect the surgeon to do skin elevation
                            followed by tightening of muscles and tissues of the face
                            with the help of advanced tools and techniques.
                        </li>
                        <li>
                            You should have realistic expectations with the surgery so that the results
                            could not leave you upset.
                        </li>
                        <li>
                            After the surgery, you may feel pain in the treated areas, which will subside
                            in a day or two
                        </li>
                        <li>
                            You may also experience bruising and swelling on the face,
                            which will vanish in 1-2 weeks
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "brow lift") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Your forehead and eyelids are among the first places to show the signs
                        of ageing. A Brow Lift surgery targets this very area of your face,
                        i.e., sagging skin between the eyebrows and the upper eyelids.
                        You can minimise the appearance of wrinkles on the eyelids,
                        which will automatically result in a rejuvenated appearance.
                        Since it is an intricate surgery, it is vital to consult one of our best
                        cosmetic surgeons in <?= ucwords($city) ?>.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Brow Lift Surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        The best cosmetic surgeons in <?= ucwords($city) ?> with specialisation in facial
                        cosmetic procedures
                    </li>
                    <li>
                        Ability to deliver amazing results by minimising the signs of ageing near
                        the brows
                    </li>
                    <li>
                        Expert at combining Brow Lift surgery with other facial treatments
                        like facelifts,fillers, or Botox.
                    </li>
                    <li>
                        Experienced cosmetic surgeons in <?= ucwords($city) ?>, certified by the top national
                        associations of cosmetic surgeons.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    When compared to other cosmetic procedures, Brow Lift surgery is a
                    simple yet intricate treatment. Apart from the main surgery cost,
                    you should also consider the price of medicines and other
                    necessities for a smooth recovery. To get an estimate
                    for Brow Lift surgery, you can always consult
                    our cosmetic surgeon in <?= ucwords($city) ?>.
                </p>
                <p>
                    To get an estimate for <?= $surgery_str ?> surgery, you can always consult our cosmetic surgeon in <?= ucwords($city) ?>.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Tired eyes with wrinkles can make you look older.
                    Our surgeons will help to reduce the sagging
                    skin and wrinkles on your eyelids,
                    hence letting your eyes look bright,
                    big, and beautiful.
                    The customised Brow Lift surgery performed by one of our
                    best plastic surgeons in <?= ucwords($city) ?> would
                    be suitable in this regard.
                </p>

                <p class="identity">
                    FAQs on Brow Lift Surgery in <?= ucwords($city) ?>
                </p>

                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Brow Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The points below will help to find out if you are a
                            suitable candidate for Brow Lift
                            surgery in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                Your eyebrows have started sagging because of excessive skin
                            </li>
                            <li>
                                Heavily sagging brows leading to the vision problem
                            </li>
                            <li>
                                Formation of vertical frown lines between the brows
                            </li>
                            <li>
                                Fine lines and horizontal wrinkles on the forehead
                            </li>
                            <li>
                                You have good health overall, free from any severe
                                chronic disease
                            </li>
                            <li>
                                You do not consume tobacco or alcohol
                            </li>
                            <li>
                                You have set measurable goals with the Brow Lift surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Brow Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of Brow Lift surgery in <?= ucwords($city) ?> ranges between
                            60,000 INR to 1,30,000 INR. There is however a big variation,
                            which results due to the selection of hospital,
                            the expertise of the surgeon, fees of the anesthesiologist,
                            the use of advanced techniques, the extent of Brow Lift,
                            the addition of other surgeries, and so on.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Brow Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Like almost any other surgery, Brow Lift also accompanies
                            several risks and complications:
                        </p>
                        <ul>
                            <li>
                                Severe pain, bruising, and swelling
                            </li>
                            <li>
                                Accumulation of flood or seroma, which necessitates
                                the drainage of fluid
                            </li>
                            <li>
                                Allergic behaviour to sutures, antiseptic medicines,
                                dressings, etc.
                            </li>
                            <li>
                                Allergic reaction to anaesthesia
                            </li>
                            <li>
                                Possibility of infection
                            </li>
                            <li>
                                Skin scarring with visible marks formed due to sutures
                            </li>
                            <li>
                                Loss of sensation in the facial skin and the scalp area
                            </li>
                            <li>
                                Itching in the face or scalp
                            </li>
                            <li>
                                Skin contour irregularities leading to depressions and
                                skin wrinkling
                            </li>
                            <li>
                                Harm to deeper structures like the eyes, nerves, skull bone,
                                muscles, and blood vessels
                            </li>
                            <li>
                                Asymmetrical face
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Brow Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            People between the ages of 40-65 mostly opt for Brow Lift surgery.
                            During this age bracket, the brow line starts to droop,
                            fine lines appear across the forehead and wrinkle
                            formation becomes a norm. However,
                            young patients in their 20s or 30s having a genetic problem
                            of “worry lines” may also opt for this surgery
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Brow Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Quit smoking at least 2 weeks before the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Quit drinking alcohol at least 2 weeks before the Brow Lift
                            </li>
                            <li>
                                Visit the doctor to review your medical history
                                and suggest the adjustment of
                                existing medications (if any) accordingly
                            </li>
                            <li>
                                Clear your confusion regarding the surgery with your
                                cosmetic surgeon
                            </li>
                            <li>
                                Have a clear reason for undergoing the surgery and be aware
                                of the related pros and cons
                            </li>
                            <li>
                                Get medical tests such as Complete Blood Count (CBC), Clotting Time (CT),
                                and Bleeding Time (BT) a few days before the surgery
                                to ensure your good health for the surgery
                            </li>
                            <li>
                                Avoid consumption of anti-inflammatory drugs or other drugs that
                                could increase bleeding and bruising
                            </li>
                            <li>
                                Arrange for someone to be with you during the surgery
                                and help you take home after the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Brow Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of Brow Lift surgery, be in the hospital on time
                            </li>
                            <li>
                                The anesthesiologist will inquire about your reaction to
                                anesthesia and will administer the dose accordingly
                            </li>
                            <li>
                                In the surgery room, the surgeon will make the incisions
                                necessary to remove the excess fat, tighten the
                                sagging skin and make the
                                forehead wrinkle-free
                            </li>
                            <li>
                                You could expect the Brow Lift procedure to complete in around 1-2 hours
                                depending on the complications arising due to the surgery.
                            </li>
                            <li>
                                The surgeon will suggest you several prescriptions and recovery
                                instructions to follow
                            </li>
                            <li>
                                Your forehead will heal completely within 6 months
                            </li>
                            <li>
                                The surgeon will recommend you visit the clinic at regular intervals
                                for follow-ups after the surgery
                            </li>
                            <li>
                                Make sure to have realistic expectations with the surgery as the final
                                outcome may vary significantly than you might have thought
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->

                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Brow Lift surgery?
                    </p>
                    <p>
                        The points below will help to find out if you are a
                        suitable candidate for Brow Lift
                        surgery in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            Your eyebrows have started sagging because of excessive skin
                        </li>
                        <li>
                            Heavily sagging brows leading to the vision problem
                        </li>
                        <li>
                            Formation of vertical frown lines between the brows
                        </li>
                        <li>
                            Fine lines and horizontal wrinkles on the forehead
                        </li>
                        <li>
                            You have good health overall, free from any severe
                            chronic disease
                        </li>
                        <li>
                            You do not consume tobacco or alcohol
                        </li>
                        <li>
                            You have set measurable goals with the Brow Lift surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Brow Lift surgery?
                    </p>
                    <p>
                        The average cost of Brow Lift surgery in <?= ucwords($city) ?> ranges between
                        60,000 INR to 1,30,000 INR. There is however a big variation,
                        which results due to the selection of hospital,
                        the expertise of the surgeon, fees of the anesthesiologist,
                        the use of advanced techniques, the extent of Brow Lift,
                        the addition of other surgeries, and so on.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Brow Lift surgery?
                    </p>
                    <p>
                        Like almost any other surgery, Brow Lift also accompanies
                        several risks and complications:
                    </p>
                    <ul>
                        <li>
                            Severe pain, bruising, and swelling
                        </li>
                        <li>
                            Accumulation of flood or seroma, which necessitates
                            the drainage of fluid
                        </li>
                        <li>
                            Allergic behaviour to sutures, antiseptic medicines,
                            dressings, etc.
                        </li>
                        <li>
                            Allergic reaction to anaesthesia
                        </li>
                        <li>
                            Possibility of infection
                        </li>
                        <li>
                            Skin scarring with visible marks formed due to sutures
                        </li>
                        <li>
                            Loss of sensation in the facial skin and the scalp area
                        </li>
                        <li>
                            Itching in the face or scalp
                        </li>
                        <li>
                            Skin contour irregularities leading to depressions and
                            skin wrinkling
                        </li>
                        <li>
                            Harm to deeper structures like the eyes, nerves, skull bone,
                            muscles, and blood vessels
                        </li>
                        <li>
                            Asymmetrical face
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        4. When can you go for Brow Lift surgery?
                    </p>
                    <p>
                        People between the ages of 40-65 mostly opt for Brow Lift surgery.
                        During this age bracket, the brow line starts to droop,
                        fine lines appear across the forehead and wrinkle
                        formation becomes a norm. However,
                        young patients in their 20s or 30s having a genetic problem
                        of “worry lines” may also opt for this surgery
                    </p>

                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Brow Lift Surgery?
                    </p>
                    <ul>
                        <li>
                            Quit smoking at least 2 weeks before the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Quit drinking alcohol at least 2 weeks before the Brow Lift
                        </li>
                        <li>
                            Visit the doctor to review your medical history
                            and suggest the adjustment of
                            existing medications (if any) accordingly
                        </li>
                        <li>
                            Clear your confusion regarding the surgery with your
                            cosmetic surgeon
                        </li>
                        <li>
                            Have a clear reason for undergoing the surgery and be aware
                            of the related pros and cons
                        </li>
                        <li>
                            Get medical tests such as Complete Blood Count (CBC), Clotting Time (CT),
                            and Bleeding Time (BT) a few days before the surgery
                            to ensure your good health for the surgery
                        </li>
                        <li>
                            Avoid consumption of anti-inflammatory drugs or other drugs that
                            could increase bleeding and bruising
                        </li>
                        <li>
                            Arrange for someone to be with you during the surgery
                            and help you take home after the surgery
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Brow Lift surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of Brow Lift surgery, be in the hospital on time
                        </li>
                        <li>
                            The anesthesiologist will inquire about your reaction to
                            anesthesia and will administer the dose accordingly
                        </li>
                        <li>
                            In the surgery room, the surgeon will make the incisions
                            necessary to remove the excess fat, tighten the
                            sagging skin and make the
                            forehead wrinkle-free
                        </li>
                        <li>
                            You could expect the Brow Lift procedure to complete in around 1-2 hours
                            depending on the complications arising due to the surgery.
                        </li>
                        <li>
                            The surgeon will suggest you several prescriptions and recovery
                            instructions to follow
                        </li>
                        <li>
                            Your forehead will heal completely within 6 months
                        </li>
                        <li>
                            The surgeon will recommend you visit the clinic at regular intervals
                            for follow-ups after the surgery
                        </li>
                        <li>
                            Make sure to have realistic expectations with the surgery as the final
                            outcome may vary significantly than you might have thought
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "neck lift") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        While you often give importance to your face, you forget to notice
                        the role of the neck in your overall appearance.
                        Due to excessive weight gain or loss, hormonal imbalance,
                        ageing, or any other genetic factors, you may have a sagging
                        or drooping neck that could mess up how you look.
                    </p>
                    <p>
                        A neck lift aims at tightening the skin of the neck by removing the excess fat
                        under the chin and creating well-contoured necklines.
                        We recommend visiting any of our top cosmetic
                        surgeons in <?= ucwords($city) ?>
                        for neck lift procedures.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Neck Lift IN <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        The best cosmetic surgeons in <?= ucwords($city) ?> to perform neck lift
                    </li>
                    <li>
                        Testimonials by numerous patients who are more than satisfied with the results
                    </li>
                    <li>
                        Ability to help in restoring youthful appearance even as the ageing skin sets in.
                    </li>
                    <li>
                        Renowned cosmetic surgeons for facial aesthetics in <?= ucwords($city) ?>,
                        certified by several national and international
                        boards for cosmetic surgeries
                    </li>
                </ul>

                <p class="identity">
                    COST OF <?= $surgery_str ?> IN <?= ucwords($city) ?>
                </p>
                <p>
                    Many cosmetic surgeons in <?= ucwords($city) ?> have varying prices for neck lift
                    surgeries. This difference in cost depends on the
                    treatment facilities, the surgeon’s skills, and other
                    additional recovery treatment prices.
                    If you are considering neck lift surgery,
                    it is best to consult our cosmetic surgeon to
                    get realistic results.
                </p>
                <p class="identity">
                    OUR SERVICE
                </p>
                <p>
                    Is sagging skin on your neck disturbing your appearance? If yes,
                    you can go for a neck lift procedure by our certified surgeons
                    in <?= ucwords($city) ?> to make way for transformed results!
                </p>

                <p class="identity">
                    FAQs on Neck Lift Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Neck Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            To be a good candidate for Neck Lift in <?= ucwords($city) ?>,
                            you should fulfil the below-mentioned
                            conditions:
                        </p>
                        <ul>
                            <li>
                                You should have a healthy body without any severe medical
                                ailment that could affect recovery
                            </li>
                            <li>
                                You should not consume nicotine or alcohol
                            </li>
                            <li>
                                You have a short neck or weak chin resulting in a double
                                chin that you want to get away with
                            </li>
                            <li>
                                Your jawline starts sagging and your chin loses volume,
                                leading to the condition of jowls.
                            </li>
                            <li>
                                Your neck is sagging a lot with the weakening of the
                                underlying neck muscles,
                                giving way to the Turkey neck
                            </li>
                            <li>
                                You have developed platysmal bands, which give your neck a
                                thick and rubber-band kind of appearance hanging
                                from the chin to Adam’s apple area.
                            </li>
                            <li>
                                Your neck has developed creases and wrinkles
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of a Neck Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of Neck Lift surgery in <?= ucwords($city) ?>
                            lies between 70,000 INR to 1,00,000 INR.
                            Factors like skin and fat excision,
                            muscle plication, the need for liposuction,
                            and the surgeon’s expertise are the prominent
                            ones to decide the cost.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Neck Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Excessive Bleeding leading to the condition Hematoma
                            </li>
                            <li>
                                Nerve injury, skin loss, breakdown of wounds
                            </li>
                            <li>
                                Formation of seroma or abnormal accumulation of fluid
                                at the surgical incision site
                            </li>
                            <li>
                                Adverse reaction to anesthesia
                            </li>
                            <li>
                                Rare chances of scarring and bruising
                            </li>
                            <li>
                                Loss or reduction of sensation in the treated area
                            </li>
                            <li>
                                Asymmetric results
                            </li>
                            <li>
                                Need for revisional surgery
                            </li>
                            <li>
                                Stiffness of the neck
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Neck Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you have lost considerable weight, lost neck skin, have excess fat,
                            or have developed horizontal skin bands called neck bands,
                            this is the right time to opt for Neck Lift in <?= ucwords($city) ?>.
                            Patients mostly between the age of 35 and 65 prefer
                            opting for a neck lift.
                            You should however be physically and mentally fit at the time
                            of surgery.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Neck Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Before you opt for a Neck lift surgery, it would be good
                            to include the following essential
                            things in your checklist:
                        </p>
                        <ul>
                            <li>
                                Have good mental and physical health
                            </li>
                            <li>
                                Get your blood tests to ensure your good health
                            </li>
                            <li>
                                If you are pregnant, it is better to avoid the surgery
                                for the time being
                            </li>
                            <li>
                                Have someone drive you to the clinic and back home
                            </li>
                            <li>
                                Have someone to help you execute your daily cores
                                after the surgery
                            </li>
                            <li>
                                Arrange for loose clothes to make you comfortable during
                                and after the surgery
                            </li>
                            <li>
                                Make your surgeon aware of the medications you are taking
                                at present
                            </li>
                            <li>
                                Avoid taking Aspirin, health supplements, and anti-inflammatory drugs
                                to avoid extreme bleeding during surgery
                            </li>
                            <li>
                                Keep yourself hydrated
                            </li>
                            <li>
                                Avoid eating anything at least up to eight hours before the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Neck Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of the Neck Lift surgery in <?= ucwords($city) ?>, you will be given general
                                anesthesia to avoid pain during the procedure
                            </li>
                            <li>
                                Your surgeon will make incisions to operate on the deep structural tissues
                                of the lower face and neck.
                            </li>
                            <li>
                                You could also expect the surgeon to remove the excess skin
                            </li>
                            <li>
                                The entire surgery will continue for 1-3 hours and will work
                                best for patients having loose skin on the neck
                            </li>
                            <li>
                                You should have realistic expectations with the surgery results
                            </li>
                            <li>
                                Usually, it will take around 2 weeks for pain, swelling, and bruising to resolve
                                and to make neck contours visible after the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Around 4-6 weeks will be sufficient for complete recovery after
                                which you could go back to work.
                                In rare cases, this duration
                                may extend further
                            </li>
                            <li>
                                In around 3 months, you can expect the swelling on the neck
                                to vanish completely
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Neck Lift?
                    </p>
                    <p>
                        To be a good candidate for Neck Lift in <?= ucwords($city) ?>,
                        you should fulfil the below-mentioned
                        conditions:
                    </p>
                    <ul>
                        <li>
                            You should have a healthy body without any severe medical
                            ailment that could affect recovery
                        </li>
                        <li>
                            You should not consume nicotine or alcohol
                        </li>
                        <li>
                            You have a short neck or weak chin resulting in a double
                            chin that you want to get away with
                        </li>
                        <li>
                            Your jawline starts sagging and your chin loses volume,
                            leading to the condition of jowls.
                        </li>
                        <li>
                            Your neck is sagging a lot with the weakening of the
                            underlying neck muscles,
                            giving way to the Turkey neck
                        </li>
                        <li>
                            You have developed platysmal bands, which give your neck a
                            thick and rubber-band kind of appearance hanging
                            from the chin to Adam’s apple area.
                        </li>
                        <li>
                            Your neck has developed creases and wrinkles
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of a Neck Lift?
                    </p>
                    <p>
                        The average cost of Neck Lift surgery in <?= ucwords($city) ?>
                        lies between 70,000 INR to 1,00,000 INR.
                        Factors like skin and fat excision,
                        muscle plication, the need for liposuction,
                        and the surgeon’s expertise are the prominent
                        ones to decide the cost.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Neck Lift surgery?
                    </p>
                    <ul>
                        <li>
                            Excessive Bleeding leading to the condition Hematoma
                        </li>
                        <li>
                            Nerve injury, skin loss, breakdown of wounds
                        </li>
                        <li>
                            Formation of seroma or abnormal accumulation of fluid
                            at the surgical incision site
                        </li>
                        <li>
                            Adverse reaction to anesthesia
                        </li>
                        <li>
                            Rare chances of scarring and bruising
                        </li>
                        <li>
                            Loss or reduction of sensation in the treated area
                        </li>
                        <li>
                            Asymmetric results
                        </li>
                        <li>
                            Need for revisional surgery
                        </li>
                        <li>
                            Stiffness of the neck
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        4. When can you go for Neck Lift surgery?
                    </p>
                    <p>
                        If you have lost considerable weight, lost neck skin, have excess fat,
                        or have developed horizontal skin bands called neck bands,
                        this is the right time to opt for Neck Lift in <?= ucwords($city) ?>.
                        Patients mostly between the age of 35 and 65 prefer
                        opting for a neck lift.
                        You should however be physically and mentally fit at the time
                        of surgery.
                    </p>

                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Neck Lift Surgery?
                    </p>
                    <p>
                        Before you opt for a Neck lift surgery, it would be good
                        to include the following essential
                        things in your checklist:
                    </p>
                    <ul>
                        <li>
                            Have good mental and physical health
                        </li>
                        <li>
                            Get your blood tests to ensure your good health
                        </li>
                        <li>
                            If you are pregnant, it is better to avoid the surgery
                            for the time being
                        </li>
                        <li>
                            Have someone drive you to the clinic and back home
                        </li>
                        <li>
                            Have someone to help you execute your daily cores
                            after the surgery
                        </li>
                        <li>
                            Arrange for loose clothes to make you comfortable during
                            and after the surgery
                        </li>
                        <li>
                            Make your surgeon aware of the medications you are taking
                            at present
                        </li>
                        <li>
                            Avoid taking Aspirin, health supplements, and anti-inflammatory drugs
                            to avoid extreme bleeding during surgery
                        </li>
                        <li>
                            Keep yourself hydrated
                        </li>
                        <li>
                            Avoid eating anything at least up to eight hours before the surgery
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Neck Lift surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of the Neck Lift surgery in <?= ucwords($city) ?>, you will be given general
                            anesthesia to avoid pain during the procedure
                        </li>
                        <li>
                            Your surgeon will make incisions to operate on the deep structural tissues
                            of the lower face and neck.
                        </li>
                        <li>
                            You could also expect the surgeon to remove the excess skin
                        </li>
                        <li>
                            The entire surgery will continue for 1-3 hours and will work
                            best for patients having loose skin on the neck
                        </li>
                        <li>
                            You should have realistic expectations with the surgery results
                        </li>
                        <li>
                            Usually, it will take around 2 weeks for pain, swelling, and bruising to resolve
                            and to make neck contours visible after the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Around 4-6 weeks will be sufficient for complete recovery after
                            which you could go back to work.
                            In rare cases, this duration
                            may extend further
                        </li>
                        <li>
                            In around 3 months, you can expect the swelling on the neck
                            to vanish completely
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "chin surgery") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Also called Genioplasty or Mentoplasty, Chin surgery is the process
                        to augment or reduce the chin based on your facial features.
                        The cosmetic surgeon can move the chin backward
                        or forward and change its size by moving
                        it up and above. Our expert cosmetic
                        surgeons in <?= ucwords($city) ?> help to achieve a beautiful chin structure
                        that remains symmetrical with your face.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Chin Surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Our renowned cosmetic surgeons in <?= ucwords($city) ?> hold adept expertise in performing
                        numerous chin augmentation and reduction surgeries with success
                    </li>
                    <li>
                        Expert at Sliding Genioplasty - correcting longer and protruding chins.
                    </li>
                    <li>
                        Specialized in working with chin implants to achieve the desired looks.
                    </li>
                    <li>
                        Skilled cosmetic surgeons from <?= ucwords($city) ?> who leave barely visible scars
                        that fade quickly over time.
                    </li>
                    <li>
                        Members of several national and international cosmetic surgery boards
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> IN <?= ucwords($city) ?>
                </p>
                <p>
                    For the cost of chin surgeries, the type of recommended treatment will be
                    the deciding factor. If you want to increase the size of the chin, the
                    cosmetic surgeon will usually recommend using chin implants.
                    If you want to reduce the chin size, Genioplasty is the best choice.
                    So, the overall cost of chin surgery depends on the customized
                    surgery, the cosmetic surgeon in <?= ucwords($city) ?>,
                    and the additional medicines.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Are you worried that your chin does not complement the rest of your face?
                    If yes, get the help of any of our cosmetic surgeons in <?= ucwords($city) ?>
                    to fix the issue and change the appearance of your face.
                </p>
                <p class="identity">
                    FAQs on Chin Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Chin Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            An ideal candidate for Chin Surgery should fulfil
                            the below-mentioned requirements:
                        </p>
                        <ul>
                            <li>
                                Unappealing looks on the chin
                            </li>
                            <li>
                                Too short chin or with a low projection
                            </li>
                            <li>
                                Insecurity about weak jawline
                            </li>
                            <li>
                                Physically healthy and maintains a stable weight
                            </li>
                            <li>
                                Realistic expectations with the chin surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Non-smoker and non-alcoholic
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Chin Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The cost of a chin surgery in <?= ucwords($city) ?> depends upon several factors
                            like the procedure performed, the fees of the surgeon,
                            the hospital, and more.
                            The average cost ranges between 70,000 INR - 150,000 INR.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Chin Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Allergic behaviour to anesthesia
                            </li>
                            <li>
                                Swelling in the chin region
                            </li>
                            <li>
                                Asymmetrical appearance of the chin
                            </li>
                            <li>
                                Bruising on the sides of the chin that can appear from minimal
                                to “black and blue”
                            </li>
                            <li>
                                Numbness in the lower lip and chin
                            </li>
                            <li>
                                Unappealing facial proportions after the surgery
                            </li>
                            <li>
                                Displacement of chin implant
                            </li>
                            <li>
                                Need to change the silicon chin implant of a different size
                            </li>
                            <li>
                                Scar tissues surrounding the chin implant
                            </li>
                            <li>
                                Skin discoloration
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Chin Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Chin surgery is an optional procedure that you undergo if you think your chin is too long,
                            broad, or projects too far from your nose.
                            The surgery in <?= ucwords($city) ?> can enhance the balance of your chin with other facial features.
                            Chin surgery is popular among men and women of almost all age groups worldwide.
                            There is however no specific age limitation for the procedure.
                            Even 15 or 16-year-old young boys and girls could opt for it
                            if they have a fully developed chin.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Chin Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Visit your cosmetic surgeon to discuss all your apprehensions and doubts
                                about the chin surgery
                            </li>
                            <li>
                                Get all the lab tests and medical evaluations to enable the surgeon to find out
                                of your existing condition is good enough for the surgery
                            </li>
                            <li>
                                Abide by the do’s and don’ts instructed by the surgeon
                            </li>
                            <li>
                                Quit smoking and alcohol to combat the entry of toxins and carcinogens
                                into the bloodstream
                            </li>
                            <li>
                                Inform your surgeon about any of your existing medications, as he will suggest
                                making proper adjustments accordingly
                            </li>
                            <li>
                                Get some easy to wear garments in advance
                            </li>
                            <li>
                                Ask someone to accompany you to the clinic and get you back home after
                                the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Chin surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Be ready for the surgery day with the positive attitude
                            </li>
                            <li>
                                Usually, the surgeons in <?= ucwords($city) ?> perform chin surgery as an
                                outpatient treatment
                            </li>
                            <li>
                                One of the staff members will administer general or IV anesthesia
                                to make the chin area numb
                            </li>
                            <li>
                                The surgeon will make incisions with the latest technique inside your mouth
                                or under your chin
                            </li>
                            <li>
                                The incisions will be closed with the help of tapes, sutures, or skin
                                adhesives
                            </li>
                            <li>
                                The surgeon will apply facial drains to build fluid in your neck and
                                to minimize blood.
                            </li>
                            <li>
                                The doctor will remove these facial drains after a couple of days
                            </li>
                            <li>
                                It will take around an hour for the procedure to complete
                            </li>
                            <li>
                                You can go home just after around two hours from the surgery completion
                            </li>
                            <li>
                                You could expect swelling and slight discomfort
                            </li>
                            <li>
                                The chin and neck skin may appear tight because of bruising and
                                swelling
                            </li>
                            <li>
                                The surgery can help to inflict some positive changes on your face
                            </li>
                            <li>
                                Still, you should have realistic expectations with the procedure
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Chin Surgery?
                    </p>
                    <p>
                        An ideal candidate for Chin Surgery should fulfil
                        the below-mentioned requirements:
                    </p>
                    <ul>
                        <li>
                            Unappealing looks on the chin
                        </li>
                        <li>
                            Too short chin or with a low projection
                        </li>
                        <li>
                            Insecurity about weak jawline
                        </li>
                        <li>
                            Physically healthy and maintains a stable weight
                        </li>
                        <li>
                            Realistic expectations with the chin surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Non-smoker and non-alcoholic
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Chin Surgery?
                    </p>
                    <p>
                        The cost of a chin surgery in <?= ucwords($city) ?> depends upon several factors
                        like the procedure performed, the fees of the surgeon,
                        the hospital, and more.
                        The average cost ranges between 70,000 INR - 150,000 INR.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Chin Surgery?
                    </p>
                    <ul>
                        <li>
                            Allergic behaviour to anesthesia
                        </li>
                        <li>
                            Swelling in the chin region
                        </li>
                        <li>
                            Asymmetrical appearance of the chin
                        </li>
                        <li>
                            Bruising on the sides of the chin that can appear from minimal
                            to “black and blue”
                        </li>
                        <li>
                            Numbness in the lower lip and chin
                        </li>
                        <li>
                            Unappealing facial proportions after the surgery
                        </li>
                        <li>
                            Displacement of chin implant
                        </li>
                        <li>
                            Need to change the silicon chin implant of a different size
                        </li>
                        <li>
                            Scar tissues surrounding the chin implant
                        </li>
                        <li>
                            Skin discoloration
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Chin Surgery?
                    </p>
                    <p>
                        Chin surgery is an optional procedure that you undergo if you think your chin is too long,
                        broad, or projects too far from your nose.
                        The surgery in <?= ucwords($city) ?> can enhance the balance of your chin with other facial features.
                        Chin surgery is popular among men and women of almost all age groups worldwide.
                        There is however no specific age limitation for the procedure.
                        Even 15 or 16-year-old young boys and girls could opt for it
                        if they have a fully developed chin.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Chin Surgery?
                    </p>
                    <ul>
                        <li>
                            Visit your cosmetic surgeon to discuss all your apprehensions and doubts
                            about the chin surgery
                        </li>
                        <li>
                            Get all the lab tests and medical evaluations to enable the surgeon to find out
                            of your existing condition is good enough for the surgery
                        </li>
                        <li>
                            Abide by the do’s and don’ts instructed by the surgeon
                        </li>
                        <li>
                            Quit smoking and alcohol to combat the entry of toxins and carcinogens
                            into the bloodstream
                        </li>
                        <li>
                            Inform your surgeon about any of your existing medications, as he will suggest
                            making proper adjustments accordingly
                        </li>
                        <li>
                            Get some easy to wear garments in advance
                        </li>
                        <li>
                            Ask someone to accompany you to the clinic and get you back home after
                            the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Chin surgery?
                    </p>
                    <ul>
                        <li>
                            Be ready for the surgery day with the positive attitude
                        </li>
                        <li>
                            Usually, the surgeons in <?= ucwords($city) ?> perform chin surgery as an
                            outpatient treatment
                        </li>
                        <li>
                            One of the staff members will administer general or IV anesthesia
                            to make the chin area numb
                        </li>
                        <li>
                            The surgeon will make incisions with the latest technique inside your mouth
                            or under your chin
                        </li>
                        <li>
                            The incisions will be closed with the help of tapes, sutures, or skin
                            adhesives
                        </li>
                        <li>
                            The surgeon will apply facial drains to build fluid in your neck and
                            to minimize blood.
                        </li>
                        <li>
                            The doctor will remove these facial drains after a couple of days
                        </li>
                        <li>
                            It will take around an hour for the procedure to complete
                        </li>
                        <li>
                            You can go home just after around two hours from the surgery completion
                        </li>
                        <li>
                            You could expect swelling and slight discomfort
                        </li>
                        <li>
                            The chin and neck skin may appear tight because of bruising and
                            swelling
                        </li>
                        <li>
                            The surgery can help to inflict some positive changes on your face
                        </li>
                        <li>
                            Still, you should have realistic expectations with the procedure
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "cheek augmentation") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Who would not want contoured, smooth cheeks?
                        </strong>
                    </p>
                    <p>
                        Cheek augmentation surgery helps those with flat or hollow cheeks.
                        It enables you to get bigger and plump looking cheeks.
                        This surgery is also suitable for people wishing
                        to restore their appearance after
                        any accident or untoward incident.
                    </p>
                    <p>
                        Choose the most respected cosmetic surgeon in <?= ucwords($city) ?> to enhance your cheeks naturally
                        and improve your overall appearance.
                    </p>
                </div>
                <p class="identity">
                    WHY CHOOSE <?= $surgery_str ?> IN <?= ucwords($city) ?>? </p>
                <ul>
                    <li>
                        One of the most experienced facial cosmetic surgeons in <?= ucwords($city) ?>.
                    </li>
                    <li>
                        Expertise in various forms of cheek augmentation procedures like
                        fat transfer and cheek implants.
                    </li>
                    <li>
                        Skilled at helping the patients decide the best size and type of cheek
                        implants that compliments their facial features.
                    </li>
                    <li>
                        One of the top board-certified cosmetic surgeons in <?= ucwords($city) ?> and the member
                        of numerous cosmetic surgery associations in India.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> IN <?= ucwords($city) ?>
                </p>
                <p>
                    When it comes to the cost of cheek augmentation, several variables determine
                    the final amount. For instance, the type of cheek augmentation procedure,
                    the recovery medications and the cost of the cosmetic surgeon
                    play a major role.
                </p>
                <p>
                    Our cosmetic surgeon is one of the best in <?= ucwords($city) ?> for cheek augmentation.
                    Schedule a consultation session and get the advice on the next
                    action plan to increase the size and shape of your cheeks.
                </p>

                <p class="identity">OUR SERVICES</p>
                <p>
                    Attaining those dreamy, bouncy cheeks is possible now! Go for cheek augmentation
                    surgery by our expert cosmetic surgeon in <?= ucwords($city) ?> and observe
                    the difference it makes to your life!
                </p>
            </div>
        <?php } elseif ($surgery_str == "lip augmentation") {  ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Do you want to have pouty lips like Angeline Jolie? You can now fulfill your
                            wish with Lip augmentation.
                        </strong>
                    </p>
                    <p>
                        The procedure of lip augmentation involves increasing the size of your lips,
                        reshaping the contours, and making the lips naturally fuller.
                        If you are unhappy with the appearance of your lips or
                        they have become deformed due to an accident,
                        lip augmentation surgery is the best choice.
                        Our cosmetic surgeons in <?= ucwords($city) ?> have helped many to get dreamy
                        lips that look in perfect symmetry with the face.
                        You could also visit any of our experienced cosmetic surgeons,
                        and choose to enhance your lips.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Lip Augmentation in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Extremely skilled surgeons in <?= ucwords($city) ?> for lip augmentation treatment
                    </li>
                    <li>
                        Expertise in different types of lip augmentation procedures including
                        dermal fillers and lip implants
                    </li>
                    <li>
                        Highly talented at customizing the symmetry of upper and lower lips
                    </li>
                    <li>
                        Dexterous at improving the overall shape and size as per the
                        facial features
                    </li>
                    <li>
                        Renowned cosmetic surgeons certified by several national boards of
                        plastic and cosmetic surgeries.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> IN <?= ucwords($city) ?>
                </p>
                <p>
                    The lip augmentation treatment cost varies depending on whether you opt for
                    dermal fillers or lip implants. Usually,
                    lip implants are permanent and cost more than dermal
                    fillers. You can visit our cosmetic surgeon
                    in <?= ucwords($city) ?> to get the cost details
                    and treatment plans.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Let your lips capture everyone’s attention! Make them look naturally fuller,
                    beautiful, and well contoured with Lip Augmentation! Visit our reputed
                    cosmetic surgeons in <?= ucwords($city) ?> to get your desired results now.
                    Choose the best treatment from dermal fillers, fat fillers,
                    and lip implants.
                </p>

                <p class="identity">
                    FAQs on Lip Augmentation Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Lip Augmentation Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Anyone satisfying several important criteria as given below can
                            be a good candidate for Lip Augmentation in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                Thin lips
                            </li>
                            <li>
                                Lips without proper volume, shape, or volume
                            </li>
                            <li>
                                Asymmetrical or uneven lips
                            </li>
                            <li>
                                Sufficient lip tissue to hide the implant
                            </li>
                            <li>
                                Good overall health
                            </li>
                            <li>
                                Free from medical illness or any severe health condition
                            </li>
                            <li>
                                Ample fat in the donor site
                            </li>
                            <li>
                                Realistic expectations with the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Lip Augmentation Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            On average, any lip augmentation procedure in <?= ucwords($city) ?> will cost
                            around 40,000 INR - 1,00,000 INR, but it can vary depending
                            on the cosmetic surgeon and the treatment
                            along with other factors.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Lip Augmentation Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Here is a quick look at the possible risks and complications of undergoing
                            a Lip Augmentation surgery in a clinic in <?= ucwords($city) ?>.
                        </p>
                        <ul>
                            <li>
                                Allergic behaviour to anesthesia or other medicines given during
                                the surgery Redness, itching, or tenderness at
                                the incision site
                            </li>
                            <li>
                                Infection or bleeding in the treated area
                            </li>
                            <li>
                                Prolonged bruising or swelling
                            </li>
                            <li>
                                Fever blisters or cold sores around the lips
                            </li>
                            <li>
                                Lip asymmetry
                            </li>
                            <li>
                                Irregularities and lumps in the treated site
                            </li>
                            <li>
                                Possibility of scarring, ulceration, or lip stiffening
                            </li>
                            <li>
                                Loss of tissue due to injection into the blood vessel
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Lip Augmentation Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            When you notice thin lips or a decrease in the volume of your lips
                            due to growing age, this is the right time to opt for
                            Lip Augmentation surgery. Ideally, any adult of
                            18 years or more with a healthy body
                            can undergo this surgery.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Lip Augmentation Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Visit a lab to undergo the tests recommended by your surgeon
                            </li>
                            <li>
                                Avoid consuming blood-thinning medicines, as they can cause
                                significant bruising after the injection.
                            </li>
                            <li>
                                Avoid tobacco, alcohol, and caffeine around 24 hours before
                                and after the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Keep your face completely clean and free of makeup
                            </li>
                            <li>
                                Make sure to hydrate your body with water before going for the lip injection
                                to ensure a safe recovery
                            </li>
                            <li>
                                Have someone accompany you to the clinic and take you back home
                            </li>
                            <li>
                                Arrange for your clothing at home after the surgery in advance
                                to avoid later hassles
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Lip Augmentation surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                You could expect the surgeon to use various surgical and non-surgical methods
                                for lip augmentation.
                            </li>
                            <li>
                                Injecting fillers with hyaluronic acid into your lips is a common method.
                            </li>
                            <li>
                                Several doctors also perform a lip lift or a lip implant to augment
                                your lips permanently. So you could expect any of these
                                treatments depending on the condition of your lips
                            </li>
                            <li>
                                Lip augmentation surgery from a <?= ucwords($city) ?> clinic will last for around 30 minutes.
                                During this surgery, the surgeon will administer anesthesia
                                to numb your lips.
                            </li>
                            <li>
                                For lip implants, you could expect him to create a small incision in both
                                corners of your mouth before inserting a clamp via one
                                side and threading it to the other incised corner.
                                After pulling the implants through the tunnels,
                                he will stitch the incisions
                                to close them permanently
                            </li>
                            <li>
                                It is good to have realistic expectations with the surgery.
                            </li>
                            <li>
                                You could expect pain in the injection site and corners of your lips
                            </li>
                            <li>
                                The possible swelling could vanish in around 24 to 48 hours.
                                On rare occasions, it may take around a week.
                            </li>
                            <li>
                                Complete healing may take around two weeks. So if you want augmented
                                lips to flaunt at a wedding or any other special occasion,
                                schedule the surgery two weeks in advance.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Lip Augmentation Surgery?
                    </p>
                    <p>
                        Anyone satisfying several important criteria as given below can
                        be a good candidate for Lip Augmentation in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            Thin lips
                        </li>
                        <li>
                            Lips without proper volume, shape, or volume
                        </li>
                        <li>
                            Asymmetrical or uneven lips
                        </li>
                        <li>
                            Sufficient lip tissue to hide the implant
                        </li>
                        <li>
                            Good overall health
                        </li>
                        <li>
                            Free from medical illness or any severe health condition
                        </li>
                        <li>
                            Ample fat in the donor site
                        </li>
                        <li>
                            Realistic expectations with the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Lip Augmentation Surgery?
                    </p>
                    <p>
                        On average, any lip augmentation procedure in <?= ucwords($city) ?> will cost
                        around 40,000 INR - 1,00,000 INR, but it can vary depending
                        on the cosmetic surgeon and the treatment
                        along with other factors.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Lip Augmentation Surgery?
                    </p>
                    <p>
                        Here is a quick look at the possible risks and complications of undergoing
                        a Lip Augmentation surgery in a clinic in <?= ucwords($city) ?>.
                    </p>
                    <ul>
                        <li>
                            Allergic behaviour to anesthesia or other medicines given during
                            the surgery Redness, itching, or tenderness at
                            the incision site
                        </li>
                        <li>
                            Infection or bleeding in the treated area
                        </li>
                        <li>
                            Prolonged bruising or swelling
                        </li>
                        <li>
                            Fever blisters or cold sores around the lips
                        </li>
                        <li>
                            Lip asymmetry
                        </li>
                        <li>
                            Irregularities and lumps in the treated site
                        </li>
                        <li>
                            Possibility of scarring, ulceration, or lip stiffening
                        </li>
                        <li>
                            Loss of tissue due to injection into the blood vessel
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Lip Augmentation Surgery?
                    </p>
                    <p>
                        When you notice thin lips or a decrease in the volume of your lips
                        due to growing age, this is the right time to opt for
                        Lip Augmentation surgery. Ideally, any adult of
                        18 years or more with a healthy body
                        can undergo this surgery.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Lip Augmentation Surgery?
                    </p>
                    <ul>
                        <li>
                            Visit a lab to undergo the tests recommended by your surgeon
                        </li>
                        <li>
                            Avoid consuming blood-thinning medicines, as they can cause
                            significant bruising after the injection.
                        </li>
                        <li>
                            Avoid tobacco, alcohol, and caffeine around 24 hours before
                            and after the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Keep your face completely clean and free of makeup
                        </li>
                        <li>
                            Make sure to hydrate your body with water before going for the lip injection
                            to ensure a safe recovery
                        </li>
                        <li>
                            Have someone accompany you to the clinic and take you back home
                        </li>
                        <li>
                            Arrange for your clothing at home after the surgery in advance
                            to avoid later hassles
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Lip Augmentation surgery?
                    </p>
                    <ul>
                        <li>
                            You could expect the surgeon to use various surgical and non-surgical methods
                            for lip augmentation.
                        </li>
                        <li>
                            Injecting fillers with hyaluronic acid into your lips is a common method.
                        </li>
                        <li>
                            Several doctors also perform a lip lift or a lip implant to augment
                            your lips permanently. So you could expect any of these
                            treatments depending on the condition of your lips
                        </li>
                        <li>
                            Lip augmentation surgery from a <?= ucwords($city) ?> clinic will last for around 30 minutes.
                            During this surgery, the surgeon will administer anesthesia
                            to numb your lips.
                        </li>
                        <li>
                            For lip implants, you could expect him to create a small incision in both
                            corners of your mouth before inserting a clamp via one
                            side and threading it to the other incised corner.
                            After pulling the implants through the tunnels,
                            he will stitch the incisions
                            to close them permanently
                        </li>
                        <li>
                            It is good to have realistic expectations with the surgery.
                        </li>
                        <li>
                            You could expect pain in the injection site and corners of your lips
                        </li>
                        <li>
                            The possible swelling could vanish in around 24 to 48 hours.
                            On rare occasions, it may take around a week.
                        </li>
                        <li>
                            Complete healing may take around two weeks. So if you want augmented
                            lips to flaunt at a wedding or any other special occasion,
                            schedule the surgery two weeks in advance.
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "buccal fat removal") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        If you want to change the appearance of your chubby cheeks, Buccal Fat Removal
                        is the way to go. This surgery can reduce the size of your cheeks,
                        transforming them into thinner and better-contoured features.
                        Buccal Fat Removal is an extensive surgery that requires
                        attention to detail and specialized techniques.
                        It is only possible by an expert cosmetic surgeon in <?= ucwords($city) ?> who knows
                        the best treatment plan to deliver your expected results.
                        You can hence trust our surgeons to perform
                        this procedure with excellence.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Buccal Fat Removal in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Extremely talented cosmetic surgeons in <?= ucwords($city) ?> to perform
                        Buccal Fat Removal with positive results
                    </li>
                    <li>
                        Great attention to detail to ensure symmetry in both cheeks while
                        reducing their size
                    </li>
                    <li>
                        Expert in performing Buccal Fat Removal with the ability to
                        achieve no visible scarring from the incisions
                    </li>
                    <li>
                        Members of several national and international cosmetic
                        surgery boards
                    </li>
                    <li>
                        Most acclaimed cosmetic surgeon for facial procedures.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> IN <?= ucwords($city) ?>
                </p>
                <p>
                    You can get a better estimate of the cost if you visit the cosmetic surgeon
                    at the clinic in <?= ucwords($city) ?>. After examining your condition,
                    the surgeon will decide the course of treatment
                    as well as the surgery costs.
                </p>
                <p class="identity">
                    OUR SERVICES
                </p>
                <p>
                    You do not need to bother anymore if you have fat cheeks! Now, you can reduce
                    your cheeks and have a thin facial contour with Buccal Fat Removal
                    performed by any of our best cosmetic surgeons in <?= ucwords($city) ?>.
                </p>

                <p class="identity">
                    FAQs on Buccal Fat Removal Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Buccal Fat Removal?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            An ideal candidate for Buccal Fat Removal surgery
                            in <?= ucwords($city) ?> should satisfy
                            the following conditions:
                        </p>
                        <ul>
                            <li>
                                Your cheek area has excess fat
                            </li>
                            <li>
                                Your Buccal Fat pads are larger than usual
                            </li>
                            <li>
                                You have a round-shaped and fuller face
                            </li>
                            <li>
                                You want to have a slimmer and more defined facial appearance
                            </li>
                            <li>
                                You are healthy and have a stable weight
                            </li>
                            <li>
                                You are more than 50 years of age
                            </li>
                            <li>
                                You are a non-alcoholic and a non-smoker
                            </li>
                            <li>
                                The doctor has diagnosed you with the rare Parry-Romberg syndrome,
                                or the condition of progressive hemifacial atrophy.
                                It tends one portion of the facial
                                skin to shrink
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Buccal Fat Removal?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The starting cost for Buccal Fat Removal in <?= ucwords($city) ?> is around 65,000 INR,
                            which can increase depending on the location, cosmetic surgeon,
                            and the additional recovery costs. Among the other factors
                            responsible for deciding the cost may include the
                            anesthesia used, the experience of the cosmetic
                            surgeon, and prescription medication
                            for aftercare.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Buccal Fat Removal?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Wishing to undergo Buccal Fat Removal in <?= ucwords($city) ?>? Here are some
                            of the associated risks:
                        </p>
                        <ul>
                            <li>
                                Possibility of infection at the site of incision
                            </li>
                            <li>
                                Injury to the salivary duct or facial ducts
                            </li>
                            <li>
                                Reduced sensation in the treated area
                            </li>
                            <li>
                                Asymmetry in the cheeks on both the sides
                            </li>
                            <li>
                                Adverse reaction of anesthesia
                            </li>
                            <li>
                                Hematoma or clotted blood formed in the treated site
                            </li>
                            <li>
                                Bleeding in the selected area
                            </li>
                            <li>
                                Pulmonary and cardiac complications
                            </li>
                            <li>
                                Continuous pain
                            </li>
                            <li>
                                Chances of revision surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Buccal Fat Removal?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The growth of fat pads continues till one enters the twenties. Hence, surgeons
                            recommend patients of 20 years age or above to undergo Buccal Fat Removal
                            surgery in <?= ucwords($city) ?>. Most people choose this surgery because they feel
                            their fat pads are making them appear childlike.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Buccal Fat Removal Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Visit your surgeon for a candid consultation about the surgery
                        </p>
                        <ul>
                            <li>
                                Have realistic expectations with the surgery
                            </li>
                            <li>
                                Discuss your goals with the surgeon
                            </li>
                            <li>
                                Share your medical history and the existing medications with the
                                doctor so that he could adjust them accordingly
                            </li>
                            <li>
                                Undergo your medical evaluation and the lab tests suggested by the
                                surgeon
                            </li>
                            <li>
                                Avoid taking anti-inflammatory drugs, supplements, aspirin, naturopathic
                                medicines, etc., before the surgery to keep a check on bleeding at the
                                time of surgery
                            </li>
                            <li>
                                Stop drinking and consuming alcohol at least two weeks prior
                                to the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Buccal Fat Removal surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the surgery day, be prepared with a positive frame of mind
                            </li>
                            <li>
                                The surgeon or a staff member would administer anesthesia
                                to make the concerned location numb
                            </li>
                            <li>
                                You could expect the surgeon to create minor incisions inside both cheeks
                                and leave them open to drain. These incisions will close by themselves
                                within 2-3 days
                            </li>
                            <li>
                                Compared to other surgical procedures in <?= ucwords($city) ?>, Buccal Fat Removal will
                                take less time. You could expect it to complete within 30 minutes.
                            </li>
                            <li>
                                The final outcome may get hampered by swelling on your face after the procedure
                            </li>
                            <li>
                                In the end, you will observe a less chubby appearance of your cheeks
                            </li>
                            <li>
                                If the intended results remain unachieved with the first surgery in <?= ucwords($city) ?>,
                                the surgeon might recommend another procedure
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Buccal Fat Removal?
                    </p>
                    <p>
                        An ideal candidate for Buccal Fat Removal surgery
                        in <?= ucwords($city) ?> should satisfy
                        the following conditions:
                    </p>
                    <ul>
                        <li>
                            Your cheek area has excess fat
                        </li>
                        <li>
                            Your Buccal Fat pads are larger than usual
                        </li>
                        <li>
                            You have a round-shaped and fuller face
                        </li>
                        <li>
                            You want to have a slimmer and more defined facial appearance
                        </li>
                        <li>
                            You are healthy and have a stable weight
                        </li>
                        <li>
                            You are more than 50 years of age
                        </li>
                        <li>
                            You are a non-alcoholic and a non-smoker
                        </li>
                        <li>
                            The doctor has diagnosed you with the rare Parry-Romberg syndrome,
                            or the condition of progressive hemifacial atrophy.
                            It tends one portion of the facial
                            skin to shrink
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Buccal Fat Removal?
                    </p>
                    <p>
                        The starting cost for Buccal Fat Removal in <?= ucwords($city) ?> is around 65,000 INR,
                        which can increase depending on the location, cosmetic surgeon,
                        and the additional recovery costs. Among the other factors
                        responsible for deciding the cost may include the
                        anesthesia used, the experience of the cosmetic
                        surgeon, and prescription medication
                        for aftercare.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Buccal Fat Removal?
                    </p>
                    <p>
                        Wishing to undergo Buccal Fat Removal in <?= ucwords($city) ?>? Here are some
                        of the associated risks:
                    </p>
                    <ul>
                        <li>
                            Possibility of infection at the site of incision
                        </li>
                        <li>
                            Injury to the salivary duct or facial ducts
                        </li>
                        <li>
                            Reduced sensation in the treated area
                        </li>
                        <li>
                            Asymmetry in the cheeks on both the sides
                        </li>
                        <li>
                            Adverse reaction of anesthesia
                        </li>
                        <li>
                            Hematoma or clotted blood formed in the treated site
                        </li>
                        <li>
                            Bleeding in the selected area
                        </li>
                        <li>
                            Pulmonary and cardiac complications
                        </li>
                        <li>
                            Continuous pain
                        </li>
                        <li>
                            Chances of revision surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Buccal Fat Removal?
                    </p>
                    <p>
                        The growth of fat pads continues till one enters the twenties. Hence, surgeons
                        recommend patients of 20 years age or above to undergo Buccal Fat Removal
                        surgery in <?= ucwords($city) ?>. Most people choose this surgery because they feel
                        their fat pads are making them appear childlike.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Buccal Fat Removal Surgery?
                    </p>
                    <p>
                        Visit your surgeon for a candid consultation about the surgery
                    </p>
                    <ul>
                        <li>
                            Have realistic expectations with the surgery
                        </li>
                        <li>
                            Discuss your goals with the surgeon
                        </li>
                        <li>
                            Share your medical history and the existing medications with the
                            doctor so that he could adjust them accordingly
                        </li>
                        <li>
                            Undergo your medical evaluation and the lab tests suggested by the
                            surgeon
                        </li>
                        <li>
                            Avoid taking anti-inflammatory drugs, supplements, aspirin, naturopathic
                            medicines, etc., before the surgery to keep a check on bleeding at the
                            time of surgery
                        </li>
                        <li>
                            Stop drinking and consuming alcohol at least two weeks prior
                            to the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Buccal Fat Removal surgery?
                    </p>
                    <ul>
                        <li>
                            On the surgery day, be prepared with a positive frame of mind
                        </li>
                        <li>
                            The surgeon or a staff member would administer anesthesia
                            to make the concerned location numb
                        </li>
                        <li>
                            You could expect the surgeon to create minor incisions inside both cheeks
                            and leave them open to drain. These incisions will close by themselves
                            within 2-3 days
                        </li>
                        <li>
                            Compared to other surgical procedures in <?= ucwords($city) ?>, Buccal Fat Removal will
                            take less time. You could expect it to complete within 30 minutes.
                        </li>
                        <li>
                            The final outcome may get hampered by swelling on your face after the procedure
                        </li>
                        <li>
                            In the end, you will observe a less chubby appearance of your cheeks
                        </li>
                        <li>
                            If the intended results remain unachieved with the first surgery in <?= ucwords($city) ?>,
                            the surgeon might recommend another procedure
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "ear surgery") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Ear surgery or Otoplasty is a cosmetic procedure to reshape the ear.
                        This surgery addresses structural defects like an abnormally large ear,
                        disoriented ears due to accidents, ears that are unsymmetrical with
                        each other or with facial features, or protruding ears.
                        You need a highly skilled cosmetic surgeon from <?= ucwords($city) ?> to
                        treat the defects and reshape the ear to look as natural as possible.
                        This is where you can trust our surgeons.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Ear Surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Most accomplished cosmetic surgeons in <?= ucwords($city) ?> for Otoplasty.
                    </li>
                    <li>
                        Ability to analyze and surgically correct the defect with as
                        minimal possible incisions.
                    </li>
                    <li>
                        Experts in reconstructive cosmetic surgery in <?= ucwords($city) ?>
                    </li>
                    <li>
                        Members of numerous prestigious national and international boards
                        of cosmetic surgeons and reconstructive surgeries
                    </li>
                </ul>

                <p class="identity">
                    COST OF <?= $surgery_str ?> IN <?= ucwords($city) ?>
                </p>
                <p>
                    Therefore, the cost of ear surgery varies widely based on the cosmetic surgeon
                    and the intensiveness of the surgery. You can schedule a consultation with
                    the cosmetic surgeon in <?= ucwords($city) ?> to know about the course of treatment
                    and a fair estimate for the same.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Otoplasty is a detailed surgical procedure where customization holds high importance.
                    You need an experienced cosmetic surgeon who is capable of tailoring
                    the surgery to make the ears look natural.
                    The expert should also be able to achieve symmetry with both ears and ensure
                    compatibility with the face. Hence, if you are having trouble with
                    the unnatural appearance of your ears, our experienced cosmetic
                    surgeons in <?= ucwords($city) ?> can help you out.
                    They can reconstruct your ear shape and position,
                    thus making your ears look
                    as natural as possible.
                </p>
                <p class="identity">
                    FAQs on Ear Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Ear Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            To be a good candidate for Otoplasty in <?= ucwords($city) ?>, you should satisfy
                            the below points:
                        </p>
                        <ul>
                            <li>
                                You are facing hearing loss problems
                            </li>
                            <li>
                                You are suffering from any of the various congenital defects like cagot ear,
                                scroll ear, Stahl’s ear deformity, Wildermuth’s ear,
                                cleft earlobe, etc.
                            </li>
                            <li>
                                You need to correct a failed Otoplasty done earlier
                            </li>
                            <li>
                                Your ears stick out too much
                            </li>
                            <li>
                                Your ears are asymmetrical
                            </li>
                            <li>
                                You have a healthy body, free from any chronic or
                                life-threatening medical condition
                                that can obstruct healing
                            </li>
                            <li>
                                You are not expecting or breastfeeding
                            </li>
                            <li>
                                You are a non-smoker and a non-alcoholic
                            </li>
                            <li>
                                You want to have an improved appearance that has been distorted by
                                your uneven ears
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Ear Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of ear surgery in <?= ucwords($city) ?> may range from 40,000 INR to 60,000 INR.
                            Much will depend on the hospital, the choice of Surgeon,
                            the type of anesthesia used, and so on. Consulting
                            our cosmetic surgeon will help you to know
                            the exact cost of the surgery.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Ear Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Some common risks of undergoing Otoplasty include:
                        </p>
                        <ul>
                            <li>
                                Pain, bleeding, or infection
                            </li>
                            <li>
                                Adverse reaction to anesthesia
                            </li>
                            <li>
                                Asymmetry in the positioning of the ear
                            </li>
                            <li>
                                Permanent scarring
                            </li>
                            <li>
                                Allergic reaction to surgical materials
                            </li>
                            <li>
                                Reduction in skin sensation
                            </li>
                            <li>
                                Unnatural contours that will make the ear appear pinned back
                            </li>
                            <li>
                                Blocked or stuffy ear
                            </li>
                            <li>
                                Draining of bloody fluid from the incision or the ear canal
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Ear Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Once your ears attain their full size, you can undergo ear surgery.
                            Usually, the ears grow completely after the age of 5. However,
                            doctors recommend waiting till the age of 7 years to go for
                            the surgery in <?= ucwords($city) ?>. From 7 to adulthood, any age
                            is fine to undergo the procedure.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Ear Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Before you proceed with Otoplasty in a clinic in <?= ucwords($city) ?>,
                            here are some important steps to consider:
                        </p>
                        <ul>
                            <li>
                                go for lab tests or medical examination as instructed by your
                                surgeon
                            </li>
                            <li>
                                Inform your surgeon about your current medications
                            </li>
                            <li>
                                Stop tobacco and alcohol consumption around 2 weeks in advance
                            </li>
                            <li>
                                Have someone bring you back home after the surgery
                            </li>
                            <li>
                                Have a positive outlook toward the ear surgery
                            </li>
                            <li>
                                Avoid the intake of any herbal supplement, anti-inflammatory medicine,
                                or any other drugs that could increase bleeding
                            </li>
                            <li>
                                Be sure to discuss any concerns you have about the surgery with
                                your ear surgeon
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Ear surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of Otoplasty surgery in <?= ucwords($city) ?>,
                                come to the hospital with a calm
                                and prepared mind
                            </li>
                            <li>
                                One of the staff members will administer anesthesia to the selected area
                            </li>
                            <li>
                                The entire procedure may take around 2-3 hours to complete
                            </li>
                            <li>
                                The treatment will involve removing, replacing, or repairing any of the three
                                little middle ear bones (termed Ossiculoplasty)
                            </li>
                            <li>
                                After the treatment, you may have a dizzy feeling for a few days.
                            </li>
                            <li>
                                You may also expect ear pain for around a week after the surgery
                            </li>
                            <li>
                                Have realistic expectations with the surgery as it will help in
                                quick healing
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Ear Surgery?
                    </p>
                    <p>
                        To be a good candidate for Otoplasty in <?= ucwords($city) ?>, you should satisfy
                        the below points:
                    </p>
                    <ul>
                        <li>
                            You are facing hearing loss problems
                        </li>
                        <li>
                            You are suffering from any of the various congenital defects like cagot ear,
                            scroll ear, Stahl’s ear deformity, Wildermuth’s ear,
                            cleft earlobe, etc.
                        </li>
                        <li>
                            You need to correct a failed Otoplasty done earlier
                        </li>
                        <li>
                            Your ears stick out too much
                        </li>
                        <li>
                            Your ears are asymmetrical
                        </li>
                        <li>
                            You have a healthy body, free from any chronic or
                            life-threatening medical condition
                            that can obstruct healing
                        </li>
                        <li>
                            You are not expecting or breastfeeding
                        </li>
                        <li>
                            You are a non-smoker and a non-alcoholic
                        </li>
                        <li>
                            You want to have an improved appearance that has been distorted by
                            your uneven ears
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Ear Surgery?
                    </p>
                    <p>
                        The average cost of ear surgery in <?= ucwords($city) ?> may range from 40,000 INR to 60,000 INR.
                        Much will depend on the hospital, the choice of Surgeon,
                        the type of anesthesia used, and so on. Consulting
                        our cosmetic surgeon will help you to know
                        the exact cost of the surgery.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Ear Surgery?
                    </p>
                    <p>
                        Some common risks of undergoing Otoplasty include:
                    </p>
                    <ul>
                        <li>
                            Pain, bleeding, or infection
                        </li>
                        <li>
                            Adverse reaction to anesthesia
                        </li>
                        <li>
                            Asymmetry in the positioning of the ear
                        </li>
                        <li>
                            Permanent scarring
                        </li>
                        <li>
                            Allergic reaction to surgical materials
                        </li>
                        <li>
                            Reduction in skin sensation
                        </li>
                        <li>
                            Unnatural contours that will make the ear appear pinned back
                        </li>
                        <li>
                            Blocked or stuffy ear
                        </li>
                        <li>
                            Draining of bloody fluid from the incision or the ear canal
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Ear Surgery?
                    </p>
                    <p>
                        Once your ears attain their full size, you can undergo ear surgery.
                        Usually, the ears grow completely after the age of 5. However,
                        doctors recommend waiting till the age of 7 years to go for
                        the surgery in <?= ucwords($city) ?>. From 7 to adulthood, any age
                        is fine to undergo the procedure.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Ear Surgery?
                    </p>
                    <p>
                        Before you proceed with Otoplasty in a clinic in <?= ucwords($city) ?>,
                        here are some important steps to consider:
                    </p>
                    <ul>
                        <li>
                            go for lab tests or medical examination as instructed by your
                            surgeon
                        </li>
                        <li>
                            Inform your surgeon about your current medications
                        </li>
                        <li>
                            Stop tobacco and alcohol consumption around 2 weeks in advance
                        </li>
                        <li>
                            Have someone bring you back home after the surgery
                        </li>
                        <li>
                            Have a positive outlook toward the ear surgery
                        </li>
                        <li>
                            Avoid the intake of any herbal supplement, anti-inflammatory medicine,
                            or any other drugs that could increase bleeding
                        </li>
                        <li>
                            Be sure to discuss any concerns you have about the surgery with
                            your ear surgeon
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Ear surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of Otoplasty surgery in <?= ucwords($city) ?>,
                            come to the hospital with a calm
                            and prepared mind
                        </li>
                        <li>
                            One of the staff members will administer anesthesia to the selected area
                        </li>
                        <li>
                            The entire procedure may take around 2-3 hours to complete
                        </li>
                        <li>
                            The treatment will involve removing, replacing, or repairing any of the three
                            little middle ear bones (termed Ossiculoplasty)
                        </li>
                        <li>
                            After the treatment, you may have a dizzy feeling for a few days.
                        </li>
                        <li>
                            You may also expect ear pain for around a week after the surgery
                        </li>
                        <li>
                            Have realistic expectations with the surgery as it will help in
                            quick healing
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "breast augmentation") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Do you feel your breasts are smaller than usual? If yes, you can go for
                        breast augmentation surgery. Our qualified cosmetic surgeons
                        from <?= ucwords($city) ?> will help you to realize your required breast size.
                        You can achieve fuller, bigger, and rounder breasts through
                        breast augmentation.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Breast Augmentation in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Most qualified and trusted cosmetic surgeons in <?= ucwords($city) ?> to perform
                        breast augmentation surgery.
                    </li>
                    <li>
                        Highly experienced in performing breast augmentation procedures
                        through fat transfer or breast implant technique.
                    </li>
                    <li>
                        Can work with both saline-filled breast implants and silicone
                        gel-filled implants.
                    </li>
                    <li>
                        Skilled at choosing the right size of the implant and positioning
                        it at the perfect location that gives the impression
                        of naturally fuller breasts.
                    </li>
                    <li>
                        Possess the ability to perform touch-ups to maintain the size and
                        look of the breasts.
                    </li>
                    <li>
                        Certified by several prestigious national and international associations
                        for cosmetic surgeons.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    When it comes to breast augmentation, the type of material you prefer to
                    use - fat or implant - will influence the cost of the surgery.
                    It would be wise to visit the cosmetic surgeon in <?= ucwords($city) ?>
                    for a good estimate.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    You can choose from among different options for augmentation like fat transfers,
                    silicone implants or saline implants. Let one of our best cosmetic surgeons
                    in <?= ucwords($city) ?> increase your breast size and still make it look natural.
                </p>
                <p class="identity">
                    FAQs on Breast Augmentation Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Breast Augmentation?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            To be a good candidate for Breast Augmentation,
                            you should satisfy the
                            below-mentioned pointers:
                        </p>
                        <ul>
                            <li>
                                You are not an expecting mother or breastfeeding your child
                            </li>
                            <li>
                                You want to get rid of your sagging, asymmetrical, or flattened breasts
                            </li>
                            <li>
                                Your breasts lag in maintaining an adequate cleavage
                            </li>
                            <li>
                                You do not drink or smoke
                            </li>
                            <li>
                                You have realistic goals related to the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                You must be free from any severe health disorder
                            </li>
                            <li>
                                Should disclose all the medications to the surgeon
                            </li>
                            <li>
                                You are well aware of the probable risks of undergoing
                                breast augmentation in <?= ucwords($city) ?> or elsewhere
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Breast Augmentation?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Usually, the cost of a Breast Augmentation procedure in <?= ucwords($city) ?> is around
                            1,00,000 INR and the cost of the implants may go up to 1,50,000 INR,
                            or even more. Apart from these costs, the medication,
                            consultations, mammograms, and check-ups will also factor into the total
                            cost. Make sure to consult your surgeon for the exact
                            cost of the surgery.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Breast Augmentation?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Administering anesthesia could harm the body
                            </li>
                            <li>
                                Changed sensations in the breast or nipple
                            </li>
                            <li>
                                Change in the position of implants
                            </li>
                            <li>
                                Chances of rupture or leakage in the implants
                            </li>
                            <li>
                                Accumulation of fluid
                            </li>
                            <li>
                                Tight scar tissues may form close to the implant
                            </li>
                            <li>
                                Bad scars, infection, continuous breast pain
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Breast Augmentation?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Surgeons usually advise women to wait at least till they become 18 years old,
                            as by that time, their breasts are more likely to develop completely.
                            Ideally, the age for breast augmentation surgery in <?= ucwords($city) ?> or
                            for that reason, anywhere else, should be between 20s and 30s.
                            Women in this age group are likely to be most healthy, well
                            aware of their bodies, and grown enough to prepare
                            themselves mentally for the implants
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before Breast Augmentation Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                You should bear a cool and calm mind, duly prepared for the surgery in <?= ucwords($city) ?>.
                            </li>
                            <li>
                                Keep your body properly hydrated with water
                            </li>
                            <li>
                                Eat a healthy diet
                            </li>
                            <li>
                                Avoid eating or drinking anything after midnight to tolerate the
                                effect of anesthesia
                            </li>
                            <li>
                                Use an antimicrobial soap to wash your body before the surgery
                            </li>
                            <li>
                                Do not wear any jewellery or piercing when going for the surgery
                            </li>
                            <li>
                                Remove polish from your nails to enable the staff to measure
                                oxygen saturation in your blood without hassles
                            </li>
                            <li>
                                Remove dentures, contact lenses, etc. to reduce risks
                            </li>
                            <li>
                                Make sure to have someone to take you back home after your Breast Augmentation
                                Surgery in <?= ucwords($city) ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Breast Augmentation surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                You should bear a cool and calm mind, duly prepared for the
                                surgery in <?= ucwords($city) ?>.
                            </li>
                            <li>
                                Reach the hospital on time
                            </li>
                            <li>
                                The anesthetist will ask you questions about your behavior to
                                anesthesia so that he could provide
                                the right treatment accordingly
                            </li>
                            <li>
                                In the operation theater, depending on your response to the anesthetist,
                                the latter will give an IV to deliver the medicine anesthetic
                            </li>
                            <li>
                                Depending on the procedure and the specific condition of the patient,
                                the Breast augmentation surgery may take around one to two hours
                                or maybe more to complete.
                            </li>
                            <li>
                                You may feel like stretching or pulling in the breast area after the surgery
                            </li>
                            <li>
                                You will feel tired easily and be less energetic in the starting days
                            </li>
                            <li>
                                Pain may persist for around a week or two after the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                As the days pass, you will experience a positive feeling about your breasts
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Breast Augmentation?
                    </p>
                    <p>
                        To be a good candidate for Breast Augmentation,
                        you should satisfy the
                        below-mentioned pointers:
                    </p>
                    <ul>
                        <li>
                            You are not an expecting mother or breastfeeding your child
                        </li>
                        <li>
                            You want to get rid of your sagging, asymmetrical, or flattened breasts
                        </li>
                        <li>
                            Your breasts lag in maintaining an adequate cleavage
                        </li>
                        <li>
                            You do not drink or smoke
                        </li>
                        <li>
                            You have realistic goals related to the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            You must be free from any severe health disorder
                        </li>
                        <li>
                            Should disclose all the medications to the surgeon
                        </li>
                        <li>
                            You are well aware of the probable risks of undergoing
                            breast augmentation in <?= ucwords($city) ?> or elsewhere
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Breast Augmentation?
                    </p>
                    <p>
                        Usually, the cost of a Breast Augmentation procedure in <?= ucwords($city) ?> is around
                        1,00,000 INR and the cost of the implants may go up to 1,50,000 INR,
                        or even more. Apart from these costs, the medication,
                        consultations, mammograms, and check-ups will also factor into the total
                        cost. Make sure to consult your surgeon for the exact
                        cost of the surgery.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Breast Augmentation?
                    </p>
                    <ul>
                        <li>
                            Administering anesthesia could harm the body
                        </li>
                        <li>
                            Changed sensations in the breast or nipple
                        </li>
                        <li>
                            Change in the position of implants
                        </li>
                        <li>
                            Chances of rupture or leakage in the implants
                        </li>
                        <li>
                            Accumulation of fluid
                        </li>
                        <li>
                            Tight scar tissues may form close to the implant
                        </li>
                        <li>
                            Bad scars, infection, continuous breast pain
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Breast Augmentation?
                    </p>
                    <p>
                        Surgeons usually advise women to wait at least till they become 18 years old,
                        as by that time, their breasts are more likely to develop completely.
                        Ideally, the age for breast augmentation surgery in <?= ucwords($city) ?> or
                        for that reason, anywhere else, should be between 20s and 30s.
                        Women in this age group are likely to be most healthy, well
                        aware of their bodies, and grown enough to prepare
                        themselves mentally for the implants
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before Breast Augmentation Surgery?
                    </p>
                    <ul>
                        <li>
                            You should bear a cool and calm mind, duly prepared for the surgery in <?= ucwords($city) ?>.
                        </li>
                        <li>
                            Keep your body properly hydrated with water
                        </li>
                        <li>
                            Eat a healthy diet
                        </li>
                        <li>
                            Avoid eating or drinking anything after midnight to tolerate the
                            effect of anesthesia
                        </li>
                        <li>
                            Use an antimicrobial soap to wash your body before the surgery
                        </li>
                        <li>
                            Do not wear any jewellery or piercing when going for the surgery
                        </li>
                        <li>
                            Remove polish from your nails to enable the staff to measure
                            oxygen saturation in your blood without hassles
                        </li>
                        <li>
                            Remove dentures, contact lenses, etc. to reduce risks
                        </li>
                        <li>
                            Make sure to have someone to take you back home after your Breast Augmentation
                            Surgery in <?= ucwords($city) ?>
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Breast Augmentation surgery?
                    </p>
                    <ul>
                        <li>
                            You should bear a cool and calm mind, duly prepared for the
                            surgery in <?= ucwords($city) ?>.
                        </li>
                        <li>
                            Reach the hospital on time
                        </li>
                        <li>
                            The anesthetist will ask you questions about your behavior to
                            anesthesia so that he could provide
                            the right treatment accordingly
                        </li>
                        <li>
                            In the operation theater, depending on your response to the anesthetist,
                            the latter will give an IV to deliver the medicine anesthetic
                        </li>
                        <li>
                            Depending on the procedure and the specific condition of the patient,
                            the Breast augmentation surgery may take around one to two hours
                            or maybe more to complete.
                        </li>
                        <li>
                            You may feel like stretching or pulling in the breast area after the surgery
                        </li>
                        <li>
                            You will feel tired easily and be less energetic in the starting days
                        </li>
                        <li>
                            Pain may persist for around a week or two after the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            As the days pass, you will experience a positive feeling about your breasts
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "breast lift") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        If you are feeling insecure about your continuously sagging breasts,
                        a simple breast lift will be good enough to improve your complete
                        physical look. Mastopexy, also known as breast lift,
                        is a cosmetic surgery where the surgeon raises
                        the location of nipples and removes sagging
                        tissues to create an impression of tightened and fuller breasts.
                        Our cosmetic surgeons in <?= ucwords($city) ?> can deliver amazing
                        results with breast lift surgery.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Breast Lift in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Proven expertise to help patients fix the issue of sagging breasts
                    </li>
                    <li>
                        Top cosmetic surgeon in <?= ucwords($city) ?> with in-depth practical
                        knowledge of breast-related surgeries
                    </li>
                    <li>
                        Ability to customize the breast lift surgery based on just what the
                        patient wants.
                    </li>
                    <li>
                        Reputed cosmetic surgeons in <?= ucwords($city) ?> with memberships from several
                        national and international boards of cosmetic surgeries
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?></p>
                <p>
                    While the main reason for the Mastopexy is to ‘lift’ the breasts,
                    many also opt for reshaped or rounder breasts. So, if you are
                    looking for such accompanying results, the total cost of
                    the breast lift surgery will differ accordingly.
                    Our experienced cosmetic surgeons can advise
                    you better on a safer course of treatment.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Due to aging, pregnancy, or weight gain, breasts tend to sag which spoils
                    the overall appearance even when you wear the best clothes.
                    A Breast Lift surgery will help you by lifting and
                    reshaping your breasts. Our cosmetic surgeons
                    in <?= ucwords($city) ?> can help you know more about
                    Breast Lift surgery.
                </p>
                <p class="identity">
                    FAQs on Breast Lift Surgery in <?= ucwords($city) ?>
                </p>

                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Breast Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            You can be a potential candidate for Breast Lift surgery in <?= ucwords($city) ?> if:
                        </p>
                        <ul>
                            <li>
                                Your breasts are sagging significantly due to pregnancy, breastfeeding,
                                aging, or a change in weight
                            </li>
                            <li>
                                You have good overall health and maintain a stable weight
                            </li>
                            <li>
                                Your areolas and nipples are pointing downwards
                            </li>
                            <li>
                                Your breasts have become flat, pendulous, and elongated in shape
                            </li>
                            <li>
                                You have enlarged areolas and stretched skin
                            </li>
                            <li>
                                You don’t smoke or drink since both these habits can affect
                                the healing results adversely
                            </li>
                            <li>
                                You want to restore lost breast volume
                            </li>
                            <li>
                                You have realistic expectations about the surgery results
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of a Breast Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of Breast Lift surgery in <?= ucwords($city) ?> will range between
                            1,50,000 INR to 2,0,000 INR. Opting for additional procedures such
                            as Breast Implants will increase the expenditure accordingly.
                            Consultation with any of our expert cosmetic surgeons in
                            <?= ucwords($city) ?> will help you know the exact cost.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Breast Lifts?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Breast lift risks include:
                        </p>
                        <ul>
                            <li>
                                Allergic reaction to anesthesia
                            </li>
                            <li>
                                Hematoma - a pool of clotted blood formed in the treated area
                            </li>
                            <li>
                                Bleeding and infection
                            </li>
                            <li>
                                Irregularities in the breast symmetry, shape, and contour
                            </li>
                            <li>
                                Reduced sensation in the breast or nipple on a temporary basis
                            </li>
                            <li>
                                Deep vein thrombosis complications
                            </li>
                            <li>
                                Deep vein thrombosis, cardiac and pulmonary complications
                            </li>
                            <li>
                                Cardiac and pulmonary risks
                            </li>
                            <li>
                                Fat necrosis or dead fatty tissue, found deep inside the skin
                            </li>
                            <li>
                                Badly treated incisions leading to delayed healing
                            </li>
                            <li>
                                Revision breast lift surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Breast Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            There is no ideal age to go for a Breast Lift.
                            The only condition is that the breasts of a woman should be completely developed,
                            immaterial of whether she is in her teenage, 20s, or older.
                            In general, women consider this treatment mostly between the age of 18 - 25 years
                            due to several reasons, like genetics, weight changes,
                            issues related to pregnancy, and more.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before Breast Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            When going for a Breast Lift from an experienced surgeon in <?= ucwords($city) ?> keep
                            in mind to do the below things:
                        </p>
                        <ul>
                            <li>
                                Go for medical evaluation or lab testing as instructed by your surgeon
                            </li>
                            <li>
                                Consult the surgeon about your medications so that he could make
                                proper adjustments
                            </li>
                            <li>
                                A baseline mammogram would be advisable before the surgery and after the surgery.
                                It will help to find out if your breast tissue has undergone any changes
                            </li>
                            <li>
                                Stop the intake of supplements, anti-inflammatory drugs, aspirin, and any other
                                medicine that can lead to increased bleeding
                            </li>
                            <li>
                                Stop consuming alcohol and tobacco products at least 2-3 weeks before the surgery
                            </li>
                            <li>
                                Consult your surgeon about your doubts, expected results, and recovery period
                            </li>
                            <li>
                                Have realistic expectations with the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Breast Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                The procedure can last for around 1-2 hours depending on the severity
                                of the procedure.
                            </li>
                            <li>
                                The surgeon will leave you with a thin tube close to your incisions
                                to avoid swelling and drain fluid. It will be removed
                                a few days after the surgery
                            </li>
                            <li>
                                You can expect to go home the same after undergoing Mastopexy.
                            </li>
                            <li>
                                You may experience a slight discomfort around the incisions during
                                or after the surgery
                            </li>
                            <li>
                                You could also expect tight skin, bruising, or swelling temporarily
                            </li>
                            <li>
                                After the completion of Breast Lift surgery in <?= ucwords($city) ?> completes,
                                you could expect reshaped and repositioned breast tissues
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->

                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Breast Lift surgery?
                    </p>
                    <p>
                        You can be a potential candidate for Breast Lift surgery in <?= ucwords($city) ?> if:
                    </p>
                    <ul>
                        <li>
                            Your breasts are sagging significantly due to pregnancy, breastfeeding,
                            aging, or a change in weight
                        </li>
                        <li>
                            You have good overall health and maintain a stable weight
                        </li>
                        <li>
                            Your areolas and nipples are pointing downwards
                        </li>
                        <li>
                            Your breasts have become flat, pendulous, and elongated in shape
                        </li>
                        <li>
                            You have enlarged areolas and stretched skin
                        </li>
                        <li>
                            You don’t smoke or drink since both these habits can affect
                            the healing results adversely
                        </li>
                        <li>
                            You want to restore lost breast volume
                        </li>
                        <li>
                            You have realistic expectations about the surgery results
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of a Breast Lift surgery?
                    </p>
                    <p>
                        The average cost of Breast Lift surgery in <?= ucwords($city) ?> will range between
                        1,50,000 INR to 2,0,000 INR. Opting for additional procedures such
                        as Breast Implants will increase the expenditure accordingly.
                        Consultation with any of our expert cosmetic surgeons in
                        <?= ucwords($city) ?> will help you know the exact cost.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Breast Lifts?
                    </p>
                    <p>
                        Breast lift risks include:
                    </p>
                    <ul>
                        <li>
                            Allergic reaction to anesthesia
                        </li>
                        <li>
                            Hematoma - a pool of clotted blood formed in the treated area
                        </li>
                        <li>
                            Bleeding and infection
                        </li>
                        <li>
                            Irregularities in the breast symmetry, shape, and contour
                        </li>
                        <li>
                            Reduced sensation in the breast or nipple on a temporary basis
                        </li>
                        <li>
                            Deep vein thrombosis complications
                        </li>
                        <li>
                            Deep vein thrombosis, cardiac and pulmonary complications
                        </li>
                        <li>
                            Cardiac and pulmonary risks
                        </li>
                        <li>
                            Fat necrosis or dead fatty tissue, found deep inside the skin
                        </li>
                        <li>
                            Badly treated incisions leading to delayed healing
                        </li>
                        <li>
                            Revision breast lift surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Breast Lift?
                    </p>
                    <p>
                        There is no ideal age to go for a Breast Lift.
                        The only condition is that the breasts of a woman should be completely developed,
                        immaterial of whether she is in her teenage, 20s, or older.
                        In general, women consider this treatment mostly between the age of 18 - 25 years
                        due to several reasons, like genetics, weight changes,
                        issues related to pregnancy, and more.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before Breast Lift Surgery?
                    </p>
                    <p>
                        When going for a Breast Lift from an experienced surgeon in <?= ucwords($city) ?> keep
                        in mind to do the below things:
                    </p>
                    <ul>
                        <li>
                            Go for medical evaluation or lab testing as instructed by your surgeon
                        </li>
                        <li>
                            Consult the surgeon about your medications so that he could make
                            proper adjustments
                        </li>
                        <li>
                            A baseline mammogram would be advisable before the surgery and after the surgery.
                            It will help to find out if your breast tissue has undergone any changes
                        </li>
                        <li>
                            Stop the intake of supplements, anti-inflammatory drugs, aspirin, and any other
                            medicine that can lead to increased bleeding
                        </li>
                        <li>
                            Stop consuming alcohol and tobacco products at least 2-3 weeks before the surgery
                        </li>
                        <li>
                            Consult your surgeon about your doubts, expected results, and recovery period
                        </li>
                        <li>
                            Have realistic expectations with the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Breast Lift surgery?
                    </p>
                    <ul>
                        <li>
                            The procedure can last for around 1-2 hours depending on the severity
                            of the procedure.
                        </li>
                        <li>
                            The surgeon will leave you with a thin tube close to your incisions
                            to avoid swelling and drain fluid. It will be removed
                            a few days after the surgery
                        </li>
                        <li>
                            You can expect to go home the same after undergoing Mastopexy.
                        </li>
                        <li>
                            You may experience a slight discomfort around the incisions during
                            or after the surgery
                        </li>
                        <li>
                            You could also expect tight skin, bruising, or swelling temporarily
                        </li>
                        <li>
                            After the completion of Breast Lift surgery in <?= ucwords($city) ?> completes,
                            you could expect reshaped and repositioned breast tissues
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "breast reduction") {  ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Having large breasts can be a disadvantage not just to your appearance but also to
                        other health issues. If you are suffering from extreme back pain or any physical
                        troubles due to large breasts, our expert cosmetic surgeons in <?= ucwords($city) ?> can help
                        you to resolve it. So, if you wish to reduce the size of your breasts and feel at
                        ease, let us know.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Breast Reduction in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Highly adept at performing breast reduction procedures to help patients
                        relieve from physical constraints.
                    </li>
                    <li>
                        The best cosmetic surgeons in <?= ucwords($city) ?>, perfectly skilled at performing breast reduction
                        surgeries with minimal scarring.
                    </li>
                    <li>
                        Expert cosmetic surgeons certified by many national and international boards for
                        cosmetic surgeons.
                    </li>
                    <li>
                        Specialization in different types of breast reduction surgeries like Breast Reduction,
                        Vertical Breast Reduction, and inverted-T Breast Reduction
                    </li>
                    <li>
                        Expert in reshaping the breasts and repositioning the nipples to achieve
                        natural-looking breasts
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    Breast reduction surgery involves a dedicated procedure and extensive care during the
                    recovery phase. So, apart from the main cost of surgery,
                    you will also have to take care of other expenditures related to the procedure.
                    Our cosmetic surgeon in <?= ucwords($city) ?> will be able
                    to guide you better in this regard.
                </p>
                <p class="identity">
                    OUR SERVICES
                </p>
                <p>
                    Do not let those big breasts hinder your movements, leading to physical pain. Consult with
                    our best cosmetic surgeons in <?= ucwords($city) ?> and customize your breast reduction procedure
                    for a happy and comfortable tomorrow.
                </p>

                <p class="identity">
                    FAQs on Breast Reduction Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Breast Reduction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            You can be a good candidate for Breast Reduction surgery in <?= ucwords($city) ?> if you satisfy
                            the following pointers:
                        </p>
                        <ul>
                            <li>
                                You have excessively large breasts, which have started creating back,
                                neck, or shoulder pain
                            </li>
                            <li>
                                You are facing several skin conditions, rashes, and cuts in the shoulder due
                                to large breasts
                            </li>
                            <li>
                                Your large breasts are compelling you to have bad posture and are limiting your
                                physical activities
                            </li>
                            <li>
                                You have realistic expectations with the surgery
                            </li>
                            <li>
                                You don’t smoke or drink alcohol
                            </li>
                            <li>
                                You have a healthy body, which could bear the side effects of breast reduction
                                surgery with ease.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Breast Reduction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The typical cost of a breast reduction procedure is between 1,00,000 INR to 2,00,000 INR
                            depending on the scale of the surgery.
                            Anyone who has recently undergone the surgery can help you get a better idea of the
                            cost involved. Besides, consulting with your surgeon in <?= ucwords($city) ?> is always
                            advisable to know about the cost of Breast Reduction surgery.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Breast Reduction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Surgical risks like infection or bleeding
                            </li>
                            <li>
                                Fluid accumulation along the treated area
                            </li>
                            <li>
                                Swelling, bruising, or skin discoloration in the treated location
                            </li>
                            <li>
                                Breathing problems due to anesthesia
                            </li>
                            <li>
                                Allergic reaction to tape adhesive, suture materials, lotions, etc.
                            </li>
                            <li>
                                Loss of sensation in nipples and breasts for a brief or long time.
                            </li>
                            <li>
                                Uneven or asymmetrical breasts
                            </li>
                            <li>
                                Loss of nipple partially or permanently
                            </li>
                            <li>
                                Damaged nerve cells
                            </li>
                            <li>
                                Need for a revisional surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Breast Reduction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you are more than 18 years old and have your breasts developed completely,
                            this is the right time for Breast Reduction. Teenagers facing severe
                            back problems may also opt for this surgery in <?= ucwords($city) ?>.
                            Older women undergo this treatment to get rid of their
                            chronic neck pain, poor posture,
                            and other side effects of large breasts.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before Breast Reduction Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Among the many things to make up to your to-do list include:
                        </p>
                        <ul>
                            <li>
                                Undergoing Mammogram
                            </li>
                            <li>
                                Avoid smoking and drinking for at least 6 weeks before the surgery
                            </li>
                            <li>
                                Avoid taking over-the-counter drugs, anti-inflammatory drugs, herbal supplements,
                                and other medicines to curb bleeding during the treatment
                            </li>
                            <li>
                                Have someone prepared to get you back home from the hospital after the surgery
                            </li>
                            <li>
                                Make sure to take a break of a few weeks from work in advance for speedy
                                recovery after the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Breast Reduction surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                You should have realistic expectations with the surgery instead of
                                expecting miracles
                            </li>
                            <li>
                                On the day of surgery in <?= ucwords($city) ?>, the plastic surgeon will start performing the by
                                creating incisions on your large breasts
                            </li>
                            <li>
                                Before the surgery begins, you will get the required medicines to make you feel
                                at ease during the procedure
                            </li>
                            <li>
                                The surgeon will remove the concerned skin, excess fat, and glandular tissue to
                                reposition the nipple and reduce the areola
                            </li>
                            <li>
                                The results of the surgery will be visible immediately after the treatment
                            </li>
                            <li>
                                The incisions lines and post-operative swelling will subside with time
                            </li>
                            <li>
                                You will find a new you after the surgery in <?= ucwords($city) ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Breast Reduction?
                    </p>
                    <p>
                        You can be a good candidate for Breast Reduction surgery in <?= ucwords($city) ?> if you satisfy
                        the following pointers:
                    </p>
                    <ul>
                        <li>
                            You have excessively large breasts, which have started creating back,
                            neck, or shoulder pain
                        </li>
                        <li>
                            You are facing several skin conditions, rashes, and cuts in the shoulder due
                            to large breasts
                        </li>
                        <li>
                            Your large breasts are compelling you to have bad posture and are limiting your
                            physical activities
                        </li>
                        <li>
                            You have realistic expectations with the surgery
                        </li>
                        <li>
                            You don’t smoke or drink alcohol
                        </li>
                        <li>
                            You have a healthy body, which could bear the side effects of breast reduction
                            surgery with ease.
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        2. What is the cost of Breast Reduction?
                    </p>
                    <p>
                        The typical cost of a breast reduction procedure is between 1,00,000 INR to 2,00,000 INR
                        depending on the scale of the surgery.
                        Anyone who has recently undergone the surgery can help you get a better idea of the
                        cost involved. Besides, consulting with your surgeon in <?= ucwords($city) ?> is always
                        advisable to know about the cost of Breast Reduction surgery.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Breast Reduction?
                    </p>
                    <ul>
                        <li>
                            Surgical risks like infection or bleeding
                        </li>
                        <li>
                            Fluid accumulation along the treated area
                        </li>
                        <li>
                            Swelling, bruising, or skin discoloration in the treated location
                        </li>
                        <li>
                            Breathing problems due to anesthesia
                        </li>
                        <li>
                            Allergic reaction to tape adhesive, suture materials, lotions, etc.
                        </li>
                        <li>
                            Loss of sensation in nipples and breasts for a brief or long time.
                        </li>
                        <li>
                            Uneven or asymmetrical breasts
                        </li>
                        <li>
                            Loss of nipple partially or permanently
                        </li>
                        <li>
                            Damaged nerve cells
                        </li>
                        <li>
                            Need for a revisional surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Breast Reduction?
                    </p>
                    <p>
                        If you are more than 18 years old and have your breasts developed completely,
                        this is the right time for Breast Reduction. Teenagers facing severe
                        back problems may also opt for this surgery in <?= ucwords($city) ?>.
                        Older women undergo this treatment to get rid of their
                        chronic neck pain, poor posture,
                        and other side effects of large breasts.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before Breast Reduction Surgery?
                    </p>
                    <p>
                        Among the many things to make up to your to-do list include:
                    </p>
                    <ul>
                        <li>
                            Undergoing Mammogram
                        </li>
                        <li>
                            Avoid smoking and drinking for at least 6 weeks before the surgery
                        </li>
                        <li>
                            Avoid taking over-the-counter drugs, anti-inflammatory drugs, herbal supplements,
                            and other medicines to curb bleeding during the treatment
                        </li>
                        <li>
                            Have someone prepared to get you back home from the hospital after the surgery
                        </li>
                        <li>
                            Make sure to take a break of a few weeks from work in advance for speedy
                            recovery after the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Breast Reduction surgery?
                    </p>
                    <ul>
                        <li>
                            You should have realistic expectations with the surgery instead of
                            expecting miracles
                        </li>
                        <li>
                            On the day of surgery in <?= ucwords($city) ?>, the plastic surgeon will start performing the by
                            creating incisions on your large breasts
                        </li>
                        <li>
                            Before the surgery begins, you will get the required medicines to make you feel
                            at ease during the procedure
                        </li>
                        <li>
                            The surgeon will remove the concerned skin, excess fat, and glandular tissue to
                            reposition the nipple and reduce the areola
                        </li>
                        <li>
                            The results of the surgery will be visible immediately after the treatment
                        </li>
                        <li>
                            The incisions lines and post-operative swelling will subside with time
                        </li>
                        <li>
                            You will find a new you after the surgery in <?= ucwords($city) ?>
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "breast implant removal") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Surgeries for Breast implant removal in <?= ucwords($city) ?> are suitable for patients who want to
                        remove the implants due to several reasons.
                        It can be because the patient is not happy with the results or wishes to go back to
                        her previous appearance. The change in the position of the implant due to weight
                        fluctuations could also be one of the reasons in this regard. In some rare cases,
                        the implant may rupture or leak, leaving no option but to remove it.
                        One should approach only an expert and experienced cosmetic surgeon to undergo
                        this surgery.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for <?= $surgery_str ?> surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        The best cosmetic surgeon in <?= ucwords($city) ?> for all breast-related procedures.
                    </li>
                    <li>
                        Experienced in the placement and removal of breast implants.
                    </li>
                    <li>
                        A commendable history of offering the best results for patients in breast
                        surgeries in <?= ucwords($city) ?>.
                    </li>
                    <li>
                        Skilled at removing the scar tissue that forms around the implants and helps in
                        achieving fuller, rounder breasts even
                        after the removal of the implants.
                    </li>
                    <li>
                        A board-certified cosmetic surgeon and a member of several national and international
                        organizations related to cosmetic surgeries.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    In a breast implant removal surgery, the cost of the surgery differs based on the
                    cosmetic surgeon you choose and the complexity of the treatment.
                    Generally, a breast implant removal surgery
                    is from 50,000 INR to 1,00,000 INR.
                </p>
                <p>
                    If you are feeling discomfort in your breasts after placing the implants, it is vital
                    to visit a reliable cosmetic surgeon in <?= ucwords($city) ?> without any delay for
                    complete checkup. The surgeon will
                    analyze and recommend the solution.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Are you having second thoughts about your breast implants?
                    There is a way out! Choose our skilled cosmetic
                    surgeon in <?= ucwords($city) ?> to remove or fix your breast implants in the
                    way you want!
                </p>
            </div>
        <?php } elseif ($surgery_str == "breast implant revision") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Breast implants enhance the appearance and size of the breasts and complement
                        the entire figure. Unfortunately, breast implants are not permanent.
                        You need to go for breast revision surgery after a span of 10 or more
                        years when your breasts start to sag again.
                    </p>
                    <p>
                        In breast revision surgery, the cosmetic surgeon will focus on changing the
                        implants and reshaping the breasts to retain a youthful appearance.
                        The highly skilled cosmetic surgeons in <?= ucwords($city) ?> can help you better
                        in achieving natural-looking, rounder and fuller breasts.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for <?= $surgery_str ?> surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        One of the top cosmetic surgeons in <?= ucwords($city) ?> and duly experienced in
                        breast implant surgery.
                    </li>
                    <li>
                        Experienced in performing numerous breast augmentation with implants, breast implant
                        removal and breast revision surgeries.
                    </li>
                    <li>
                        Skilled at thoroughly examining the condition and offering detailed guidance in choosing
                        the new breast implants.
                    </li>
                    <li>
                        Certified by the best national and international boards of plastic and
                        cosmetic surgeries.
                    </li>
                </ul>
                <p class="identity">COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?></p>
                <p>
                    A breast revision surgery involves swapping the old implants for the new implants.
                    There can be minor complications like scar tissue removal as well as cleaning
                    up any damages or leaks. As it’s an extensive procedure, the cost of the breast
                    revision surgery starts from 1,00,000 INR. This cost can vary depending on
                    the type and size of the breast implants you choose, the condition
                    of the current implants and the cosmetic surgeon.
                    The total price is not inclusive of the medicines and other items like
                    bandages needed for recovery.
                </p>
                <p>
                    To get a good estimate for your breast revision surgery, feel free to visit
                    our expert cosmetic surgeon at the <?= ucwords($city) ?> clinic.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Is it time to replace your old breast implants? Well, get brand-new, high-quality
                    implants that make your breasts look fuller and youthful through our expert
                    surgeon in <?= ucwords($city) ?>.
                </p>
            </div>
        <?php } elseif ($surgery_str == "gynecomastia") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Due to the changes in hormonal secretion in males, the breasts of males may
                        become bigger. Gynecomastia is a male breast reduction treatment in which
                        the surgeon removes the fatty tissues from the breast area to give a
                        contoured chest. If you are suffering from similar issues, feel free
                        to consult any of our experienced cosmetic surgeons in <?= ucwords($city) ?> for
                        proper diagnosis and appropriate treatment.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Gynecomastia in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Leading cosmetic surgeons in <?= ucwords($city) ?>, having adept experience in treating Gynecomastia
                    </li>
                    <li>
                        Own expertise in performing the two main types of Gynecomastia surgeries:
                        Gynecomastia and tissue excision
                    </li>
                    <li>
                        Offer customized treatment plans to treat the male breast problem based on the age,
                        weight, and medical conditions of the patient
                    </li>
                    <li>
                        Highly accomplished surgeons in <?= ucwords($city) ?> with proven results in reducing breast size and
                        contouring the chest of men and boys
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    Several treatment options are available for Gynecomastia. While some of them need
                    medicines, others require surgery. Our cosmetic surgeons will take you through
                    the whole process and help you achieve a flat chest, as you desire.
                    Depending on these treatment options, the cost of Gynecomastia surgery will vary.
                    It is best to have an open talk with our surgeon from <?= ucwords($city) ?> about your
                    expectations and get an idea of the involved cost.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Big breasts can affect self-esteem for men. If you too have a similar problem,
                    it is wise to undergo Gynecomastia from any of our expert cosmetic surgeons
                    in <?= ucwords($city) ?>! It is a safe and the best way to have a flat chest and regain
                    your confidence.
                </p>
                <p class="identity">
                    FAQs on Gynecomastia Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Gynecomastia surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Check out the below-mentioned pointers to know if you are an ideal candidate
                            for Gynecomastia surgery in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                You have Primary Gynecomastia - You have gained male boobs at an early
                                age due to hormonal imbalance
                            </li>
                            <li>
                                You have secondary Gynecomastia – you have got male breasts due to weight
                                gain irrespective of your age group
                            </li>
                            <li>
                                You are physically fit and healthy
                            </li>
                            <li>
                                You are in your teens or twenties, due to higher skin elasticity
                                in the younger age
                            </li>
                            <li>
                                You are a non-smoker and a non-alcoholic
                            </li>
                            <li>
                                You have realistic expectations from the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Gynecomastia surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of male breast surgery in <?= ucwords($city) ?> ranges between
                            30,000 INR to 2,00,000 INR. The type of technique that the surgeon
                            uses will be a big factor in deciding the overall
                            cost of the treatment.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Gynecomastia surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Some of the common complications of Gynecomastia surgery include:
                        </p>
                        <ul>
                            <li>
                                Chances of hematoma – An instance of blood collection that occurs
                                between the muscles and the skin, mainly because
                                of bleeding after the surgery
                            </li>
                            <li>
                                Seroma, or risk of infection due to fluid collection
                            </li>
                            <li>
                                Possibility of scarring at the planned or unplanned site
                            </li>
                            <li>
                                Temporarily decrease in the nipple sensation
                            </li>
                            <li>
                                Cardiopulmonary and Venous Thrombosis issues
                            </li>
                            <li>
                                Discomfort due to an allergic reaction to anesthesia
                            </li>
                            <li>
                                Intense pain during the recovery period
                            </li>
                            <li>
                                Rare risk of damage to deeper structures
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Gynecomastia surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Most surgeons in <?= ucwords($city) ?> recommend Gynecomastia patients be at least 18 years
                            old to get ready for the surgery. At this stage,
                            the body is likely to develop to its full capacity.
                            Usually, older men are more prone to opt
                            for this surgery.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before Gynecomastia surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Restrict taking blood thinners such as aspirin, anti-inflammatory drugs as well
                                as supplements to reduce the risk of excessive blood loss
                            </li>
                            <li>
                                After speaking with the doctor, adjust taking medications accordingly
                            </li>
                            <li>
                                Undergo all the required diagnostic tests to ensure your good health
                                during the surgery
                            </li>
                            <li>
                                Stop smoking or drinking alcohol at least two weeks before the procedure
                            </li>
                            <li>
                                Adjust the medications as per the suggestion of your surgeon
                            </li>
                            <li>
                                Avoid taking supplements or medications that consist of blood thinners
                            </li>
                            <li>
                                Keep a time gap of at least 8 hours between your last meal and the surgery
                            </li>
                            <li>
                                Likewise, avoid drinking water or anything else at least 6 hours before
                                the procedure
                            </li>
                            <li>
                                Arrange for a person to help you get back home after the surgery in <?= ucwords($city) ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Gynecomastia surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of the Gynecomastia surgery, make sure to enter the clinic with
                                a positive frame of mind.
                            </li>
                            <li>
                                Expect around 1- 2 hours for the procedure to complete depending on the extent
                                of tissues required to remove
                            </li>
                            <li>
                                In several cases, a patient could also undergo liposuction in the chest
                                to deliver the best results
                            </li>
                            <li>
                                To perform the surgery, the surgeon will create small incisions in the
                                treatment area
                            </li>
                            <li>
                                After the treatment in <?= ucwords($city) ?>, you may feel sore in the first few days
                            </li>
                            <li>
                                You should have realistic expectations with the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Gynecomastia surgery?
                    </p>
                    <p>
                        Check out the below-mentioned pointers to know if you are an ideal candidate
                        for Gynecomastia surgery in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            You have Primary Gynecomastia - You have gained male boobs at an early
                            age due to hormonal imbalance
                        </li>
                        <li>
                            You have secondary Gynecomastia – you have got male breasts due to weight
                            gain irrespective of your age group
                        </li>
                        <li>
                            You are physically fit and healthy
                        </li>
                        <li>
                            You are in your teens or twenties, due to higher skin elasticity
                            in the younger age
                        </li>
                        <li>
                            You are a non-smoker and a non-alcoholic
                        </li>
                        <li>
                            You have realistic expectations from the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Gynecomastia surgery?
                    </p>
                    <p>
                        The average cost of male breast surgery in <?= ucwords($city) ?> ranges between
                        30,000 INR to 2,00,000 INR. The type of technique that the surgeon
                        uses will be a big factor in deciding the overall
                        cost of the treatment.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Gynecomastia surgery?
                    </p>
                    <p>
                        Some of the common complications of Gynecomastia surgery include:
                    </p>
                    <ul>
                        <li>
                            Chances of hematoma – An instance of blood collection that occurs
                            between the muscles and the skin, mainly because
                            of bleeding after the surgery
                        </li>
                        <li>
                            Seroma, or risk of infection due to fluid collection
                        </li>
                        <li>
                            Possibility of scarring at the planned or unplanned site
                        </li>
                        <li>
                            Temporarily decrease in the nipple sensation
                        </li>
                        <li>
                            Cardiopulmonary and Venous Thrombosis issues
                        </li>
                        <li>
                            Discomfort due to an allergic reaction to anesthesia
                        </li>
                        <li>
                            Intense pain during the recovery period
                        </li>
                        <li>
                            Rare risk of damage to deeper structures
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        4. When can you go for Gynecomastia surgery?
                    </p>
                    <p>
                        Most surgeons in <?= ucwords($city) ?> recommend Gynecomastia patients be at least 18 years
                        old to get ready for the surgery. At this stage,
                        the body is likely to develop to its full capacity.
                        Usually, older men are more prone to opt
                        for this surgery.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before Gynecomastia surgery?
                    </p>
                    <ul>
                        <li>
                            Restrict taking blood thinners such as aspirin, anti-inflammatory drugs as well
                            as supplements to reduce the risk of excessive blood loss
                        </li>
                        <li>
                            After speaking with the doctor, adjust taking medications accordingly
                        </li>
                        <li>
                            Undergo all the required diagnostic tests to ensure your good health
                            during the surgery
                        </li>
                        <li>
                            Stop smoking or drinking alcohol at least two weeks before the procedure
                        </li>
                        <li>
                            Adjust the medications as per the suggestion of your surgeon
                        </li>
                        <li>
                            Avoid taking supplements or medications that consist of blood thinners
                        </li>
                        <li>
                            Keep a time gap of at least 8 hours between your last meal and the surgery
                        </li>
                        <li>
                            Likewise, avoid drinking water or anything else at least 6 hours before
                            the procedure
                        </li>
                        <li>
                            Arrange for a person to help you get back home after the surgery in <?= ucwords($city) ?>
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Gynecomastia surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of the Gynecomastia surgery, make sure to enter the clinic with
                            a positive frame of mind.
                        </li>
                        <li>
                            Expect around 1- 2 hours for the procedure to complete depending on the extent
                            of tissues required to remove
                        </li>
                        <li>
                            In several cases, a patient could also undergo liposuction in the chest
                            to deliver the best results
                        </li>
                        <li>
                            To perform the surgery, the surgeon will create small incisions in the
                            treatment area
                        </li>
                        <li>
                            After the treatment in <?= ucwords($city) ?>, you may feel sore in the first few days
                        </li>
                        <li>
                            You should have realistic expectations with the surgery
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "liposuction") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Do you wish to have a slim physical appearance? Of course, you do!
                        </strong>
                    </p>
                    <p>
                        When diets and exercises fail us to achieve that perfect body we want,
                        liposuction would be a suitable cosmetic procedure to opt for.
                        Our renowned cosmetic surgeons from <?= ucwords($city) ?> are the best
                        to perform liposuction treatments. With years of experience
                        to back their credibility, you can count on our experts
                        to make you appear beautiful through
                        successful liposuction treatment.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Liposuction in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Highly trusted and experienced cosmetic surgeons in <?= ucwords($city) ?>, well-versed in performing various
                        types of liposuction surgeries.
                    </li>
                    <li>
                        Hold adept expertise in customizing the liposuction treatment and removing fat from particular
                        places in the patient’s body to achieve a better-looking figure.
                    </li>
                    <li>
                        Expertise in numerous liposuction procedures like tumescent liposuction, ultrasound-assisted liposuction,
                        suction-assisted liposuction, and power-assisted liposuction.
                    </li>
                    <li>
                        Own memberships of several prestigious national and international associations for plastic
                        and cosmetic surgeons.
                    </li>
                    <li>
                        Highly reputed and respected cosmetic surgeons in <?= ucwords($city) ?> who work for maximum
                        patient satisfaction.
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The cost of liposuction mainly depends on various important
                    factors:
                </p>
                <ul>
                    <li>
                        The choice of surgeon
                    </li>
                    <li>
                        The extent of fat you want to get eliminated
                    </li>
                    <li>
                        The location of fat removal
                    </li>
                    <li>
                        Additional costs such as medicines, anesthesia, surgery tools,
                        equipment, etc.
                    </li>
                </ul>
                <p>
                    By considering all these factors, the cost of liposuction surgery can go up to six figures.
                    Hence, putting forth honest efforts to find the best cosmetic is inevitable before
                    spending a sumptuous amount on the surgery.
                </p>
                <p>
                    Do you have a particular location where you need to perform the surgery? If yes,
                    then it would be wise to visit any of our expert cosmetic surgeons
                    in <?= ucwords($city) ?> and get a fair estimate.
                </p>
                <p class="identity">
                    OUR SERVICES
                </p>
                <p>
                    Get your liposuction procedure customized by one of our most reliable cosmetic surgeons
                    in <?= ucwords($city) ?> and achieve that dream figure. We will be
                    happy to serve your cause.
                </p>
                <p class="identity">
                    FAQs on Liposuction Surgery in <?= ucwords($city) ?>:
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Liposuction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            An ideal candidate for liposuction should satisfy the
                            following conditions:
                        </p>
                        <ul>
                            <li>
                                A person with near ideal body weight, but owns selected areas of localized fat
                                deposits such as hips, arms, neck, chin, arms, etc., which cease to vanish
                                via diet or exercise.
                            </li>
                            <li>
                                Other important traits include realistic expectations, good skin elasticity,
                                a healthy body, and a non-smoker.
                            </li>
                            <li>
                                The person should be willing to adhere to post-operative instructions given
                                by the surgeon for prompt healing.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Liposuction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The total cost of the liposuction procedure in <?= ucwords($city) ?> will depend on various factors
                            such as the number of areas being treated, the amount of fat being removed, the
                            complexity of the procedure, the type of facility, etc. The overall cost can vary
                            somewhere between Rs 50,000 and Rs 3,00,000 or more per treatment area. Feel free
                            to connect with our cosmetic surgeon to know the exact cost.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Liposuction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Like with any major plastic surgery in <?= ucwords($city) ?>, liposuction also accompanies several risks,
                            such as bleeding, adverse reaction to anesthesia, loss of sensation,
                            fluid accumulation, blood clits, etc. Skin irregularities like bumps,
                            wavy contours, and dimpling are also among
                            the possible risks of Liposuction.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Liposuction?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            You should go for Liposuction in <?= ucwords($city) ?> only after you prepared your mind well
                            for the procedure. Almost any age would be fine for the treatment,
                            but patients with optimum age of 30-35 years would be ideal.
                            The skin elasticity of people in this age group is better, which leads to better
                            results.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are some important things to do before Liposuction Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            It is good to prepare for the Liposuction surgery, as per the suggestions
                            from your surgeon in <?= ucwords($city) ?>. Here are some important
                            points to consider:
                        </p>
                        <ul>
                            <li>
                                Avoid smoking at least four weeks before the surgery
                            </li>
                            <li>
                                Consult your surgeon about the medicines you are already consuming and stop
                                them for a certain period as instructed
                            </li>
                            <li>
                                Keep yourself hydrated and maintain a healthy diet
                            </li>
                            <li>
                                Make sure to have someone to drive you back home after the surgery
                                and assist you in a quick recovery
                            </li>
                            <li>
                                On the day of the surgery, eat, drink, and wear as
                                suggested by your surgeon
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What should you expect on the day of liposuction surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of surgery, you could expect the surgeon to administer local or general
                                anesthesia as per the case may be.
                            </li>
                            <li>
                                The surgery time will also vary depending on the number of locations
                                that need treatment.
                            </li>
                            <li>
                                Be ready for the incisions in specific locations for fat elimination. After the procedure,
                                you should have realistic expectations.
                            </li>
                            <li>
                                Much will depend on the extent of post-operative care you adopt.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Liposuction?
                    </p>
                    <p>
                        An ideal candidate for liposuction should satisfy the
                        following conditions:
                    </p>
                    <ul>
                        <li>
                            A person with near ideal body weight, but owns selected areas of localized fat
                            deposits such as hips, arms, neck, chin, arms, etc., which cease to vanish
                            via diet or exercise.
                        </li>
                        <li>
                            Other important traits include realistic expectations, good skin elasticity,
                            a healthy body, and a non-smoker.
                        </li>
                        <li>
                            The person should be willing to adhere to post-operative instructions given
                            by the surgeon for prompt healing.
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Liposuction?
                    </p>
                    <p>
                        The total cost of the liposuction procedure in <?= ucwords($city) ?> will depend on various factors
                        such as the number of areas being treated, the amount of fat being removed, the
                        complexity of the procedure, the type of facility, etc. The overall cost can vary
                        somewhere between Rs 50,000 and Rs 3,00,000 or more per treatment area. Feel free
                        to connect with our cosmetic surgeon to know the exact cost.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Liposuction?
                    </p>
                    <p>
                        Like with any major plastic surgery in <?= ucwords($city) ?>, liposuction also accompanies several risks,
                        such as bleeding, adverse reaction to anesthesia, loss of sensation,
                        fluid accumulation, blood clits, etc. Skin irregularities like bumps,
                        wavy contours, and dimpling are also among
                        the possible risks of Liposuction.
                    </p>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Liposuction?
                    </p>
                    <p>
                        You should go for Liposuction in <?= ucwords($city) ?> only after you prepared your mind well
                        for the procedure. Almost any age would be fine for the treatment,
                        but patients with optimum age of 30-35 years would be ideal.
                        The skin elasticity of people in this age group is better, which leads to better
                        results.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are some important things to do before Liposuction Surgery?
                    </p>
                    <p>
                        It is good to prepare for the Liposuction surgery, as per the suggestions
                        from your surgeon in <?= ucwords($city) ?>. Here are some important
                        points to consider:
                    </p>
                    <ul>
                        <li>
                            Avoid smoking at least four weeks before the surgery
                        </li>
                        <li>
                            Consult your surgeon about the medicines you are already consuming and stop
                            them for a certain period as instructed
                        </li>
                        <li>
                            Keep yourself hydrated and maintain a healthy diet
                        </li>
                        <li>
                            Make sure to have someone to drive you back home after the surgery
                            and assist you in a quick recovery
                        </li>
                        <li>
                            On the day of the surgery, eat, drink, and wear as
                            suggested by your surgeon
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What should you expect on the day of liposuction surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of surgery, you could expect the surgeon to administer local or general
                            anesthesia as per the case may be.
                        </li>
                        <li>
                            The surgery time will also vary depending on the number of locations
                            that need treatment.
                        </li>
                        <li>
                            Be ready for the incisions in specific locations for fat elimination. After the procedure,
                            you should have realistic expectations.
                        </li>
                        <li>
                            Much will depend on the extent of post-operative care you adopt.
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "tummy tuck") {  ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        A Tummy tuck or Abdominoplasty is the best solution to get rid of the extra flab that messes up your appearance. Even when diets fail, do not lose heart.
                        All you need is the Tummy tuck procedure by our trusted cosmetic surgeons and you will end up flaunting a flat tummy. Our cosmetic surgeons are among the best tummy tuck experts in <?= ucwords($city) ?> to reduce your tummy size.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Tummy Tuck in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        With us, you will find the best cosmetic surgeons in <?= ucwords($city) ?>
                    </li>
                    <li>
                        Our doctors have more than a decade of experience in performing tummy tuck procedures
                    </li>
                    <li>
                        Can perform customized tummy tuck procedures as per the patient’s need
                    </li>
                    <li>
                        Efficient in delivering believable results through different tummy tuck surgeries like Mini Tummy Tuck, Full Tummy Tuck, and Extended Tummy Tuck
                    </li>
                    <li>
                        Ability to minimize the surgery scars and hide them near the abdomen
                    </li>
                    <li>
                        Renowned cosmetic surgeons from <?= ucwords($city) ?>, certified by many national and international cosmetic surgery associations
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The cost differs according to the different types of tummy tuck methods and the location of surgery. Apart from the main surgery cost, you should also consider the cost of medicines taken during the recovery period. Scans and other methods of monitoring the operated location would further add up to your bill. Make sure to visit our cosmetic surgeon in <?= ucwords($city) ?> to get a better estimate.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Get rid of extra fat in your stomach that spoils your appearance. Choose your preferred tummy tuck surgery type and rock in any costume you desire with the help of our best cosmetic surgeons in <?= ucwords($city) ?>.
                </p>
                <p class="identity">
                    FAQs on Tummy Tuck Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Tummy Tuck?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Abiding by these points will make you an ideal candidate for the Tummy
                            Tuck Surgery in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                You have good health but want to get rid of excess fat across your waist and abdomen
                            </li>
                            <li>
                                You have lost considerable weight, resulting in hanging skin and excess fat
                            </li>
                            <li>
                                Pregnancy has completely changed your body and you want to get it back in shape
                            </li>
                            <li>
                                You are not able to get away with excess fat despite exercising and having a balanced diet
                            </li>
                            <li>
                                You are a non-smoker and non-alcoholic person
                            </li>
                            <li>
                                Your body weight is within 20% of the ideal body weight
                            </li>
                            <li>
                                Your abdomen muscles have become loose
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Tummy Tuck?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            To give you an idea, the average cost of a tummy tuck procedure starts from 1,00,000 INR and can go up to 2,00,000 INR. The cost may vary depending on the surgeon you choose, the hospital, or the clinic where you decide to undergo the treatment, and several other factors. For better insight, a candid consultation with one of our Tummy Tuck surgeons in <?= ucwords($city) ?> would be a recommended move.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Tummy Tuck?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Like with any other surgery, Tummy Tuck also accompanies several risks.
                        </p>
                        <ul>
                            <li>
                                Accumulation of fluid under the skin or seroma
                            </li>
                            <li>
                                Poor healing of the areas along the line of incision
                            </li>
                            <li>
                                Visible scars, which are hard to hide
                            </li>
                            <li>
                                Repositioning of abdominal tissues during the surgery can lead to numbness or reduced sensations
                            </li>
                            <li>
                                Chance of an unavoidable revisional surgery
                            </li>
                            <li>
                                Prolonged swelling or skin discoloration
                            </li>
                            <li>
                                Unbearable pain which ceases to subside
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Tummy Tuck?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Ideally, if you do not wish to get pregnant any time soon, have a healthy body, and can maintain your results well, this is the right to go for Tummy Tuck. Women in <?= ucwords($city) ?> and other parts of the world often prefer undergoing Tummy Tuck in their 30s or 40s.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Tummy Tuck Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Your body weight should remain stable for at least 12 months before the Tummy Tuck surgery
                            </li>
                            <li>
                                If you are overweight, the surgeon will recommend you lose weight to be fit for the procedure
                            </li>
                            <li>
                                Prior to the surgery day, you should have a balanced diet including considerable proteins
                            </li>
                            <li>
                                Keep your body hydrated with water
                            </li>
                            <li>
                                Avoid using any medication without the permission of the doctor as it may lead to bleeding
                            </li>
                            <li>
                                Clear all your doubts with the surgeon before going under the knife
                            </li>
                            <li>
                                Have realistic expectations with the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Be prepared for the probable risks and side effects of the treatment
                            </li>
                            <li>
                                Ask someone to take you home once the surgery completes
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Tummy Tuck surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the surgery day in <?= ucwords($city) ?>, the anesthetic will discuss if you have any allergic reaction to anesthesia and will administer the dose accordingly
                            </li>
                            <li>
                                The entire procedure will continue for around two to three hours or more, depending on the severity of the treatment
                            </li>
                            <li>
                                The surgeon will take out your belly button by creating a small incision and suture it back into its place after the procedure
                            </li>
                            <li>
                                You might also get some antibiotics to avoid infection or painkillers to mitigate the possible pain during the surgery
                            </li>
                            <li>
                                From the first to the third day after the procedure, you will experience pressure, mild pain, and bloating
                            </li>
                            <li>
                                Your belly will become swollen and sore in the first week. To hide the swelling, you may need to put on a compression garment
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Tummy Tuck?
                    </p>
                    <p>
                        Abiding by these points will make you an ideal candidate for the Tummy
                        Tuck Surgery in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            You have good health but want to get rid of excess fat across your waist and abdomen
                        </li>
                        <li>
                            You have lost considerable weight, resulting in hanging skin and excess fat
                        </li>
                        <li>
                            Pregnancy has completely changed your body and you want to get it back in shape
                        </li>
                        <li>
                            You are not able to get away with excess fat despite exercising and having a balanced diet
                        </li>
                        <li>
                            You are a non-smoker and non-alcoholic person
                        </li>
                        <li>
                            Your body weight is within 20% of the ideal body weight
                        </li>
                        <li>
                            Your abdomen muscles have become loose
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Tummy Tuck?
                    </p>
                    <p>
                        To give you an idea, the average cost of a tummy tuck procedure starts from 1,00,000 INR and can go up to 2,00,000 INR. The cost may vary depending on the surgeon you choose, the hospital, or the clinic where you decide to undergo the treatment, and several other factors. For better insight, a candid consultation with one of our Tummy Tuck surgeons in <?= ucwords($city) ?> would be a recommended move.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Tummy Tuck?
                    </p>
                    <p>
                        Like with any other surgery, Tummy Tuck also accompanies several risks.
                    </p>
                    <ul>
                        <li>
                            Accumulation of fluid under the skin or seroma
                        </li>
                        <li>
                            Poor healing of the areas along the line of incision
                        </li>
                        <li>
                            Visible scars, which are hard to hide
                        </li>
                        <li>
                            Repositioning of abdominal tissues during the surgery can lead to numbness or reduced sensations
                        </li>
                        <li>
                            Chance of an unavoidable revisional surgery
                        </li>
                        <li>
                            Prolonged swelling or skin discoloration
                        </li>
                        <li>
                            Unbearable pain which ceases to subside
                        </li>
                    </ul>

                    <p class="cosmetic-faq-list">
                        4. When can you go for Tummy Tuck?
                    </p>
                    <p>
                        Ideally, if you do not wish to get pregnant any time soon, have a healthy body, and can maintain your results well, this is the right to go for Tummy Tuck. Women in <?= ucwords($city) ?> and other parts of the world often prefer undergoing Tummy Tuck in their 30s or 40s.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Tummy Tuck Surgery?
                    </p>
                    <ul>
                        <li>
                            Your body weight should remain stable for at least 12 months before the Tummy Tuck surgery
                        </li>
                        <li>
                            If you are overweight, the surgeon will recommend you lose weight to be fit for the procedure
                        </li>
                        <li>
                            Prior to the surgery day, you should have a balanced diet including considerable proteins
                        </li>
                        <li>
                            Keep your body hydrated with water
                        </li>
                        <li>
                            Avoid using any medication without the permission of the doctor as it may lead to bleeding
                        </li>
                        <li>
                            Clear all your doubts with the surgeon before going under the knife
                        </li>
                        <li>
                            Have realistic expectations with the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Be prepared for the probable risks and side effects of the treatment
                        </li>
                        <li>
                            Ask someone to take you home once the surgery completes
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Tummy Tuck surgery?
                    </p>
                    <ul>
                        <li>
                            On the surgery day in <?= ucwords($city) ?>, the anesthetic will discuss if you have any allergic reaction to anesthesia and will administer the dose accordingly
                        </li>
                        <li>
                            The entire procedure will continue for around two to three hours or more, depending on the severity of the treatment
                        </li>
                        <li>
                            The surgeon will take out your belly button by creating a small incision and suture it back into its place after the procedure
                        </li>
                        <li>
                            You might also get some antibiotics to avoid infection or painkillers to mitigate the possible pain during the surgery
                        </li>
                        <li>
                            From the first to the third day after the procedure, you will experience pressure, mild pain, and bloating
                        </li>
                        <li>
                            Your belly will become swollen and sore in the first week. To hide the swelling, you may need to put on a compression garment
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "buttock enhancement") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Are you not happy with your buttock size?
                        </strong>
                    </p>
                    <p>
                        Buttock enhancement is the best option to increase the size of your buttocks and complement your physical appearance. When performed by a trusted and experienced cosmetic surgeon from <?= ucwords($city) ?>, you can make your buttocks look rounded, projected, and lifted. You can even eliminate the issue of sagging breasts and make them look naturally bigger.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Buttock Enhancement in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Highly skilled cosmetic surgeons in <?= ucwords($city) ?> to perform buttock enhancement surgeries with minimal and almost invisible scarring
                    </li>
                    <li>
                        Expertise in performing Brazilian Butt Lift and enhancement using buttock implants
                    </li>
                    <li>
                        Experienced in helping patients choose the right type and size of buttock enhancement surgery
                    </li>
                    <li>
                        Adept at accomplishing symmetrical enhancements of the buttock sizes without making it look artificial
                    </li>
                    <li>
                        Certified by several national and international boards of cosmetic surgeons
                    </li>
                </ul>
                <p class="identity">
                    COST OF <?= $surgery_str ?> SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    Several types of buttock enhancement surgery include Brazilian Butt Lifts, Fat Grafting, and Buttock Implants. So depending on your preferred treatment, the cost of surgery will also differ. Apart from the cost of the surgery, you should also consider the expenses incurred in medicines, compressions, dressings, etc. To know the whole cost of buttock enhancement, you can visit any of our best cosmetic surgeons in <?= ucwords($city) ?>.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Big buttocks have a glamorous appeal and you can achieve them through buttock enhancement surgery. With one of our skilled cosmetic surgeons from <?= ucwords($city) ?> helping you every step of the day, you can safely undergo Buttock Enhancement surgery.
                </p>
                <p class="identity">
                    FAQs on Buttock Enhancement Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Buttock Enhancement?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Here are the conditions for you to be an ideal Buttock Enhancement candidate
                        </p>
                        <ul>
                            <li>
                                Your butt misses the desired size, shape, fullness, and appeal
                            </li>
                            <li>
                                You have a good overall health
                            </li>
                            <li>
                                You can tolerate the effect of anesthesia
                            </li>
                            <li>
                                Despite regular exercising and taking a balanced diet, your butts cease to increase in size
                            </li>
                            <li>
                                You should have a particular donor site having sufficient stubborn fat cells that could be transferred to your butts
                            </li>
                            <li>
                                You have realistic expectations with the Buttock Enhancement Surgery
                            </li>
                            <li>
                                You don’t smoke or drink alcohol. If you do, quit the habits at least two weeks before the surgery, as it may affect your surgery results adversely
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Buttock Enhancement?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of a Brazilian Butt Lift or a Buttock Enhancement surgery in <?= ucwords($city) ?> lies between 200000 INR to 400000 INR. Indeed, it is a big amount, but considering the expenses in other countries, the cost of this surgery in India is still much more reasonable.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Buttock Enhancement?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Irrespective of the type of Buttock Enhancement, you cannot rule out the possibility of several mild to severe risks:
                        </p>
                        <ul>
                            <li>
                                Blood clotting or hematoma
                            </li>
                            <li>
                                Fluid accumulation or seroma
                            </li>
                            <li>
                                Dead fat tissue
                            </li>
                            <li>
                                Loss of sensation on a temporary or permanent basis
                            </li>
                            <li>
                                Permanent scars and stretch marks
                            </li>
                            <li>
                                Infection and bleeding
                            </li>
                            <li>
                                Blood of fat clots that can affect your lungs or heart
                            </li>
                            <li>
                                Nerve damage
                            </li>
                            <li>
                                asymmetrical butts
                            </li>
                            <li>
                                Chances of revision surgery
                            </li>
                            <li>
                                Implant rupture or migration
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Buttock Enhancement?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you think your natural butts are too flat or squarish, you may opt for this surgery in <?= ucwords($city) ?>. In addition, if you have lost significant weight or if you believe that adding a few extra curves could balance the rest of your body, Buttock Enhancement is the right option. As per experts, 25 is the ideal age to perform this surgery, as it will give ample time for the human brain to develop completely.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Buttock Enhancement Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Here are some important points to help you ready for the Buttock Enhancement Surgery in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                Get the blood tests suggested by your surgeon to know if your body is all set for the surgery
                            </li>
                            <li>
                                Refrain from smoking or consuming alcohol for around 2-3 weeks before and after the surgery
                            </li>
                            <li>
                                Take the prescribed medicines as instructed and inform your surgeon about any existing medications to adjust accordingly
                            </li>
                            <li>
                                Putting on loose clothing is advisable
                            </li>
                            <li>
                                Prepare yourself mentally and if you have any confusion, discuss it with your surgeon for prompt resolution
                            </li>
                            <li>
                                Have realistic expectations with the surgery
                            </li>
                            <li>
                                Have someone to accompany you back home after the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Buttock Enhancement surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Come to the hospital or clinic in <?= ucwords($city) ?> for the surgery with a cool mind
                            </li>
                            <li>
                                The hospital staff will perform necessary tests to examine your health and make you ready for the surgery
                            </li>
                            <li>
                                You will be given anesthesia to make the target area numb
                            </li>
                            <li>
                                If you have allergic behavior to anesthesia, you should inform your surgeon about it
                            </li>
                            <li>
                                You could expect the surgery to take around two hours or more to complete
                            </li>
                            <li>
                                The surgeon would prescribe taking antibiotics, pain medicines, stool softener, etc. after the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                The doctor would also suggest you take rest, put less or no stress on the treated area, avoid taking a shower for around 2 days from the surgery, wear compression garments, and so on.
                            </li>
                            <li>
                                You could expect a better appearance of your rear after the healing period
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Buttock Enhancement?
                    </p>
                    <p>
                        Here are the conditions for you to be an ideal Buttock Enhancement candidate
                    </p>
                    <ul>
                        <li>
                            Your butt misses the desired size, shape, fullness, and appeal
                        </li>
                        <li>
                            You have a good overall health
                        </li>
                        <li>
                            You can tolerate the effect of anesthesia
                        </li>
                        <li>
                            Despite regular exercising and taking a balanced diet, your butts cease to increase in size
                        </li>
                        <li>
                            You should have a particular donor site having sufficient stubborn fat cells that could be transferred to your butts
                        </li>
                        <li>
                            You have realistic expectations with the Buttock Enhancement Surgery
                        </li>
                        <li>
                            You don’t smoke or drink alcohol. If you do, quit the habits at least two weeks before the surgery, as it may affect your surgery results adversely
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Buttock Enhancement?
                    </p>
                    <p>
                        The average cost of a Brazilian Butt Lift or a Buttock Enhancement surgery in <?= ucwords($city) ?> lies between 200000 INR to 400000 INR. Indeed, it is a big amount, but considering the expenses in other countries, the cost of this surgery in India is still much more reasonable.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Buttock Enhancement?
                    </p>
                    <p>
                        Irrespective of the type of Buttock Enhancement, you cannot rule out the possibility of several mild to severe risks:
                    </p>
                    <ul>
                        <li>
                            Blood clotting or hematoma
                        </li>
                        <li>
                            Fluid accumulation or seroma
                        </li>
                        <li>
                            Dead fat tissue
                        </li>
                        <li>
                            Loss of sensation on a temporary or permanent basis
                        </li>
                        <li>
                            Permanent scars and stretch marks
                        </li>
                        <li>
                            Infection and bleeding
                        </li>
                        <li>
                            Blood of fat clots that can affect your lungs or heart
                        </li>
                        <li>
                            Nerve damage
                        </li>
                        <li>
                            asymmetrical butts
                        </li>
                        <li>
                            Chances of revision surgery
                        </li>
                        <li>
                            Implant rupture or migration
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Buttock Enhancement?
                    </p>
                    <p>
                        If you think your natural butts are too flat or squarish, you may opt for this surgery in <?= ucwords($city) ?>. In addition, if you have lost significant weight or if you believe that adding a few extra curves could balance the rest of your body, Buttock Enhancement is the right option. As per experts, 25 is the ideal age to perform this surgery, as it will give ample time for the human brain to develop completely.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Buttock Enhancement Surgery?
                    </p>
                    <p>
                        Here are some important points to help you ready for the Buttock Enhancement Surgery in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            Get the blood tests suggested by your surgeon to know if your body is all set for the surgery
                        </li>
                        <li>
                            Refrain from smoking or consuming alcohol for around 2-3 weeks before and after the surgery
                        </li>
                        <li>
                            Take the prescribed medicines as instructed and inform your surgeon about any existing medications to adjust accordingly
                        </li>
                        <li>
                            Putting on loose clothing is advisable
                        </li>
                        <li>
                            Prepare yourself mentally and if you have any confusion, discuss it with your surgeon for prompt resolution
                        </li>
                        <li>
                            Have realistic expectations with the surgery
                        </li>
                        <li>
                            Have someone to accompany you back home after the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Buttock Enhancement surgery?
                    </p>
                    <ul>
                        <li>
                            Come to the hospital or clinic in <?= ucwords($city) ?> for the surgery with a cool mind
                        </li>
                        <li>
                            The hospital staff will perform necessary tests to examine your health and make you ready for the surgery
                        </li>
                        <li>
                            You will be given anesthesia to make the target area numb
                        </li>
                        <li>
                            If you have allergic behavior to anesthesia, you should inform your surgeon about it
                        </li>
                        <li>
                            You could expect the surgery to take around two hours or more to complete
                        </li>
                        <li>
                            The surgeon would prescribe taking antibiotics, pain medicines, stool softener, etc. after the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            The doctor would also suggest you take rest, put less or no stress on the treated area, avoid taking a shower for around 2 days from the surgery, wear compression garments, and so on.
                        </li>
                        <li>
                            You could expect a better appearance of your rear after the healing period
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "body lift") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Do you have stubborn body fat that does not budge even with heavy exercise?
                        </strong>
                    </p>
                    <p>
                        A Body Lift can help you to get rid of excess fat and sagging skin. There are times when some fat deposits do not disintegrate even when you diet and exercise hard. A Body Lift surgery removes or minimizes these fat deposits and tightens your skin for a well-toned body appearance. All you need is to look out for one of our best cosmetic surgeons in <?= ucwords($city) ?> to get the best treatment.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Body Lift in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        The best cosmetic surgeons in <?= ucwords($city) ?> with specialization in Body Lift
                    </li>
                    <li>
                        Expertise in understanding the patient’s requirements and helping them to achieve their body goals
                    </li>
                    <li>
                        Works on a customized treatment plan to remove the excess fat and skin
                    </li>
                    <li>
                        Skilled at whole Body Lift, lower Body Lift, and mid-Body Lift
                    </li>
                    <li>
                        Certified by several national and international boards of plastic and cosmetic surgeons
                    </li>
                </ul>
                <p class="identity">
                    COST OF BODY LIFT IN <?= ucwords($city) ?>
                </p>
                <p>
                    Since the procedure depends totally on your expectations, the areas of a Body Lift will have a significant influence on the total cost. If you are opting for a Body Lift only in the lower body, it will cost you less than the total Body Lift. You can visit our experienced cosmetic surgeons in <?= ucwords($city) ?> to seek recommendations on the best Body Lift procedure for you.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    When exercising and dieting stop working, a Body Lift could help you get a toned and better-looking body! You can get rid of the flab to tighten the skin and get a toned body at our best surgeon’s clinic in <?= ucwords($city) ?>. No wonder, you can start wearing those body-fitting clothes and flaunt your gorgeous figure once you get the right treatment.
                </p>
                <p class="identity">
                    FAQs on Body Lift Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Body Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            An ideal candidate for Body Lift in <?= ucwords($city) ?> should satisfy the following criteria:
                        </p>
                        <ul>
                            <li>
                                Looseness of soft tissue in single or several locations across the body
                            </li>
                            <li>
                                Weight loss in excess, mostly due to bariatric surgery
                            </li>
                            <li>
                                Healthy body, free of any medical ailments that could impair healing
                            </li>
                            <li>
                                A non-smoker and non-alcoholic person
                            </li>
                            <li>
                                Do not have any plans for pregnancy anytime soon
                            </li>
                            <li>
                                Living a healthy lifestyle and having a balanced meal
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of a Body Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of a Body Lift procedure in <?= ucwords($city) ?> varies from 2,00,000 INR to 3,00,000 INR. It could fluctuate depending on various factors like your weight, height, the extent of weight loss, need for liposuction, overall health condition, and so on.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Body Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Excessive scarring
                            </li>
                            <li>
                                Chances of Bleeding, eventually leading to hematoma
                            </li>
                            <li>
                                Risk of infection, fever, and red skin (cellulitis) in large portions
                            </li>
                            <li>
                                Bad healing of the wound
                            </li>
                            <li>
                                Would dehiscence or breakdown
                            </li>
                            <li>
                                Extrusion of sutures from the skin, causing irritation; needs removal
                            </li>
                            <li>
                                Loss of sensation in the treated area
                            </li>
                            <li>
                                Asymmetrical fullness, bulges, and other contour irregularities
                            </li>
                            <li>
                                Swelling and discolouration of the skin
                            </li>
                            <li>
                                Allergic reaction to anesthesia or surgery materials like tape, gloves, suture materials, etc.
                            </li>
                            <li>
                                Possibility of revisional surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Body Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            You can experience the best results from a Body Lift surgery in <?= ucwords($city) ?> only after you have gained the target weight, which remains intact for at least 6 months. Weight fluctuation can impact the surgery negatively. To opt for a Body Lift, the patient should have completed at least the age of 18.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Body Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Quit smoking and drinking alcohol at least 2 weeks before the surgery
                            </li>
                            <li>
                                Undergo medical tests and keep your medical records handy for the surgeon to check
                            </li>
                            <li>
                                Make sure to lose 30% to 50% of your maximum weight before the surgery
                            </li>
                            <li>
                                requirements
                            </li>
                            <li>
                                Bring medications and compression garments with you
                            </li>
                            <li>
                                Arrange for someone to take you back home and help you with daily chores up to a few days after the surgery
                            </li>
                            <li>
                                Avoid taking herbal supplements, aspirin, and various anti-inflammatory drugs as they can pose bleeding risks
                            </li>
                            <li>
                                keep yourself hydrated before and after the procedure in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Do not eat anything at least 8 hours before the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Body Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of surgery, visit the clinic with a calm mind
                            </li>
                            <li>
                                The anesthesia expert will inquire if you have an allergic behaviour to anesthesia and will adjust the dose accordingly
                            </li>
                            <li>
                                Depending on whether you are undergoing upper or lower Body Lift, the doctor will perform the necessary job
                            </li>
                            <li>
                                Usually, the surgery takes around 4-8 hours to complete under the influence of general anesthesia
                            </li>
                            <li>
                                Surgeons could also perform other surgeries like tummy tuck, arm lift, or arm lift in conjunction with the Body Lift procedure in <?= ucwords($city) ?>
                            </li>
                            <li>
                                You can get back to work in 2-3 weeks after the surgery and can do daily chores within 4-6 weeks
                            </li>
                            <li>
                                You could expect the surgeon to provide several instructions for a quick and satisfying recovery.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Body Lift?
                    </p>
                    <p>
                        An ideal candidate for Body Lift in <?= ucwords($city) ?> should satisfy the following criteria:
                    </p>
                    <ul>
                        <li>
                            Looseness of soft tissue in single or several locations across the body
                        </li>
                        <li>
                            Weight loss in excess, mostly due to bariatric surgery
                        </li>
                        <li>
                            Healthy body, free of any medical ailments that could impair healing
                        </li>
                        <li>
                            A non-smoker and non-alcoholic person
                        </li>
                        <li>
                            Do not have any plans for pregnancy anytime soon
                        </li>
                        <li>
                            Living a healthy lifestyle and having a balanced meal
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of a Body Lift?
                    </p>
                    <p>
                        The average cost of a Body Lift procedure in <?= ucwords($city) ?> varies from 2,00,000 INR to 3,00,000 INR. It could fluctuate depending on various factors like your weight, height, the extent of weight loss, need for liposuction, overall health condition, and so on.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Body Lift?
                    </p>
                    <ul>
                        <li>
                            Excessive scarring
                        </li>
                        <li>
                            Chances of Bleeding, eventually leading to hematoma
                        </li>
                        <li>
                            Risk of infection, fever, and red skin (cellulitis) in large portions
                        </li>
                        <li>
                            Bad healing of the wound
                        </li>
                        <li>
                            Would dehiscence or breakdown
                        </li>
                        <li>
                            Extrusion of sutures from the skin, causing irritation; needs removal
                        </li>
                        <li>
                            Loss of sensation in the treated area
                        </li>
                        <li>
                            Asymmetrical fullness, bulges, and other contour irregularities
                        </li>
                        <li>
                            Swelling and discolouration of the skin
                        </li>
                        <li>
                            Allergic reaction to anesthesia or surgery materials like tape, gloves, suture materials, etc.
                        </li>
                        <li>
                            Possibility of revisional surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Body Lift?
                    </p>
                    <p>
                        You can experience the best results from a Body Lift surgery in <?= ucwords($city) ?> only after you have gained the target weight, which remains intact for at least 6 months. Weight fluctuation can impact the surgery negatively. To opt for a Body Lift, the patient should have completed at least the age of 18.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Body Lift Surgery?
                    </p>
                    <ul>
                        <li>
                            Quit smoking and drinking alcohol at least 2 weeks before the surgery
                        </li>
                        <li>
                            Undergo medical tests and keep your medical records handy for the surgeon to check
                        </li>
                        <li>
                            Make sure to lose 30% to 50% of your maximum weight before the surgery
                        </li>
                        <li>
                            requirements
                        </li>
                        <li>
                            Bring medications and compression garments with you
                        </li>
                        <li>
                            Arrange for someone to take you back home and help you with daily chores up to a few days after the surgery
                        </li>
                        <li>
                            Avoid taking herbal supplements, aspirin, and various anti-inflammatory drugs as they can pose bleeding risks
                        </li>
                        <li>
                            keep yourself hydrated before and after the procedure in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Do not eat anything at least 8 hours before the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Body Lift surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of surgery, visit the clinic with a calm mind
                        </li>
                        <li>
                            The anesthesia expert will inquire if you have an allergic behaviour to anesthesia and will adjust the dose accordingly
                        </li>
                        <li>
                            Depending on whether you are undergoing upper or lower Body Lift, the doctor will perform the necessary job
                        </li>
                        <li>
                            Usually, the surgery takes around 4-8 hours to complete under the influence of general anesthesia
                        </li>
                        <li>
                            Surgeons could also perform other surgeries like tummy tuck, arm lift, or arm lift in conjunction with the Body Lift procedure in <?= ucwords($city) ?>
                        </li>
                        <li>
                            You can get back to work in 2-3 weeks after the surgery and can do daily chores within 4-6 weeks
                        </li>
                        <li>
                            You could expect the surgeon to provide several instructions for a quick and satisfying recovery.
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "arm lift") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Love to have better-looking, toned arms?
                        </strong>
                    </p>
                    <p>
                        Arm Lift Surgery or Brachioplasty is the procedure to treat drooping upper arms resulting due to ageing or massive weight loss. It requires the surgeon to remove the excess sagging skin of the upper arm resulting in well-toned and tightened arms.
                    </p>
                    <p>
                        Our reputed cosmetic surgeons in <?= ucwords($city) ?> advise the right treatment plan and the best-suited procedure for you.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Arm Lift Surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        The best cosmetic surgeons in <?= ucwords($city) ?> to treat patients with extremely sagging upper arms
                    </li>
                    <li>
                        Highly skilled at various arm lift surgeries like Liposuction, Limited Arm Lift, Standard Arm Lift, and Extended Arm Lift.
                    </li>
                    <li>
                        Adept at customizing the treatment and toning the upper arms that are symmetrical with the body
                    </li>
                    <li>
                        Leave only minimal scarring that becomes almost invisible over time.
                    </li>
                    <li>
                        Renowned cosmetic surgeons from <?= ucwords($city) ?>, duly certified by several national boards of cosmetic surgeries
                    </li>
                </ul>
                <p class="identity">
                    COST OF ARM LIFT SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The Arm Lift Surgery cost depends largely on the cosmetic surgeon you choose and the specific area where you want to tone it. Usually, the cost of extended Arm Lift Surgery is higher than other surgeries since the surgeon not just removes the excess skin on the upper arms but also on the sides of the body. It is best to visit our reliable cosmetic surgeon in <?= ucwords($city) ?> and seek advice on the best course of action.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Are you feeling uncomfortable due to the excess skin on your upper arms? Are you finding it hard to tone down your excess skin through exercise? If yes then, you can always opt for Arm Lift Surgery by any of our experienced surgeons in <?= ucwords($city) ?>.
                </p>
                <p class="identity">
                    FAQs on Arm Lift Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Arm Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Abiding by the following points will make you a suitable candidate for Arm Lift Surgery in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                You are an adult having considerable laxity in the upper arm skin
                            </li>
                            <li>
                                You have lost weight significantly, which has caused loose hanging skin
                            </li>
                            <li>
                                You are an adult with a stable weight irrespective of your age
                            </li>
                            <li>
                                You are not overweight
                            </li>
                            <li>
                                You are a healthy person with no medical problem that could affect healing or enhance surgery risks
                            </li>
                            <li>
                                You don’t smoke or drink alcohol
                            </li>
                            <li>
                                You can maintain a healthy lifestyle with a proper diet
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Arm Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of Arm Lift surgery in <?= ucwords($city) ?> may be in the range of 1,00,000 INR to 1,50,000 INR. Much will depend on the facilities the patient has opted for. This cost for consultation, medicine costs, and other external support needed for recovery will be additional.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Arm Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Asymmetry in the appearance of arms
                            </li>
                            <li>
                                Excessive or unusual scarring
                            </li>
                            <li>
                                Persistent bleeding
                            </li>
                            <li>
                                Damage to the blood vessel, nerves, or muscles
                            </li>
                            <li>
                                Infection in the surgical site
                            </li>
                            <li>
                                Arm stiffness
                            </li>
                            <li>
                                Seroma or accumulation of fluids in the arm, which can be drained with the help of a needle
                            </li>
                            <li>
                                Breakdown of the wound, which will require 2-3 additional weeks to heal
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Arm Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you are experiencing age-related changes in your arms or loose skin due to excessive weight loss, Arm Lift surgery in <?= ucwords($city) ?> could be a suitable choice to deal with your arm laxity condition. Winter is the best time to undergo this surgery. All you need is to be an adult to opt for the Arm Lift procedure in <?= ucwords($city) ?>.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Arm Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Consult your surgeon about the concerns related to Arm Lift
                            </li>
                            <li>
                                Stop eating and drinking at least 8 hours before the procedure
                            </li>
                            <li>
                                Arrange for loose and comfortable clothing at home in advance
                            </li>
                            <li>
                                Go for a medical exam to ensure your health is perfect before the surgery
                            </li>
                            <li>
                                Stop smoking several weeks earlier to avoid slow wound healing due to smoking-related health hassles
                            </li>
                            <li>
                                Adjust your existing medications after consultation with the doctor
                            </li>
                            <li>
                                Avoid the consumption of aspirin, anti-inflammatory drugs, or health supplements as they can result in excessive bleeding
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Arm Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Cooperate with the staff at the clinic in executing the necessary formalities
                            </li>
                            <li>
                                The anesthesia expert may ask you about your behaviour toward anesthesia and administer the dose accordingly
                            </li>
                            <li>
                                The surgeon in <?= ucwords($city) ?> may take around 3-4 hours to complete Brachioplasty. Due to the effect of anesthesia, you may not realize the lapse in time.
                            </li>
                            <li>
                                You will get incisions on the back or inside your arm depending on the choice of surgeon. Next, the excision of excess fat will take place via Liposuction
                            </li>
                            <li>
                                You may get back to work after the surgery in <?= ucwords($city) ?> within just a week if you have a sedentary job, but if it demands too much physical exertion, the surgeon would recommend resting for around two weeks after the surgery
                            </li>
                            <li>
                                You should have realistic goals in your mind regarding the surgery.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Arm Lift Surgery?
                    </p>
                    <p>
                        Abiding by the following points will make you a suitable candidate for Arm Lift Surgery in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            You are an adult having considerable laxity in the upper arm skin
                        </li>
                        <li>
                            You have lost weight significantly, which has caused loose hanging skin
                        </li>
                        <li>
                            You are an adult with a stable weight irrespective of your age
                        </li>
                        <li>
                            You are not overweight
                        </li>
                        <li>
                            You are a healthy person with no medical problem that could affect healing or enhance surgery risks
                        </li>
                        <li>
                            You don’t smoke or drink alcohol
                        </li>
                        <li>
                            You can maintain a healthy lifestyle with a proper diet
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of Arm Lift Surgery?
                    </p>
                    <p>
                        The average cost of Arm Lift surgery in <?= ucwords($city) ?> may be in the range of 1,00,000 INR to 1,50,000 INR. Much will depend on the facilities the patient has opted for. This cost for consultation, medicine costs, and other external support needed for recovery will be additional.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Arm Lift Surgery?
                    </p>
                    <ul>
                        <li>
                            Asymmetry in the appearance of arms
                        </li>
                        <li>
                            Excessive or unusual scarring
                        </li>
                        <li>
                            Persistent bleeding
                        </li>
                        <li>
                            Damage to the blood vessel, nerves, or muscles
                        </li>
                        <li>
                            Infection in the surgical site
                        </li>
                        <li>
                            Arm stiffness
                        </li>
                        <li>
                            Seroma or accumulation of fluids in the arm, which can be drained with the help of a needle
                        </li>
                        <li>
                            Breakdown of the wound, which will require 2-3 additional weeks to heal
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Arm Lift Surgery?
                    </p>
                    <p>
                        If you are experiencing age-related changes in your arms or loose skin due to excessive weight loss, Arm Lift surgery in <?= ucwords($city) ?> could be a suitable choice to deal with your arm laxity condition. Winter is the best time to undergo this surgery. All you need is to be an adult to opt for the Arm Lift procedure in <?= ucwords($city) ?>.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Arm Lift surgery?
                    </p>
                    <ul>
                        <li>
                            Consult your surgeon about the concerns related to Arm Lift
                        </li>
                        <li>
                            Stop eating and drinking at least 8 hours before the procedure
                        </li>
                        <li>
                            Arrange for loose and comfortable clothing at home in advance
                        </li>
                        <li>
                            Go for a medical exam to ensure your health is perfect before the surgery
                        </li>
                        <li>
                            Stop smoking several weeks earlier to avoid slow wound healing due to smoking-related health hassles
                        </li>
                        <li>
                            Adjust your existing medications after consultation with the doctor
                        </li>
                        <li>
                            Avoid the consumption of aspirin, anti-inflammatory drugs, or health supplements as they can result in excessive bleeding
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Arm Lift surgery?
                    </p>
                    <ul>
                        <li>
                            Cooperate with the staff at the clinic in executing the necessary formalities
                        </li>
                        <li>
                            The anesthesia expert may ask you about your behaviour toward anesthesia and administer the dose accordingly
                        </li>
                        <li>
                            The surgeon in <?= ucwords($city) ?> may take around 3-4 hours to complete Brachioplasty. Due to the effect of anesthesia, you may not realize the lapse in time.
                        </li>
                        <li>
                            You will get incisions on the back or inside your arm depending on the choice of surgeon. Next, the excision of excess fat will take place via Liposuction
                        </li>
                        <li>
                            You may get back to work after the surgery in <?= ucwords($city) ?> within just a week if you have a sedentary job, but if it demands too much physical exertion, the surgeon would recommend resting for around two weeks after the surgery
                        </li>
                        <li>
                            You should have realistic goals in your mind regarding the surgery.
                        </li>
                    </ul> -->

            </div>
        <?php } elseif ($surgery_str == "thigh lift") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        If dieting and exercising are not helping anymore in reducing your thigh size, a Thigh Lift can be a suitable alternative. The surgery reshapes the thigh by removing the extra tissues that would otherwise make you look flabby. It will also contour your body in proportion to the rest of your body figure.
                    </p>
                    <p>
                        Some prefer to go for a combination of Liposuction and Thigh Lift to complement the body structure. For any more doubts about this surgery, you can visit any of our recommended cosmetic surgeons in <?= ucwords($city) ?>.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Thigh Lift in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Best cosmetic surgeons in <?= ucwords($city) ?> with credible experience in Thigh Lift as well as other body contouring procedures
                    </li>
                    <li>
                        Overwhelming testimonials from satisfied patients about the positive surgery results
                    </li>
                    <li>
                        Operate patients in fully-equipped clinics for plastic, cosmetic, and reconstructive surgeries.
                    </li>
                    <li>
                        Top cosmetic surgeons in <?= ucwords($city) ?> certified by the national associations for plastic and cosmetic surgeries
                    </li>
                </ul>
                <p class="identity">
                    COST OF THIGH LIFT IN <?= ucwords($city) ?>
                </p>
                <p>
                    It would be wise to consult with any of our cosmetic surgeons in <?= ucwords($city) ?> about the cost of this treatment. This will also give you a better insight into the results you can expect as well as about the recovery period.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Do not let those flabby thighs get the best of you! Go for a Thigh Lift, recover your lost shape, and look fab! Opt for one of our most-respected cosmetic surgeons in <?= ucwords($city) ?> to perform the Thigh Lift surgery.
                </p>
                <p class="identity">
                    FAQs on Thigh Lift Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Thigh Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            People in <?= ucwords($city) ?> wishing to be a Thigh Lift candidate need to satisfy the following conditions:
                        </p>
                        <ul>
                            <li>
                                Have a relatively stable weight
                            </li>
                            <li>
                                Extra soft tissue along the inner thigh or the outer thigh
                            </li>
                            <li>
                                Good health overall
                            </li>
                            <li>
                                No medical condition that could impair healing or increase risks
                            </li>
                            <li>
                                Healthy diet
                            </li>
                            <li>
                                Routine of regular exercise
                            </li>
                            <li>
                                Non-smoker and non-alcoholic
                            </li>
                            <li>
                                Wish to improve the appearance of thighs
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of a Thigh Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The cost of a Thigh Lift surgery in <?= ucwords($city) ?> may vary between 70,000 INR-1,50,000 INR. Several factors can have an impact on the cost of Thigh Lift surgery. These may include the price of the surgical facilities, the complexity faced during the surgery, the experience of the surgeon, the cost of anesthesia and medicines, and so on.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Thigh Lifts?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Allergic reaction to anesthesia
                            </li>
                            <li>
                                Infection and bleeding in the incision site
                            </li>
                            <li>
                                Chances of scarring
                            </li>
                            <li>
                                Pain in rare instances after the effect of anesthesia subsides
                            </li>
                            <li>
                                Formation of blood clots in the legs, leading to Deep Vein Thrombosis or DVT
                            </li>
                            <li>
                                Formation of seroma or blood accumulation in a dead space after the surgery
                            </li>
                            <li>
                                Dead fatty tissue beneath the skin or fat necrosis
                            </li>
                            <li>
                                Bruising and swelling in the incision site
                            </li>
                            <li>
                                Need for a correction surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for a Thigh Lift?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you want to get smoother skin and well-proportioned contours on your thighs, a Thigh Lift is the best option. Anyone who is more than 18 years old and has a disease-free body can go for Thigh Lift in <?= ucwords($city) ?>.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before the Thigh Lift Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Get your medical evaluation and complete body check-up before the surgery
                            </li>
                            <li>
                                Avoid consuming anti-inflammatory drugs, health supplements, or Aspirin to avoid an increase in bleeding
                            </li>
                            <li>
                                Show the medication lists to the surgeon you are currently taking to avert confusion
                            </li>
                            <li>
                                Take off contact lenses, nail polish, makeup, and deodorant
                            </li>
                            <li>
                                Avoid
                            </li>
                            <li>
                                Keep yourself hydrated with water at least 2 weeks before the surgery in <?= ucwords($city) ?>
                            </li>
                            <li>
                                Avoid eating or drinking around 8 hours before the surgery.
                            </li>
                            <li>
                                Quit smoking or alcohol consumption to avoid any complications during or after the surgery
                            </li>
                            <li>
                                Arrange for someone to help you in the hospital, drive you home and assist in your daily chores after the surgery.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Thigh Lift surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Visit the clinic or hospital with a cool and composed mind
                            </li>
                            <li>
                                Discuss your concerns with the <?= ucwords($city) ?> surgeon in a candid direct consultation
                            </li>
                            <li>
                                The anesthesiologist would ask about your reaction to anesthesia and will administer the dose accordingly
                            </li>
                            <li>
                                You could expect the surgeon to make an incision and remove the fat and excess skin from the incision site
                            </li>
                            <li>
                                As a result of the successful surgery, you could expect tight skin, enhanced leg contour, and better skin elasticity
                            </li>
                            <li>
                                The entire procedure will complete in around 2-3 hours
                            </li>
                            <li>
                                Depending on your response to the Thigh Lift, you may have to stay in the hospital for a few days, or as recommended by your surgeon in <?= ucwords($city) ?>
                            </li>
                            <li>
                                You can expect around 4-6 weeks from the day of the Thigh Lift surgery to heal completely
                            </li>
                            <li>
                                The surgeon could advise you to restrict your daily activities for around 2 weeks and avoid strenuous activities for at least 2 weeks
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Thigh Lift?
                    </p>
                    <p>
                        People in <?= ucwords($city) ?> wishing to be a Thigh Lift candidate need to satisfy the following conditions:
                    </p>
                    <ul>
                        <li>
                            Have a relatively stable weight
                        </li>
                        <li>
                            Extra soft tissue along the inner thigh or the outer thigh
                        </li>
                        <li>
                            Good health overall
                        </li>
                        <li>
                            No medical condition that could impair healing or increase risks
                        </li>
                        <li>
                            Healthy diet
                        </li>
                        <li>
                            Routine of regular exercise
                        </li>
                        <li>
                            Non-smoker and non-alcoholic
                        </li>
                        <li>
                            Wish to improve the appearance of thighs
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of a Thigh Lift?
                    </p>
                    <p>
                        The cost of a Thigh Lift surgery in <?= ucwords($city) ?> may vary between 70,000 INR-1,50,000 INR. Several factors can have an impact on the cost of Thigh Lift surgery. These may include the price of the surgical facilities, the complexity faced during the surgery, the experience of the surgeon, the cost of anesthesia and medicines, and so on.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Thigh Lifts?
                    </p>
                    <ul>
                        <li>
                            Allergic reaction to anesthesia
                        </li>
                        <li>
                            Infection and bleeding in the incision site
                        </li>
                        <li>
                            Chances of scarring
                        </li>
                        <li>
                            Pain in rare instances after the effect of anesthesia subsides
                        </li>
                        <li>
                            Formation of blood clots in the legs, leading to Deep Vein Thrombosis or DVT
                        </li>
                        <li>
                            Formation of seroma or blood accumulation in a dead space after the surgery
                        </li>
                        <li>
                            Dead fatty tissue beneath the skin or fat necrosis
                        </li>
                        <li>
                            Bruising and swelling in the incision site
                        </li>
                        <li>
                            Need for a correction surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for a Thigh Lift?
                    </p>
                    <p>
                        If you want to get smoother skin and well-proportioned contours on your thighs, a Thigh Lift is the best option. Anyone who is more than 18 years old and has a disease-free body can go for Thigh Lift in <?= ucwords($city) ?>.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before the Thigh Lift Surgery?
                    </p>
                    <ul>
                        <li>
                            Get your medical evaluation and complete body check-up before the surgery
                        </li>
                        <li>
                            Avoid consuming anti-inflammatory drugs, health supplements, or Aspirin to avoid an increase in bleeding
                        </li>
                        <li>
                            Show the medication lists to the surgeon you are currently taking to avert confusion
                        </li>
                        <li>
                            Take off contact lenses, nail polish, makeup, and deodorant
                        </li>
                        <li>
                            Avoid
                        </li>
                        <li>
                            Keep yourself hydrated with water at least 2 weeks before the surgery in <?= ucwords($city) ?>
                        </li>
                        <li>
                            Avoid eating or drinking around 8 hours before the surgery.
                        </li>
                        <li>
                            Quit smoking or alcohol consumption to avoid any complications during or after the surgery
                        </li>
                        <li>
                            Arrange for someone to help you in the hospital, drive you home and assist in your daily chores after the surgery.
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Thigh Lift surgery?
                    </p>
                    <ul>
                        <li>
                            Visit the clinic or hospital with a cool and composed mind
                        </li>
                        <li>
                            Discuss your concerns with the <?= ucwords($city) ?> surgeon in a candid direct consultation
                        </li>
                        <li>
                            The anesthesiologist would ask about your reaction to anesthesia and will administer the dose accordingly
                        </li>
                        <li>
                            You could expect the surgeon to make an incision and remove the fat and excess skin from the incision site
                        </li>
                        <li>
                            As a result of the successful surgery, you could expect tight skin, enhanced leg contour, and better skin elasticity
                        </li>
                        <li>
                            The entire procedure will complete in around 2-3 hours
                        </li>
                        <li>
                            Depending on your response to the Thigh Lift, you may have to stay in the hospital for a few days, or as recommended by your surgeon in <?= ucwords($city) ?>
                        </li>
                        <li>
                            You can expect around 4-6 weeks from the day of the Thigh Lift surgery to heal completely
                        </li>
                        <li>
                            The surgeon could advise you to restrict your daily activities for around 2 weeks and avoid strenuous activities for at least 2 weeks
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "body contouring") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Sometimes, you may still have excess skin after extensive weight loss. This happens when your skin loses its elasticity. Body contouring procedure helps to remove these excess skin and fat. You will have a well-toned and lean looking figure after undergoing the whole body contouring surgery.
                    </p>
                    <p>
                        Since body contouring in an extensive procedure, it is vital to get it done by an experienced cosmetic surgeon in <?= ucwords($city) ?>.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for <?= $surgery_str ?> in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        The most skilled cosmetic surgeon in <?= ucwords($city) ?> for body contouring.
                    </li>
                    <li>
                        Highly experienced in individual procedures that make up the body contouring like tummy tuck, breast lift, arm lift, buttock lift, thigh lift and lower body lift.
                    </li>
                    <li>
                        Performs highly specific and customized body-contouring surgery targeted at removing the excess skin that results in well-contoured appearance.
                    </li>
                    <li>
                        <?= ucwords($city) ?>’s experienced cosmetic surgeon, certified by several national and international boards of cosmetic surgeries.
                    </li>
                </ul>
                <p class="identity">
                    COST OF BODY CONTOURING SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    The body contouring procedure should be highly customized to treat the specific areas of the body that are disrupting the figure. The total cost of the procedure varies from 1,00,000 INR to 3,00,000 INR depending on the different areas of treatment. Visiting an expert cosmetic surgeon would be wise to get the recommendations for the customized body contouring treatment.
                </p>
                <p>
                    Our cosmetic surgeon is one of the best in this field in <?= ucwords($city) ?>. You can schedule a consultation session to get a good ballpark on the cost of this surgery along with other necessary details.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Transform your appearance in a single body contouring surgery. Get rid of that excess flab of skin from all over your body to get a well-toned and youthful skin with <?= ucwords($city) ?>’s best surgeon by your side.
                </p>
            </div>
        <?php } elseif ($surgery_str == "mommy makeover") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Mommy makeover surgery aims specifically at helping women get back their slim body after childbirth. A woman’s body goes through significant changes during and after pregnancy. For many, it can be difficult and almost impossible to get back to the previous shape they were in. This is where mommy makeover surgery is beneficial. Our cosmetic surgeon from <?= ucwords($city) ?> will inspect the entire body and make changes to breasts, buttocks, thighs, tummy and other locations where the size has increased.
                    </p>
                </div>
                <p class="identity">
                    WHY CHOOSE MOMMY MAKEOVER SURGERY IN <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        One of the best cosmetic surgeons in <?= ucwords($city) ?> who offers astonishing results with a wholesome mommy makeover surgery.
                    </li>
                    <li>
                        Customized surgery plans aimed at reducing the fat at specific areas of the mother’s body.
                    </li>
                    <li>
                        Skilled at transforming the patients’ back to their old, thinner self.
                    </li>
                    <li>
                        A reliable cosmetic surgeon with a clinic in <?= ucwords($city) ?> offering personalized treatment and medicines by considering the recent childbirth.
                    </li>
                    <li>
                        An esteemed cosmetic surgeon and a member of several national and international boards for cosmetic surgery.
                    </li>
                </ul>
                <p class="identity">
                    COST OF MOMMY MAKEOVER SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    In the mommy makeover surgery, the cosmetic surgeon performs several surgeries like liposuction, breast lift, breast reduction, buttock augmentation/reduction, tummy tuck, etc. Therefore, the cost of mommy makeover surgery will vary according to the recommended surgeries. If you are considering mommy makeover surgery, you can consult our cosmetic surgeon in <?= ucwords($city) ?> to get an estimate of the complete treatment plan.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Revamp your entire body and get rid of the fat to look slim and fabulous! Choose the customized mommy makeover treatments in <?= ucwords($city) ?> with breast lift, liposuction, tummy tuck, labiaplasty, facial rejuvenation, and other body contouring surgeries.
                </p>
            </div>
        <?php } elseif ($surgery_str == "hair transplant") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        <strong>
                            Are you losing confidence because of thinning or balding hair?
                        </strong>
                    </p>
                    <p>
                        Not anymore! Get the best cosmetic surgeon in <?= ucwords($city) ?> known for the skilled hair transplant treatment to help you regain your confidence. Through hair transplantation surgery, the surgeon will extract hair grafts or follicles from your scalp, treat them and place it in the thinning areas. It is best for patients suffering from acute hair fall, balding hall, thinned-out hair, alopecia, or any other similar condition.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Cosmetic Surgeons for Hair Transplant in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Top cosmetic surgeons for hair transplantation in <?= ucwords($city) ?> with a high success rate
                    </li>
                    <li>
                        Adept at performing the widely acclaimed hair transplant treatments - Follicular Unit Extraction (FUE) and Follicular Unit Transplantation (FUT) with dexterity
                    </li>
                    <li>
                        Ability to tailor the areas of transplantation based on the patient’s expectations to achieve a fuller-looking scalp.
                    </li>
                    <li>
                        Board-recognized cosmetic surgeon and member of several hair transplant associations.
                    </li>
                </ul>
                <p class="identity">
                    COST OF HAIR TRANSPLANT TREATMENT IN <?= ucwords($city) ?>
                </p>
                <p>
                    You can opt from among two types of common hair transplant surgeries, FUT and FUE, The cost of both treatments varies depending on the number of grafts needed. To know the exact rates, you can visit any of our expert cosmetic surgeons in <?= ucwords($city) ?>.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    We all love to have a full head of hair. This is now possible with customized hair transplant surgery by an expert cosmetic surgeon in <?= ucwords($city) ?>. Enjoy thicker and fuller hair that makes you look younger!
                </p>
                <p class="identity">
                    FAQs on Hair Transplant Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Hair Transplant surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you abide by the following criteria, you will be an ideal candidate for hair transplant surgery in <?= ucwords($city) ?>:
                        </p>
                        <ul>
                            <li>
                                You have been losing your hair out of male pattern baldness for around 5 years or more
                            </li>
                            <li>
                                You have advanced to Class 3 or beyond on the Norwood Scale.
                            </li>
                            <li>
                                Your hair at the back and sides of your scalp have a healthy growth, good enough to serve as the donor zone
                            </li>
                            <li>
                                You have Scarring alopecia – a hair loss type resulting due to the damage of hair follicles
                            </li>
                            <li>
                                You have suffered hair loss due to scalp injuries, scarring, or some cosmetic surgery procedures
                            </li>
                            <li>
                                You have good health overall and a healthy scalp
                            </li>
                            <li>
                                You have reasonable expectations with the surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of a Hair Transplant?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The average cost of Hair Transplant Surgery in <?= ucwords($city) ?> depends largely on the number of grafts. For example, the cost of the procedure per 2000 grafts lies in the range of 55,000 INR to 80,000 INR. For a Hair Transplant involving 5000 grafts, the average cost is 1,00,000 INR – 1,40,000 INR and beyond.
                        </p>
                        <p>
                            Usually, the cost per graft is 40 INR to 100 INR. The cost also depends on various other factors like baldness level, number of sessions, the technique used (FUT or FUE), availability of graft donor area, the surgeon, and the clinical set up among others.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Hair Transplant?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Usually, Hair Transplant surgery in <?= ucwords($city) ?> is a safe procedure to help your hair restoration goals. It may however accompany several risks at times, such as:
                        </p>
                        <ul>
                            <li>
                                Pain after the surgery
                            </li>
                            <li>
                                Unexpected outcomes
                            </li>
                            <li>
                                Possibility of bleeding, infection, itching, or scarring
                            </li>
                            <li>
                                Chances of wound dehiscence or skin necrosis
                            </li>
                            <li>
                                Scalp swelling
                            </li>
                            <li>
                                Lack of sensation in the treated scalp areas
                            </li>
                            <li>
                                Need for a revision surgery
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Hair Transplant?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            There is no fixed age to undergo hair transplant surgery, but surgeons mostly recommend the patients be at least 21 years old to opt for it. Moreover, if you have just started noticing hair fall and you have not gone completely bald yet, this is the right time to go for the Hair transplant from a clinic in <?= ucwords($city) ?> or elsewhere. At this specific stage, the surgeon can use your existing hair for transplantation in the early restoration phases.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before Hair Transplant Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            Before going for hair transplant surgery in <?= ucwords($city) ?>, you need to clear all the doubts in your mind regarding the procedure. Consultation with your surgeon will be ideal to help you in this regard. Here are some other things to do before undergoing the surgery
                        </p>
                        <ul>
                            <li>
                                Be ready with the reports of the routine blood tests like CBC, HCV, ECG, etc. instructed by the surgeon.
                            </li>
                            <li>
                                If you are a smoker or an alcoholic, stop consuming them at least 2 weeks before the treatment
                            </li>
                            <li>
                                Inform the doctor about any medication that you are taking currently, to stop or adjust it accordingly
                            </li>
                            <li>
                                Avoid taking spicy food the night prior to the surgery.
                            </li>
                            <li>
                                Wash your hair for at least two days with shampoo before going for hair transplantation
                            </li>
                            <li>
                                Let your doctor know if you have allergic behaviour to any particular medicine or anesthesia.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Hair Transplant surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                On the day of the hair transplantation surgery in <?= ucwords($city) ?>, come with a prepared and stress-free mind.
                            </li>
                            <li>
                                Cooperate with the clinic staff in completing all the pre-operative formalities
                            </li>
                            <li>
                                The surgeon can choose to keep you awake during the entire procedure and administer anesthesia to numb your scalp
                            </li>
                            <li>
                                Be patient enough to bear the lengthy process of hair transplantation, as it can take around four to eight hours for a single session to complete
                            </li>
                            <li>
                                In case of a large volume of hair transplantation, you may have to revisit the clinic and devote a few more hours the next day to undergo the remaining treatment.
                            </li>
                            <li>
                                Overall, you should have realistic expectations with the hair transplant surgery in <?= ucwords($city) ?>.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ACCODION -->
                <!-- <p class="cosmetic-faq-list">
                        1. Are you a good candidate for Hair Transplant surgery?
                    </p>
                    <p>
                        If you abide by the following criteria, you will be an ideal candidate for hair transplant surgery in <?= ucwords($city) ?>:
                    </p>
                    <ul>
                        <li>
                            You have been losing your hair out of male pattern baldness for around 5 years or more
                        </li>
                        <li>
                            You have advanced to Class 3 or beyond on the Norwood Scale.
                        </li>
                        <li>
                            Your hair at the back and sides of your scalp have a healthy growth, good enough to serve as the donor zone
                        </li>
                        <li>
                            You have Scarring alopecia – a hair loss type resulting due to the damage of hair follicles
                        </li>
                        <li>
                            You have suffered hair loss due to scalp injuries, scarring, or some cosmetic surgery procedures
                        </li>
                        <li>
                            You have good health overall and a healthy scalp
                        </li>
                        <li>
                            You have reasonable expectations with the surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        2. What is the cost of a Hair Transplant?
                    </p>
                    <p>
                        The average cost of Hair Transplant Surgery in <?= ucwords($city) ?> depends largely on the number of grafts. For example, the cost of the procedure per 2000 grafts lies in the range of 55,000 INR to 80,000 INR. For a Hair Transplant involving 5000 grafts, the average cost is 1,00,000 INR – 1,40,000 INR and beyond.
                    </p>
                    <p>
                        Usually, the cost per graft is 40 INR to 100 INR. The cost also depends on various other factors like baldness level, number of sessions, the technique used (FUT or FUE), availability of graft donor area, the surgeon, and the clinical set up among others.
                    </p>
                    <p class="cosmetic-faq-list">
                        3. What are the risks related to Hair Transplant?
                    </p>
                    <p>
                        Usually, Hair Transplant surgery in <?= ucwords($city) ?> is a safe procedure to help your hair restoration goals. It may however accompany several risks at times, such as:
                    </p>
                    <ul>
                        <li>
                            Pain after the surgery
                        </li>
                        <li>
                            Unexpected outcomes
                        </li>
                        <li>
                            Possibility of bleeding, infection, itching, or scarring
                        </li>
                        <li>
                            Chances of wound dehiscence or skin necrosis
                        </li>
                        <li>
                            Scalp swelling
                        </li>
                        <li>
                            Lack of sensation in the treated scalp areas
                        </li>
                        <li>
                            Need for a revision surgery
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        4. When can you go for Hair Transplant?
                    </p>
                    <p>
                        There is no fixed age to undergo hair transplant surgery, but surgeons mostly recommend the patients be at least 21 years old to opt for it. Moreover, if you have just started noticing hair fall and you have not gone completely bald yet, this is the right time to go for the Hair transplant from a clinic in <?= ucwords($city) ?> or elsewhere. At this specific stage, the surgeon can use your existing hair for transplantation in the early restoration phases.
                    </p>
                    <p class="cosmetic-faq-list">
                        5. What are the things to do before Hair Transplant Surgery?
                    </p>
                    <p>
                        Before going for hair transplant surgery in <?= ucwords($city) ?>, you need to clear all the doubts in your mind regarding the procedure. Consultation with your surgeon will be ideal to help you in this regard. Here are some other things to do before undergoing the surgery
                    </p>
                    <ul>
                        <li>
                            Be ready with the reports of the routine blood tests like CBC, HCV, ECG, etc. instructed by the surgeon.
                        </li>
                        <li>
                            If you are a smoker or an alcoholic, stop consuming them at least 2 weeks before the treatment
                        </li>
                        <li>
                            Inform the doctor about any medication that you are taking currently, to stop or adjust it accordingly
                        </li>
                        <li>
                            Avoid taking spicy food the night prior to the surgery.
                        </li>
                        <li>
                            Wash your hair for at least two days with shampoo before going for hair transplantation
                        </li>
                        <li>
                            Let your doctor know if you have allergic behaviour to any particular medicine or anesthesia.
                        </li>
                    </ul>
                    <p class="cosmetic-faq-list">
                        6. What to expect on the day of Hair Transplant surgery?
                    </p>
                    <ul>
                        <li>
                            On the day of the hair transplantation surgery in <?= ucwords($city) ?>, come with a prepared and stress-free mind.
                        </li>
                        <li>
                            Cooperate with the clinic staff in completing all the pre-operative formalities
                        </li>
                        <li>
                            The surgeon can choose to keep you awake during the entire procedure and administer anesthesia to numb your scalp
                        </li>
                        <li>
                            Be patient enough to bear the lengthy process of hair transplantation, as it can take around four to eight hours for a single session to complete
                        </li>
                        <li>
                            In case of a large volume of hair transplantation, you may have to revisit the clinic and devote a few more hours the next day to undergo the remaining treatment.
                        </li>
                        <li>
                            Overall, you should have realistic expectations with the hair transplant surgery in <?= ucwords($city) ?>.
                        </li>
                    </ul> -->
            </div>
        <?php } elseif ($surgery_str == "men and plastic surgery") { ?>
            <div class="col padd-null">
                <div class="top-content">
                    <p>
                        Women are not the only ones who wish to look their best. Nowadays, men too want to beautify themselves, look slim, have flawless skin, and there is nothing wrong with that! Several cosmetic surgeries for men exist to treat different concerns like flabby stomach, sagging or blemished skin, facial wrinkles, or any other issues. Our cosmetic surgeons from <?= ucwords($city) ?> are one of the best to perform men’s cosmetic surgeries.
                    </p>
                </div>
                <p class="identity">
                    Why Choose Our Surgeons for Men’s Plastic Surgery in <?= ucwords($city) ?>?
                </p>
                <ul>
                    <li>
                        Top choices in <?= ucwords($city) ?> for performing cosmetic surgeries for men
                    </li>
                    <li>
                        Run a fully equipped clinic with the infrastructure needed to perform extensive surgeries for men
                    </li>
                    <li>
                        Experienced at performing gynecomastia, Men’s Plastic Surgery, ear surgery, facelift, chin augmentation, tummy tuck, and many more procedures
                    </li>
                    <li>
                        Best cosmetic surgeons in <?= ucwords($city) ?> certified by several national and international boards of cosmetic surgeons
                    </li>
                </ul>
                <p class="identity">
                    COST OF MEN’S PLASTIC SURGERY IN <?= ucwords($city) ?>
                </p>
                <p>
                    When it comes to the choices for plastic surgery in men, the options are multiple. From facial non-invasive and minimally invasive treatments to extensive full-body procedures, you can go for any of them. Therefore, the cost of plastic surgery for men also varies depending on the treatment. If you have any specific concerns, feel free to visit any of our acclaimed cosmetic surgeons in <?= ucwords($city) ?> for proper guidance.
                </p>
                <p class="identity">OUR SERVICES</p>
                <p>
                    Regain your confidence with your choice of cosmetic surgery. Consult with <?= ucwords($city) ?>’s most esteemed cosmetic surgeon and be your youthful self.
                </p>
                <p class="identity">
                    FAQs on Men’s Plastic Surgery in <?= ucwords($city) ?>
                </p>
                <!-- ACCODION -->
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            1. Are you a good candidate for Men’s Plastic Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            If you are a male and looking to undergo plastic surgery in <?= ucwords($city) ?> to enhance your physical appearance, fulfilling the following points will make you a suitable candidate:
                        </p>
                        <ul>
                            <li>
                                You are an adult with good overall health
                            </li>
                            <li>
                                You are free from severe health conditions like high blood pressure, heart problems, diabetes, etc.
                            </li>
                            <li>
                                You are a non-smoker and non-alcoholic
                            </li>
                            <li>
                                You have developed too much sagging skin
                            </li>
                            <li>
                                Your current body weight is close to your ideal weight
                            </li>
                            <li>
                                You want to get away with excess fat accumulated in your tummy, thighs, eyelid, arms, etc.
                            </li>
                            <li>
                                You have set realistic expectations for the surgery
                            </li>
                            <li>
                                You want to opt for surgery to correct the asymmetric body features
                            </li>
                            <li>
                                You want to restore your body features after an accident
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            2. What is the cost of Men’s Plastic Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            The rates start from as low as a couple of thousands for dermal fillers, acne treatment, and laser skin treatment to more than 3,00,000 INR for extensive body contouring and reshaping surgeries. Consult one of our surgeons to know the amount for the specific Men’s Plastic Surgery you wish to undergo in <?= ucwords($city) ?>.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            3. What are the risks related to Men’s Plastic Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Allergic reaction to anesthesia
                            </li>
                            <li>
                                Loose or sagging skin
                            </li>
                            <li>
                                Change or decrease in the sensation in the treated area
                            </li>
                            <li>
                                Intense pain after the starting few days of the surgery
                            </li>
                            <li>
                                Bleeding and swelling that persists for a week
                            </li>
                            <li>
                                Infection due to surgery such as bruising, redness, itching, fever, warmth, etc.
                            </li>
                            <li>
                                Seroma or pooling of fluid in the body
                            </li>
                            <li>
                                Hematoma or pooling of blood, which tends the skin to feel rubbery, spongy, and lumpy
                            </li>
                            <li>
                                Possibility of revisional surgery
                            </li>
                            <li>
                                Poor healing due to careless stitching
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            4. When can you go for Men’s Plastic Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <p>
                            When you feel like enhancing your appearance, distorted due to an injury or age, opting for Men’s Plastic Surgery in <?= ucwords($city) ?> would be advisable. There is no fixed age to undergo plastic surgery, as even teenagers could undergo it after the consent of their parents. Still, to be on the side, you should be at least 18 years of age.
                        </p>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            5. What are the things to do before Men’s Plastic Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                Prepare yourself well for the surgery by following the pre-surgery instructions given by the surgeon
                            </li>
                            <li>
                                Maintain a healthy, balanced, and nutritious diet before going for the surgery
                            </li>
                            <li>
                                Drink around 6-8 glasses of water per day to hydrate and cleanse your body
                            </li>
                            <li>
                                Stop smoking at least 2 weeks before the surgery
                            </li>
                            <li>
                                Stop consuming alcohol at least 2 weeks prior to the procedure
                            </li>
                            <li>
                                Have someone accompany you to the clinic, take you back after the surgery, and assist you in daily activities for around 1 week after the surgery
                            </li>
                            <li>
                                Arrange for loose clothes to wear after the surgery for quicker healing
                            </li>
                            <li>
                                Clear all the doubts regarding plastic surgery in <?= ucwords($city) ?> with your surgeon
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-container">
                    <a onclick="accordion_elm(this)" href="#" class="accordion-toggle">
                        <span>
                            6. What to expect on the day of Men’s Plastic Surgery?
                        </span>
                        <span class="accordion-icon">
                            <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                        </span>
                    </a>
                    <div class="accordion-content">
                        <ul>
                            <li>
                                You should arrive at the hospital or clinic in <?= ucwords($city) ?> for Men’s Plastic Surgery with a calm and composed mind
                            </li>
                            <li>
                                Feel relaxed and at ease
                            </li>
                            <li>
                                Discuss your reaction to anesthesia with the anesthesiologist so that he could adjust the dose accordingly
                            </li>
                            <li>
                                The surgeon will use the latest and advanced equipment to create incisions in the concerned site on your body
                            </li>
                            <li>
                                After making the incision and doing the surgery, the surgeon will stitch the incision with sutures
                            </li>
                            <li>
                                The entire procedure may take a few hours to complete depending on the surgery you opt for
                            </li>
                            <li>
                                The surgeon will provide aftercare instructions that you would need to abide strictly from prompt healing
                            </li>
                            <li>
                                You can return to your work in around 2-3 weeks.
                            </li>
                            <li>
                                You should have realistic expectations with the surgery so that you do not face problems with unfavourable results.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<section id="procedure-listing">
    @include('cms::frontend.pages.inc-procedure-listing')
</section>


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