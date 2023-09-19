@extends('frontend.layouts.app')

@section('title') {{ __("Blog") }} @endsection

@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p class="cities_cls">
            Blog
        </p>
    </div>
</div>

@if(count($post_data))

<section class="blog-section">
    <div class="container">
        <div class="row">

            <?php
            foreach ($post_data as $item) {
                $details_url = route("frontend.$module_name.show", [$item->slug]);
                $author_url = str_replace(' ', '-', strtolower($item->author));
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-section">
                    <div class="card">
                        <div class="card-header">
                            <img src="<?= $item->featured_image ?>" alt="<?= ($item->alt) ? $item->alt : $item->name ?>" />
                        </div>
                        <div class="card-body">
                            <span class="tag tag-teal">Technology</span>
                            <h4>
                                <?= $item->name ?>
                            </h4>
                            <p>
                                <?= strip_tags(Str::words($item->content, 6)); ?>
                            </p>
                            <div class="user">
                                <div class="blog-author-flex">
                                    <img src="<?= asset("img/default-avatar.jpg") ?>" alt="<?= $item->author ?>" />
                                    <div class="user-info">
                                        <h5>
                                            <?= ($author_url == "super-admin") ? $item->author : "Dr." . " " . $item->author ?>
                                        </h5>
                                        <small>1w ago</small>
                                    </div>
                                </div>
                                <div class="read-m-butt">
                                    <a href="<?= $details_url ?>">
                                        <button>Read More</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php  }  ?>

            <!-- <div class="col-lg-4 col-md-6 col-sm-12 col-section">
                <div class="card">
                    <div class="card-header">
                        <img src="https://dev.cosmeticsurgery.in/storage/files/Brow-Lift-Browplasty-746x560.jpg" alt="city" />
                    </div>
                    <div class="card-body">
                        <span class="tag tag-purple">Popular</span>
                        <h4>
                            Amazing benefits and potential...
                        </h4>
                        <p>
                            The future can be scary, but there are ways to deal with that fear.
                        </p>
                        <div class="user">
                            <div>
                                <img src="https://lh3.googleusercontent.com/ogw/ADGmqu8sn9zF15pW59JIYiLgx3PQ3EyZLFp5Zqao906l=s32-c-mo" alt="user" />
                                <div class="user-info">
                                    <h5>Carrie Brewer</h5>
                                    <small>1w ago</small>
                                </div>
                            </div>
                            <div class="read-m-butt">
                                <button>Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


            <!-- <div class="col-lg-4 col-md-6 col-sm-12 col-section">
                <div class="card">
                    <div class="card-header">
                        <img src="https://dev.cosmeticsurgery.in/storage/files/Body-Lift-1-746x560.jpg" alt="city" />
                    </div>
                    <div class="card-body">
                        <span class="tag tag-pink">Design</span>
                        <h4>
                            Amazing benefits and potential...
                        </h4>
                        <p>
                            Dashboard Design Guidelines
                        </p>
                        <div class="user">
                            <div>
                                <img src="https://lh3.googleusercontent.com/ogw/ADGmqu8sn9zF15pW59JIYiLgx3PQ3EyZLFp5Zqao906l=s32-c-mo" alt="user" />
                                <div class="user-info">
                                    <h5>Carrie Brewer</h5>
                                    <small>1w ago</small>
                                </div>
                            </div>
                            <div class="read-m-butt">
                                <button>Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
</section>
<!-- <section class="blog-list-half section-padding sub-bg">
    <div class="container">
        <div class="row">
            <?php
            foreach ($post_data as $item) {
                $details_url = route("frontend.$module_name.show", [$item->slug]);
                $author_url = str_replace(' ', '-', strtolower($item->author));
            ?>
            <div class="col-lg-6 padd-bottom-30">
                <div class="item mb-50">
                    <div class="row">
                        <div class="col-md-5 img">
                            <a href="<?= $details_url ?>">
                                <img src="<?= $item->featured_image ?>"
                                    alt="<?= ($item->alt) ? $item->alt : $item->name ?>">
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
                                        <?= ($author_url == "super-admin") ? $item->author : "Dr." . " " . $item->author ?>
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
                {{$post_data->links()}}
            </div>
        </div>
    </div>
</section> -->
@endif

@endsection

@push('before-scripts')
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var owl = $('.posts-categories');

        owl.owlCarousel({
            items: 6,
            dots: false,
            nav: true,
            navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
            loop: $('.posts-categories .owl-item').length > 6 ? true : false,
            margin: 5,
            autoplay: $('.posts-categories .owl-item').length > 6 ? true : false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2,
                    loop: $('.posts-categories .owl-item').length > 2 ? true : false,
                },
                600: {
                    items: 4,
                    loop: $('.posts-categories .owl-item').length > 4 ? true : false,
                },
                1000: {
                    items: 6,
                    loop: $('.posts-categories .owl-item').length > 6 ? true : false,
                }
            }
        });


    });
</script>

@endpush