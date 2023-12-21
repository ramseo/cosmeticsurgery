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

<section class="blog-section">
    <div class="container">
        <h3 class="text-capitalize author-archive-cls">
            <?php if ($slug1 == "Superadmin") {  ?>
                Author Archives: <?= $slug ?>
            <?php } else { ?>
                Author Archives: <?= "Dr." . " " . $slug ?>
            <?php } ?>
        </h3>
        <div class="row">
            <?php
            foreach ($posts as $item) {
                $details_url = route("frontend.posts.show", [$item->slug]);
                $author_url = str_replace(' ', '-', strtolower($item->author));

                $author_img = asset("img/default-avatar.jpg");
                if ($item->author != "Super Admin") {
                    $get_author_img = get_author_img($item->created_by);
                    if (file_exists(public_path() . '/storage/user/profile/' . $get_author_img->avatar)) {
                        $author_img = asset('storage/user/profile/' . $get_author_img->avatar);
                    }
                }

            ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-section">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= $details_url ?>">
                                <img src="<?= $item->featured_image ?>" alt="<?= ($item->alt) ? $item->alt : $item->name ?>" />
                            </a>
                        </div>
                        <div class="card-body">
                            <h4>
                                <a class="color-black" href="<?= $details_url ?>">
                                    <?= substr($item->name, 0, 40) . "..." ?>
                                </a>
                            </h4>
                            <p>
                                <?= strip_tags(substr($item->content, 0, 40) . "...") ?>
                            </p>
                            <div class="user">
                                <div class="blog-author-flex">
                                    <a href="<?= url('/') . '/' . 'blog/author/' . $author_url ?>">
                                        <img src="<?= $author_img ?>" alt="<?= $item->author ?>" />
                                    </a>
                                    <div class="user-info">
                                        <h5>
                                            <a class="color-black" href="<?= url('/') . '/' . 'blog/author/' . $author_url ?>">
                                                <?= ($author_url == "super-admin") ? $item->author : "Dr." . " " . substr($item->author, 0, 10) ?>
                                            </a>
                                        </h5>
                                        <small>
                                            <?= date('F', strtotime($item->published_at)) . " " . date('d', strtotime($item->published_at)) . "," . date('Y', strtotime($item->published_at)) ?>
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
                <?= $posts->links() ?>
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