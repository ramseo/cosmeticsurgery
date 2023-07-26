<!-- code -->
<div class="container-fluid mtab pt-4 pb-4" style="background-color:#f8f8f8">
    <div class="container">
        <p class="identity m-auto" style="width:fit-content">
            Find Your Cosmetic Surgery Procedure
        </p>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item default-active-cls active">
                <a class="nav-link default-active-cls active ancr" data-toggle="tab" href="#home" aria-expanded="true">
                    Face Procedures
                </a>
            </li>
            <li class="nav-item remove-default-active-cls ml-2">
                <a class="nav-link ancr" data-toggle="tab" href="#menu1" aria-expanded="false">
                    Breast Procedures
                </a>
            </li>
            <li class="nav-item remove-default-active-cls ml-2">
                <a class="nav-link ancr" data-toggle="tab" href="#menu2" aria-expanded="false">
                    Body Procedures
                </a>
            </li>
            <li class="nav-item remove-default-active-cls ml-2">
                <a class="nav-link ancr" data-toggle="tab" href="#menu3" aria-expanded="false">
                    Male Specific Procedures
                </a>
            </li>
        </ul>

        <p>
            <!-- Tab panes -->
        </p>

        <div class="tab-content">
            <div id="home" class="container default-active-cls tab-pane active in">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/face.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="rhinoplasty">Rhinoplasty</a>
                                    </li>
                                    <li>
                                        <a href="blepharoplasty">Blepharoplasty</a>
                                    </li>
                                    <li>
                                        <a href="facelift">Facelift</a>
                                    </li>
                                    <li>
                                        <a href="brow-lift">Brow Lift</a>
                                    </li>
                                    <li>
                                        <a href="neck-lift">Neck Lift</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="chin-surgery">Chin Surgery</a>
                                    </li>
                                    <li>
                                        <a href="cheek-augmentation">Cheek Augmentation</a>
                                    </li>
                                    <li>
                                        <a href="lip-augmentation">Lip Augmentation</a>
                                    </li>
                                    <li>
                                        <a href="buccal-fat-removal">Buccal Fat Removal</a>
                                    </li>
                                    <li>
                                        <a href="ear-surgery">Ear Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu1" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/breast.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="breast-augmentation">Breast Augmentation</a>
                                    </li>
                                    <li>
                                        <a href="breast-lift">Breast Lift</a>
                                    </li>
                                    <li>
                                        <a href="breast-reduction">Breast Reduction</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="breast-implant-removal">Breast Implant Removal</a>
                                    </li>
                                    <li>
                                        <a href="breast-implant-revision">Breast Implant Revision</a>
                                    </li>
                                    <li>
                                        <a href="gynecomastia">Gynecomastia</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu2" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/body.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="liposuction">Liposuction</a>
                                    </li>
                                    <li>
                                        <a href="tummy-tuck">Tummy Tuck</a>
                                    </li>
                                    <li>
                                        <a href="buttock-enhancement">Buttock Enhancement</a>
                                    </li>
                                    <li>
                                        <a href="body-lift">Body Lift</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="arm-lift">Arm Lift</a>
                                    </li>
                                    <li>
                                        <a href="thigh-lift">Thigh Lift</a>
                                    </li>
                                    <li>
                                        <a href="body-contouring">Body Contouring</a>
                                    </li>
                                    <li>
                                        <a href="mommy-makeover">Mommy Makeover</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu3" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/male.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="hair-transplant">Hair Transplant</a>
                                    </li>
                                    <li>
                                        <a href="gynecomastia">Gynecomastia</a>
                                    </li>
                                    <li>
                                        <a href="men-and-plastic-surgery">Men and Plastic Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu4" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/body-hair-to-head.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="hair-transplant">Hair Transplant</a>
                                    </li>
                                    <li>
                                        <a href="gynecomastia">Gynecomastia</a>
                                    </li>
                                    <li>
                                        <a href="men-and-plastic-surgery">Men and Plastic Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu5" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/failed-hair-transplant-repair.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a href="hair-transplant">Hanir Transplant</a>
                                    </li>
                                    <li>
                                        <a href="gynecomastia">Gynecomastia</a>
                                    </li>
                                    <li>
                                        <a href="men-and-plastic-surgery">Men and Plastic Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- code -->


@php
$categories = getDataArray('types');
$cities = getDataArray('cities');
@endphp
@if($categories)
<!-- <section id="category-section"> 
    <div class="container-fluid">
        <div class="col-xs-12 common-heading text-center" data-aos="flip-left">
            <p class="shadow-text">Categories</p>
            <p class="head">Wedding Categories</p>
        </div>
        <div class="row category-main-row">
            @php
            $cat_count = 0;
            $evenArr = array('2','4','6','8','10','12','14','16');
            @endphp
            @foreach($categories as $type)
            @php
            $cat_count++;

            if(in_array($cat_count,$evenArr)){
            $aos_animate = "data-aos='fade-left'";
            }else{
            $aos_animate = "data-aos='fade-right'";
            }

            @endphp
            <div class="single-category-col col-6" <?= $aos_animate ?>>
                <a href="{{url('/'.$type->slug)}}" class="">
                    <div class="inner inner_{{$cat_count}}" style="background-color: {{$type->colour}};">
                        <style>
                            .inner_<?= $cat_count ?>.img-col::after {
                                background-color: <?= $type->colour ?> !important
                            }
                        </style>
                        <div class="img-col">

                            <img src="{{asset('storage/type/image/'.$type->image)}}" alt="" class="img-fluid">
                            <div class="text-col">
                                <p class="head">{{$type->name}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section> -->
@endif