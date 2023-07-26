@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->meta_title}} @endsection

@section('site-meta-tags')
<meta name="description" content="{{ $$module_name_singular->meta_description ? $$module_name_singular->meta_description : setting('meta_keyword') }}">
@endsection


@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>
            <?= $$module_name_singular->name ?>
        </p>
    </div>
</div>

<!-- ffffffffff -->
<div class="container-fluid">
    <div class="container">
        <div class="container-fluid mtab pt-4 pb-4">
            <div class="container">
                <p class="identity m-auto text-center">
                    Find Your Procedure
                </p>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active ancr" data-toggle="tab" href="#home" aria-expanded="true">By
                            Category</a>
                    </li>
                    <li class="nav-item by-catg-space">
                        <a class="nav-link ancr" data-toggle="tab" href="#menu1" aria-expanded="false">Alphabetical</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="container tab-pane active in">
                        <div class="row tabo">
                            <div class="col-lg-3 col-md-12 col-sm-3 pt-3">
                                <img src="img/Breast-Augmentation-1-1024x683.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <p class="small-heading pt-3">Breast</p>
                                <div class="border"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/breast-augmentation">Breast
                                                Augmentation</a></p>
                                        <small>Augmentation Mammaplasty</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/breast-implant-removal">Breast Implant
                                                Removal</a></p>
                                        <small>Implant removal</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>

                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/breast-implant-revision">Breast Implant
                                                Revision</a></p>
                                        <small>Implant Replacement</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/breast-lift">Breast Lift</a></p>
                                        <small>Breast Lift</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/breast-reduction">Breast Reduction</a>
                                        </p>
                                        <small>Reduction Mammaplasty</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/fat-transfer">Fat Transfer Breast
                                                Augmentation</a></p>
                                        <small>Breast Augmentation with Fat Grafting</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row tabo">
                            <div class="col-lg-3 col-md-3 col-sm-3 pt-3">
                                <img src="img/Liposuction-1-1024x683.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-9 pt-3">
                                <p class="small-heading">Fat Reduction</p>
                                <div class="border"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/liposuction">Liposuction</a></p>
                                        <small>Surgical Fat Reduction</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/liposuction-laser-ultrasound-assisted">Liposuction-Assisted</a>
                                        </p>
                                        <small>Laser/Ultrasound Assisted</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/non-surgical-fat-reduction">Nonsurgical
                                                Fat Reduction</a></p>
                                        <small>Minimally Invasive Procedures</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row tabo">
                            <div class="col-lg-3 col-md-12 col-sm-3 pt-3">
                                <img src="img/Arm-Lift-2-1024x683.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-9 pt-3">
                                <p class="small-heading">Body Lifts</p>
                                <div class="border"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/arm-lift">Arm Lift</a></p>
                                        <small>Brachioplasty</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/body-contouring">Body Contouring</a>
                                        </p>
                                        <small>Skin Removal After Major Weight Loss</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>

                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/body-lift">Body Lift</a></p>
                                        <small>Improving Shape and Tone</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/buttock-enhancement">Buttock
                                                Enhancement</a></p>
                                        <small>Gluteal Augmentation and Lift</small>
                                    </div>
                                </div>


                                <div class="kpborder"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/mommy-makeover">Mommy Makeover</a></p>
                                        <small>Get Your Pre-Baby Body Back</small>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/thigh-lift">Thigh Lift</a></p>
                                        <small>Reshaping The Thighs</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/tummy-tuck">Tummy Tuck</a></p>
                                        <small>Abdominoplasty</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row tabo">
                            <div class="col-lg-3 col-md-12 col-sm-3 pt-3">
                                <img src="img/Brow-Lift-Browplasty-0-1024x819.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-9 pt-3">
                                <p class="small-heading">FACE & NECK</p>
                                <div class="border"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/brow-lift">Brow Lift</a></p>
                                        <small>Forehead Lift</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/buccal-fat-removal">Buccal Fat
                                                Removal</a></p>
                                        <small>Cheek Reduction</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>

                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/cheek-augmentation">Cheek
                                                Augmentation</a></p>
                                        <small>Cheek Enhancement</small>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/chin-surgery">Chin Surgery</a></p>
                                        <small>Mentoplasty</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/ear-surgery">Ear surgery</a></p>
                                        <small>Otoplasty</small>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/blepharoplasty">Eyelid Surgery</a></p>
                                        <small>Blepharoplasty</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/facial-implants">Facial Implants</a>
                                        </p>
                                        <small>Facial Balancing and Enhancing</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/neck-lift">Neck Lift</a></p>
                                        <small>Lower Rhytidectomy</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/rhinoplasty">Rhinoplasty</a></p>
                                        <small>Nose Surgery</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/facelift">Facelift Surgery</a></p>
                                        <small>Rhytidectomy</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row tabo">
                            <div class="col-lg-3 col-md-12 col-sm-3 pt-3">
                                <img src="img/Botulinum-Toxin-BOTOX-2-1024x734.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-9 pt-3">
                                <p class="small-heading">MINIMALLY INVASIVE</p>
                                <div class="border"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/botox">Botulinum Toxin</a></p>
                                        <small>Botox</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/dermabrasion">Dermabrasion</a></p>
                                        <small>Minimally invasive Procedure</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/dermal-fillers">Dermal Fillers</a></p>
                                        <small>Minimally invasive Procedures</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/laser-hair-removal">Laser Hair
                                                Removal</a></p>
                                        <small>Hair Removal procedure</small>
                                    </div>
                                </div>

                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/laser-skin-resurfacing">Laser Skin
                                                Resurfacing</a></p>
                                        <small>Skin Care Procedure</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/microdermabrasion">Microdermabrasion</a></p>
                                        <small>Minimally Invasive Procedure</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/skin-rejuvenation-and-resurfacing">Skin
                                                Reuvenataion and Resurfacing</a></p>
                                        <small>Skin Care Procedure</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/spider-vein-treatment">Spider Vein
                                                Treatment</a></p>
                                        <small>Sclerotherapy</small>
                                    </div>
                                </div>

                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/tattoo-removal">Tattoo Removal</a></p>
                                        <small>Eliminate Unwanted Tattoos</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row tabo">
                            <div class="col-lg-3 col-md-12 col-sm-3 pt-3">
                                <img src="img/Gynecomastia-1-1024x683.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-9 pt-3">
                                <p class="small-heading">MALE-SPECIFIC PLASTIC SURGERY</p>
                                <div class="border"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/gynecomastia">Gynecomastia Surgery</a>
                                        </p>
                                        <small>Male Breast Reduction Surgery</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/hair-transplant">Hair Transplant</a>
                                        </p>
                                        <small>Surgical Hair Replacement</small>
                                    </div>
                                </div>
                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/body-lift">Body Lift</a></p>
                                        <small>Improving Shape and Tone</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/men-and-plastic-surgery">Men and
                                                Plastic Surgery</a></p>
                                        <small>Male-Specific Considerations</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row tabo">
                            <div class="col-lg-3 col-md-12 col-sm-3 pt-3">
                                <img src="img/Hymenoplasty-1-1024x693.jpg" style="width:100%">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-9 pt-3">
                                <p class="small-heading">VAGINAL REJUVENATION </p>
                                <div class="border"></div>
                                <div class="row even">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/hymenoplasty">Hymenoplasty</a></p>
                                        <small>Hymen Reconstruction Surgical Options</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/vaginal-rejuvenation">Vaginal
                                                Rejuvenation</a></p>
                                        <small>Tightening Surgical Options</small>
                                    </div>
                                </div>

                                <div class="kpborder"></div>
                                <div class="row odd">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/labiaplasty">Labiaplasty</a></p>
                                        <small>Reshaping Surgical Options</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/non-surgical-vaginal-rejuvenation">Nonsurgical
                                                Vaginal Rejuvenation</a></p>
                                        <small>Minimally Invasive Options</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu1" class="container tab-pane fade">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <div class="row tabo alphabect-tab">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/arm-lift">Arm Lift</a></p>
                                        <small>Brachioplasty</small>
                                        <p class="proc"><a href="<?= url('/') ?>/body-contouring">Body Contouring</a>
                                        </p>
                                        <small>Skin Removal After Major Weight Loss</small>

                                        <p class="proc"><a href="<?= url('/') ?>/body-lift">Body Lift</a></p>
                                        <small>Improving Shape and Tone</small>
                                        <p class="proc"><a href="<?= url('/') ?>/botox">Botulinum Toxin</a></p>
                                        <small>Botox</small>

                                        <p class="proc"><a href="<?= url('/') ?>/breast-augmentation">Breast
                                                Augmentation</a></p>
                                        <small>Augmentation Mammaplasty</small>
                                        <p class="proc"><a href="<?= url('/') ?>/breast-implant-removal">Breast Implant
                                                Removal</a></p>
                                        <small>Implant Removal</small>

                                        <p class="proc"><a href="<?= url('/') ?>/breast-implant-revision">Breast Implant
                                                Revision</a></p>
                                        <small>Implant Replacement</small>
                                        <p class="proc"><a href="<?= url('/') ?>/breast-lift">Breast Lift</a></p>
                                        <small>Mastopexy</small>

                                        <p class="proc"><a href="<?= url('/') ?>/breast-reduction">Breast Reduction</a>
                                        </p>
                                        <small>Reduction Mammaplasty</small>
                                        <p class="proc"><a href="<?= url('/') ?>/brow-lift">Brow Lift</a></p>
                                        <small>Forehead Lift</small>

                                        <p class="proc"><a href="<?= url('/') ?>/buccal-fat-removal">Buccal Fat
                                                Removal</a></p>
                                        <small>Cheek Reduction</small>
                                        <p class="proc"><a href="<?= url('/') ?>/buttock-enhancement">Buttock
                                                Enhancement</a></p>
                                        <small>Gluteal Augmentation and Lift</small>

                                        <p class="proc"><a href="<?= url('/') ?>/cheek-augmentation">Cheek
                                                Augmentation</a></p>
                                        <small>Cheek Enhancement</small>
                                        <p class="proc"><a href="<?= url('/') ?>/chemical-peel">Chemical Peel</a></p>
                                        <small>Minimally Invasive Procedure</small>

                                        <p class="proc"><a href="<?= url('/') ?>/chin-surgery">Chin Surgery</a></p>
                                        <small>Mentoplasty</small>
                                        <p class="proc"><a href="<?= url('/') ?>/dermabrasion">Dermabrasion</a></p>
                                        <small>Minimally Invasive Procedure</small>

                                        <p class="proc"><a href="<?= url('/') ?>/dermal-fillers">Dermal Fillers</a></p>
                                        <small>Minimally Invasive Procedures</small>
                                        <p class="proc"><a href="<?= url('/') ?>/ear-surgery">Ear Surgery</a></p>
                                        <small>Otoplasty</small>

                                        <p class="proc"><a href="<?= url('/') ?>/blepharoplasty">Eyelid Surgery</a></p>
                                        <small>Blepharoplasty</small>
                                        <p class="proc"><a href="<?= url('/') ?>/facelift">Facelift Surgery</a></p>
                                        <small>Rhytidectomy</small>

                                        <p class="proc"><a href="<?= url('/') ?>/facial-implants">Facial Implants</a>
                                        </p>
                                        <small>Facial Balancing and Enhancing</small>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <p class="proc"><a href="<?= url('/') ?>/fat-transfer">Fat Transfer Breast
                                                Augmentation</a></p>
                                        <small>Breast Augmentation with Fat Grafting</small>
                                        <p class="proc"><a href="<?= url('/') ?>/gynecomastia">Gynecomastia Surgery</a>
                                        </p>
                                        <small>Male Breast Reduction Surgery</small>

                                        <p class="proc"><a href="<?= url('/') ?>/hair-transplant">Hair Transplant</a>
                                        </p>
                                        <small>Surgical Hair Replacement</small>
                                        <p class="proc"><a href="<?= url('/') ?>/laser-hair-removal">Laser Hair
                                                Removal</a></p>
                                        <small>Hair Removal Procedure</small>

                                        <p class="proc"><a href="<?= url('/') ?>/laser-skin-resurfacing">Laser Skin
                                                Resurfacing</a></p>
                                        <small>Skin Care Procedure</small>
                                        <p class="proc"><a href="<?= url('/') ?>/liposuction">Liposuction</a></p>
                                        <small>Surgical Fat Reduction</small>

                                        <p class="proc"><a href="<?= url('/') ?>/liposuction-laser-ultrasound-assisted">Liposuction
                                                & Assisted</a></p>
                                        <small>Laser / Ultrasound Assisted</small>
                                        <p class="proc"><a href="<?= url('/') ?>/men-and-plastic-surgery">Men and
                                                Plastic Surgery</a></p>
                                        <small>Male-Specific Considerations</small>

                                        <p class="proc"><a href="<?= url('/') ?>/microdermabrasion">Microdermabrasion</a></p>
                                        <small>Minimally Invasive Procedure</small>
                                        <p class="proc"><a href="<?= url('/') ?>/mommy-makeover">Mommy Makeover</a></p>
                                        <small>Get Your Pre-Baby Body Back</small>

                                        <p class="proc"><a href="<?= url('/') ?>/neck-lift">Neck Lift</a></p>
                                        <small>Lower Rhytidectomy</small>
                                        <p class="proc"><a href="<?= url('/') ?>/non-surgical-fat-reduction">Nonsurgical
                                                Fat Reduction</a></p>
                                        <small>Minimally Invasive Procedures</small>

                                        <p class="proc"><a href="<?= url('/') ?>/non-surgical-vaginal-rejuvenation">Nonsurgical
                                                Vaginal Rejuvenation</a></p>
                                        <small>Minimally Invasive Options</small>
                                        <p class="proc"><a href="<?= url('/') ?>/rhinoplasty">Rhinoplasty</a></p>
                                        <small>Nose Surgery</small>

                                        <p class="proc"><a href="<?= url('/') ?>/skin-rejuvenation-and-resurfacing">Skin
                                                Rejuvenation and Resurfacing</a></p>
                                        <small>Skin Care Procedure</small>
                                        <p class="proc"><a href="<?= url('/') ?>/spider-vein-treatment">Spider Vein
                                                Treatment</a></p>
                                        <small>Sclerotherapy</small>

                                        <p class="proc"><a href="<?= url('/') ?>/tattoo-removal">Tattoo Removal</a></p>
                                        <small>Eliminate Unwanted Tattoos</small>
                                        <p class="proc"><a href="<?= url('/') ?>/thigh-lift">Thigh Lift</a></p>
                                        <small>Reshaping The Thighs</small>

                                        <p class="proc"><a href="<?= url('/') ?>/tummy-tuck">Tummy Tuck</a></p>
                                        <small>Abdominoplasty</small>
                                        <p class="proc"><a href="<?= url('/') ?>/vaginal-rejuvenation">Vaginal
                                                Rejuvenation</a></p>
                                        <small>Surgical Options</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ffffffffff -->


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
<!-- codepp -->

@endsection

@push ("after-scripts")

@endpush