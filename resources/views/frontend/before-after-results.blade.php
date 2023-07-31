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

<div class="container-fluid before">
    <div class="container">
        <div class="row">
            <?php
            foreach ($all_result_category as $cat_tab) {

                $check = check_if_any_doc_exists($cat_tab->name);

                if ($check) {
                    $explode = explode(" ", $cat_tab->name);
                    $href = strtolower(implode('-', $explode));

                    if ($cat_tab->name == "Tummy Tuck") {
                        $result_cat_img = asset("img/static-service-img/Tummy-Tuck-5-1024x576.jpg");
                    } elseif ($cat_tab->name == "Thigh Lift") {
                        $result_cat_img = asset("img/static-service-img/Thigh-Lift-1-1024x668.jpg");
                    } elseif ($cat_tab->name == "Rhinoplasty") {
                        $result_cat_img = asset("img/static-service-img/Rhinoplasty-1-1024x683.jpg");
                    } elseif ($cat_tab->name == "Liposuction") {
                        $result_cat_img = asset("img/static-service-img/Liposuction-2-1024x683.jpg");
                    } elseif ($cat_tab->name == "Lip Augmentation") {
                        $result_cat_img = asset("img/static-service-img/Lip-Augmentation-1-1024x655.jpg");
                    } elseif ($cat_tab->name == "Hair Transplant") {
                        $result_cat_img = asset("img/static-service-img/hair-transplant-2-1024x579.jpg");
                    } elseif ($cat_tab->name == "Gynecomastia Surgery") {
                        $result_cat_img = asset("img/static-service-img/Gynecomastia-3.jpg");
                    } elseif ($cat_tab->name == "Facelift") {
                        $result_cat_img = asset("img/static-service-img/Facelift-Surgery-2-1024x596.jpg");
                    } elseif ($cat_tab->name == "Eyelid Surgery") {
                        $result_cat_img = asset("img/static-service-img/Blepharoplasty-1-1024x431.jpg");
                    } elseif ($cat_tab->name == "Ear Surgery") {
                        $result_cat_img = asset("img/static-service-img/Otoplasty-1-1024x517.jpg");
                    } elseif ($cat_tab->name == "Dermal Filters") {
                        $result_cat_img = asset("img/static-service-img/Dermal-Fillers-1-1024x802.jpg");
                    } elseif ($cat_tab->name == "Cleft Lip and Palate") {
                        $result_cat_img = asset("img/static-service-img/Cleft-Lip-and-Palate-Repair-1-1024x688.jpg");
                    } elseif ($cat_tab->name == "Chin Augmentation") {
                        $result_cat_img = asset("img/static-service-img/Chin-Surgery-1-1024x493.jpg");
                    } elseif ($cat_tab->name == "Cheek Augmentation") {
                        $result_cat_img = asset("img/static-service-img/Cheek-Augmentation-1-1024x684.jpg");
                    } elseif ($cat_tab->name == "Buttock Lift with Augmentation") {
                        $result_cat_img = asset("img/static-service-img/Buttock-Enhancement-2-1024x512.jpg");
                    } elseif ($cat_tab->name == "Buccal Fat Removal") {
                        $result_cat_img = asset("img/static-service-img/Buccal-Fat-Removal-Cheek-Reduction-1-1024x683.jpg");
                    } elseif ($cat_tab->name == "Brow Lift") {
                        $result_cat_img = asset("img/static-service-img/Brow-Lift-Browplasty-1-1024x683.jpg");
                    } elseif ($cat_tab->name == "Breast Reduction") {
                        $result_cat_img = asset("img/static-service-img/Breast-Reduction-2-1024x658.jpg");
                    } elseif ($cat_tab->name == "Breast Reconstruction") {
                        $result_cat_img = asset("img/static-service-img/Breast-Reconstruction-2-1024x683.jpg");
                    } elseif ($cat_tab->name == "Breast Lift") {
                        $result_cat_img = asset("img/static-service-img/Fat-Transfer-Breast-Augmentation-1-1024x819.jpg");
                    } elseif ($cat_tab->name == "Breast Implant Removal & Exchange") {
                        $result_cat_img = asset("img/static-service-img/Breast-Implant-Removal-1-1024x684.jpg");
                    } elseif ($cat_tab->name == "Breast Augmentation") {
                        $result_cat_img = asset("img/static-service-img/Breast-Augmentation-1-1024x683.jpg");
                    } elseif ($cat_tab->name == "Body Lift") {
                        $result_cat_img = asset("img/static-service-img/Body-Lift-1-1024x649.jpg");
                    } else {
                        $result_cat_img = asset("img/static-service-img/Arm-Lift-2-1024x683.jpg");
                    }
            ?>
                    <div class="col-lg-4 col-md-6">
                        <a target="_blank" href="<?= url("before-after-results/$href") ?>">
                            <img src="<?= $result_cat_img ?>" class="img-responsive" alt="category image">
                            <h4><?= $cat_tab->name ?></h4>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
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
<!-- codepp -->

@endsection

@push ("after-scripts")

@endpush