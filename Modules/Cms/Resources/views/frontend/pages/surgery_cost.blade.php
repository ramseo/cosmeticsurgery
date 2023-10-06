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

                <?php
                $popular_cities1 = popular_cities_surgeries("cities", $skip = 0, $take = 13);
                $popular_cities2 = popular_cities_surgeries("cities", $skip = 13, $take = 100);
                ?>

                <p class="identity text-center">
                    Clinic Locations
                </p>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <?php if ($popular_cities1) { ?>
                            <ul class="padd-null cities-list">
                                <?php foreach ($popular_cities1 as $cities1) { ?>
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
                        <?php if ($popular_cities2) { ?>
                            <ul class="padd-null cities-list">
                                <?php foreach ($popular_cities2 as $cities2) { ?>
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

        <!-- surgeons listing -->
        <?php
        $doctors = DB::table('users')->select('*')->whereNotNull('city')->Where('is_active', 1)->orderBy("first_name")->get()->toArray();
        if ($doctors) {
        ?>
            <p class="identity">our surgeons:</p>
            <div class="identity surgeon-filter">
                <select attr="cost" id="surgeon-filter">
                    <option value="">Sort Surgeons By Alphabet</option>
                    <?php
                    $alphabets_arr = [];
                    $fr_name_arr = array_column($doctors, "first_name");
                    foreach ($fr_name_arr as $item) {
                        if (!in_array($item[0], $alphabets_arr)) {
                            array_push($alphabets_arr, $item[0]);
                        }
                    }

                    foreach ($alphabets_arr as $elements) {
                    ?>
                        <option value="<?= strtolower($elements) ?>">
                            <?= $elements ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="sort-btn">
                    <button page-attr="cost" attr="desc" id="sort-by-asc-des" type="button" class="btn">
                        Click To Sort By Descending Order
                    </button>
                </div>
            </div>
            <div id="ajax-surgeons" class="row">
                <?php foreach ($doctors as $doc_item) { ?>
                    <div class="col-sm-2">
                        <a target="_blank" href="<?= url("surgeon/dr-$doc_item->username") ?>">
                            <div class="list-doctor">
                                <?php if (file_exists(public_path() . '/storage/user/profile/' . $doc_item->avatar)) { ?>
                                    <img class="card-img-top" src="<?= asset('/storage/user/profile/' . $doc_item->avatar) ?>" alt="<?= $doc_item->first_name . ' ' . $doc_item->last_name ?>" style="width:100%" />
                                <?php } else { ?>
                                    <img class="card-img-top" src="<?= asset($doc_item->avatar) ?>" alt="<?= $doc_item->first_name . ' ' . $doc_item->last_name ?>" style="width:100%" />
                                <?php } ?>
                                <p>
                                    Dr. <?= substr($doc_item->first_name . " " . $doc_item->last_name, 0, 25) ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
        <!-- surgeons listing -->

        <!-- bottom content -->
        <div class="row">
            <?= $$module_name_singular->bottom_content ?>
        </div>
        <!-- bottom content -->
    </div>
</div>

@endsection

@push ("after-scripts")

@endpush