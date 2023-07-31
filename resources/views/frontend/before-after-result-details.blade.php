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

<div class="container-fluid">
    <div class="container">
        <div class="row pop">
            <?php
            if ($result_images->isNotEmpty()) {
                foreach ($result_images as $img) {
                    $doctor_details = get_doctor($img->album_id);
                    if ($doctor_details) {
            ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="spec">
                                <a class="example-image-link" href="<?= asset('storage/album') . '/' . $img->album_id . '/' . $img->name ?>" data-lightbox="example-set" data-title="<?= $name ?>">
                                    <img class="example-image" src="<?= asset('storage/album') . '/' . $img->album_id . '/' . $img->name ?>" alt="<?= $name ?>" />
                                </a>
                                <p>
                                    <?= $name ?> Before & After Photo - Dr. <?= $doctor_details->first_name . " " . $doctor_details->last_name ?>
                                </p>
                            </div>
                        </div>
            <?php
                    }
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
<script src="{{ mix('js/light.js') }}" type="text/javascript"></script>
@endpush