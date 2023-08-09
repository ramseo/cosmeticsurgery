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

<section class="blog-list-half section-padding sub-bg">
    <div class="container">
        <h3 class="text-capitalize author-archive-cls">
            Author Archives: <?= $slug ?>
        </h3>
        <div class="row">
            <?php
            foreach ($posts as $item) {
                $details_url = route("frontend.posts.show", [$item->slug]);
                $author_url = str_replace(' ', '-', strtolower($item->author));
            ?>
                <div class="col-lg-6 padd-bottom-30">
                    <div class="item mb-50">
                        <div class="row">
                            <div class="col-md-5 img">
                                <a href="<?= $details_url ?>">
                                    <img src="<?= $item->featured_image ?>" alt="<?= ($item->alt) ? $item->alt : $item->name ?>">
                                </a>
                            </div>
                            <div class="col-md-7 main-bg cont valign">
                                <div class="full-width">
                                    <span class="date fz-12 ls1 text-u opacity-7 mb-15">
                                        <?= date('F', strtotime($item->published_at)) . " " . date('d', strtotime($item->published_at)) . "," . " " . date('Y', strtotime($item->published_at)) ?>
                                    </span>
                                    <h5>
                                        <a href="<?= $details_url ?>">
                                            <?= Str::words($item->name, 4) ?>
                                        </a>
                                    </h5>
                                    <div class="author">
                                        <span>
                                            Author:
                                        </span>
                                        <a class="color-white" href="<?= url('/') . '/' . 'blog/author/' . $author_url ?>">
                                            <?= $item->author ?>
                                        </a>
                                    </div>
                                    <div class="tags colorbg mt-15">
                                        <a href="<?= $details_url ?>">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="inner text-center">
            <div class="d-flex justify-content-center w-100 mt-3">
                {{$posts->links()}}
            </div>
        </div>
    </div>
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