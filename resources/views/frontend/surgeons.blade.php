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

<div class="container-fluid new-doctor">
    <div class="container">
        <?php
        $alphabetical = DB::table('users')->select('*')->whereNotNull('city')->Where('is_active', 1)->orderBy("first_name")->get()->toArray();
        if ($doctors) {
        ?>
            <div class="identity surgeon-filter">
                <select id="surgeon-filter">
                    <option value="">Sort Surgeons By Alphabet</option>
                    <?php
                    $alphabets_arr = [];
                    $fr_name_arr = array_column($alphabetical, "first_name");
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
                    <button attr="desc" id="sort-by-asc-des" type="button" class="btn">
                        Click To Sort By Descending Order
                    </button>
                </div>
            </div>
        <?php } ?>
        <div id="ajax-surgeons" class="row anc">
            <?php
            if ($doctors) {
                foreach ($doctors as $doc_item) {
                    $city = getCitiesById($doc_item->city, "pipe");
            ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a target="_blank" href="<?= url("surgeon/dr-$doc_item->username") ?>">
                                <?php if (file_exists(public_path() . '/storage/user/profile/' . $doc_item->avatar)) { ?>
                                    <img src="<?= asset('/storage/user/profile/' . $doc_item->avatar) ?>" class="card-img-top" alt="doctor alt" style="width:100%" />
                                <?php } else { ?>
                                    <img src="<?= asset($doc_item->avatar) ?>" class="card-img-top" alt="doctor alt" style="width:100%" />
                                <?php } ?>
                            </a>
                            <div class="card-body doctors-list-cls">
                                <a target="_blank" href="<?= url("surgeon/dr-$doc_item->username") ?>">
                                    <h4 class="card-title">
                                        Dr. <?= substr($doc_item->first_name . " " . $doc_item->last_name, 0, 16) ?>
                                    </h4>
                                </a>
                                <ul class="padd-null text-center">
                                    <li>Cosmetic / Plastic Surgeon</li>
                                    <li>
                                        <?php
                                        $profile_data = get_userprofiles($doc_item->id);
                                        echo $profile_data->degree;
                                        ?>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-map-marker blink"></i>
                                            <b class="cities-font-size"><?= $city ?></b>
                                        </a>
                                    </li>
                                </ul>
                                <a target="_blank" href="<?= url("surgeon/dr-$doc_item->username") ?>" class="surgeons-flex">
                                    <button class="btn btn-primary">Consult Now</button>
                                    <button class="btn btn-primary">Know More</button>
                                </a>
                            </div>
                        </div>
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