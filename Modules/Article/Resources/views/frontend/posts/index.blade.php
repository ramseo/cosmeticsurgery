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
                            <!-- <span class="tag tag-teal">
                                Technology
                            </span> -->
                            <h4>
                                <?= substr($item->name, 0, 40) . "..." ?>
                            </h4>
                            <p>
                                <?= strip_tags(substr($item->content, 0, 40) . "...") ?>
                            </p>
                            <div class="user">
                                <div class="blog-author-flex">
                                    <img src="<?= asset("img/default-avatar.jpg") ?>" alt="<?= $item->author ?>" />
                                    <div class="user-info">
                                        <h5>
                                            <a class="color-black" href="<?= url('/') . '/' . 'blog/author/' . $author_url ?>">
                                                <?= ($author_url == "super-admin") ? $item->author : "Dr." . " " . substr($item->author, 0, 10) ?>
                                            </a>
                                        </h5>
                                        <small>
                                            <?php
                                            $startDate = $item->published_at;
                                            $endDate = date('Y-m-d');
                                            $numberOfWeeks = (int)date("W", strtotime($endDate)) - (int)date("W", strtotime($startDate));
                                            echo $numberOfWeeks . "w ago";
                                            ?>
                                        </small>
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
            <?php } ?>
        </div>
        <div class="inner text-center">
            <div class="d-flex justify-content-center w-100 mt-3">
                <?= $post_data->links() ?>
            </div>
        </div>
    </div>
</section>

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