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
        <h3 class="text-capitalize">
            Author Archives: <?= $slug ?>
        </h3>

        <section class="home-section blog-author-sec">
            <div class="row">
                <?php
                foreach ($posts as $item) {
                    $details_url = route("frontend.posts.show", [$item->slug]);
                    $author_url = str_replace(' ', '-', strtolower($item->author));
                ?>
                    <div class="col-md-4">
                        <div class="post-item-wrap">
                            <div class="common-card">
                                <div class="card">
                                    <div class="img-col">
                                        <a href="{{$details_url}}">
                                            <img src="{{$item->featured_image}}" class="img-fluid" alt="<?= $item->alt ?>">
                                        </a>
                                    </div>
                                    <div class="text-col">
                                        <a href="{{$details_url}}">
                                            <p class="title">
                                                <?= Str::words($item->name, 4) ?>
                                            </p>
                                        </a>
                                        <!-- <p class="text margin-null">
                                            {{Str::words($item->intro, '15')}}
                                        </p> -->
                                        <div class="author">
                                            <span>
                                                Author:
                                            </span>
                                            <a class="color-black" href="<?= url('/') . '/' . 'blog/author/' . $author_url ?>">
                                                <?= $item->author ?>
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
                    <?= $posts->links() ?>
                </div>
            </div>
        </section>
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

@endsection

@push ("after-scripts")

@endpush