@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->meta_title}} @endsection

@section('site-meta-tags')
<meta name="keyword" content="{{ $$module_name_singular->meta_keywords ? $$module_name_singular->meta_keywords : setting('meta_keyword') }}">
<meta name="description" content="{{ $$module_name_singular->meta_description ? $$module_name_singular->meta_description : setting('meta_keyword') }}">
@endsection

@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>{{$$module_name_singular->name}}</p>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?= $$module_name_singular->content ?>
            </div>
            <div class="col-lg-4 loc">
                <div class="sidebar-menu">
                    <?php
                    $all_cities = popular_cities_surgeries("cities", $skip = false, $take = false);

                    list($city_array1, $city_array2) = array_chunk($all_cities, ceil(count($all_cities) / 2));
                    ?>

                    <p class="identity text-center">
                        Clinic Locations
                    </p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <?php if ($city_array1) { ?>
                                <ul class="padd-null cities-list">
                                    <?php foreach ($city_array1 as $cities1) { ?>
                                        <li class="<?= (str_replace('/', '', Request::getRequestUri()) == $cities1->slug) ? 'active' : '' ?>">
                                            <a href="<?= $cities1->slug ?>">
                                                <?= $cities1->name ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <?php if ($city_array2) { ?>
                                <ul class="padd-null cities-list">
                                    <?php foreach ($city_array2 as $cities2) { ?>
                                        <li class="<?= (str_replace('/', '', Request::getRequestUri()) == $cities2->slug) ? 'active' : '' ?>">
                                            <a href="<?= $cities2->slug ?>">
                                                <?= $cities2->name ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    $popular_surgeries_arr = popular_cities_surgeries("popular-surgeries", $skip = "", $take = "");

                    list($array1, $array2) = array_chunk($popular_surgeries_arr, ceil(count($popular_surgeries_arr) / 2));
                    ?>

                    <p class="identity text-center">Popular Surgeries</p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <?php if ($array1) { ?>
                                <ul class="padd-null surgeries-list">
                                    <?php foreach ($array1 as $surgeries1) { ?>
                                        <li class="<?= (str_replace('/', '', Request::getRequestUri()) == $surgeries1->url) ? 'active' : '' ?>">
                                            <a href="<?= $surgeries1->url ?>">
                                                <?= $surgeries1->title ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <?php if ($array2) { ?>
                                <ul class="padd-null surgeries-list">
                                    <?php foreach ($array2 as $surgeries2) { ?>
                                        <li class="<?= (str_replace('/', '', Request::getRequestUri()) == $surgeries2->url) ? 'active' : '' ?>">
                                            <a href="<?= $surgeries2->url ?>">
                                                <?= $surgeries2->title ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
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