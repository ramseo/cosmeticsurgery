@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->meta_title}} @endsection

@section('site-meta-tags')
<meta name="description" content="{{ $$module_name_singular->meta_description ? $$module_name_singular->meta_description : setting('meta_keyword') }}">
@endsection


@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p class="cities_cls">
            <?= $$module_name_singular->name ?>
        </p>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mob-padd-null">
                <p class="identity">
                    <span>
                        DR. <?= $doctor_details->first_name . " " . $doctor_details->last_name ?>
                    </span>
                </p>
                <div class="row">
                    <div class="col-lg-2 doc-mar-cls">
                        <?php if (file_exists(public_path() . '/storage/user/profile/' . $doctor_details->avatar)) { ?>
                            <img src="<?= asset('/storage/user/profile/' . $doctor_details->avatar) ?>" alt="doctor img" class="doc-img-cls">
                        <?php } else { ?>
                            <img src="<?= asset("img/default-avatar.jpg") ?>" alt="doctor img" class="doc-img-cls">
                        <?php } ?>

                        <?php
                        $reviews = getReviewArray('vendor_reviews', 'user_id', $doctor_details->id);
                        $average = averageReview($reviews);
                        ?>

                        <div class="doc-star-rating-profile doc-img-cls">
                            <ul class="list-inline space-list">
                                <li class="list-inline-item">
                                    <ul class="list-inline">
                                        <?php
                                        $totalRating = 5;
                                        $starRating = $average;

                                        for ($i = 1; $i <= $totalRating; $i++) {
                                            if ($starRating < $i) {
                                                if (is_float($starRating) && (round($starRating) == $i)) {
                                                    echo "";
                                                } else {
                                                    echo "<li class='list-inline-item yellow-star'>
                                                               <i class='fa fa-star-o' aria-hidden='true'></i>
                                                             </li>";
                                                }
                                            } else {
                                                echo "<li class='list-inline-item yellow-star'>
                                                            <i class='fa fa-star'></i>
                                                         </li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-10 mob-text-center-cls">
                        <p>
                            <strong>
                                <i>
                                    Plastic Surgeon,
                                    <?php
                                    $profile_data = get_userprofiles($doctor_details->id);
                                    echo $profile_data->degree;
                                    ?>
                                </i>
                            </strong>
                        </p>
                        <p>
                            <strong>Years of Experience:</strong>
                            <?= $doctor_details->year_experience ?> years
                        </p>
                        <p>
                            <strong>Address:</strong>
                            <?= $doctor_details->address ?>
                        </p>
                        <p class="doc-details-cities">
                            <?= $citiesStr ?> India.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="doc-content">
    <div class="container">
        <div class="row">
            <div class="col padd-null">
                <?= $profile_data->content ?>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col mob-padd-null">
                <p class="identity">
                    Latest Reviews (<?= ($reviews->isNotEmpty()) ? count($reviews) : 0 ?>)
                </p>

                <div class="pull-right profile-write-review">
                    <a href="#" data-toggle="modal" data-target="#reviewModal">
                        Write a Review
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="clearfix"></div>

                <?php if ($reviews->isNotEmpty()) { ?>
                    <div class="detail-review-body">
                        <?php
                        foreach ($reviews as $rev) {
                        ?>
                            <div class="col-xs-12 single-review">
                                <div class="review-header">
                                    <p class="name review-title">
                                        <?= $rev->title ?>
                                    </p>
                                    <div class="rev-flex-cls">
                                        <ul class="list-inline rating-list">
                                            <li class="list-inline-item">
                                                <ul class="list-inline">
                                                    <?php
                                                    $totalRating = 5;
                                                    $starRating = $rev->rating;

                                                    for ($i = 1; $i <= $totalRating; $i++) {
                                                        if ($starRating < $i) {
                                                            if (is_float($starRating) && (round($starRating) == $i)) {
                                                                echo "";
                                                            } else {
                                                                echo "<li class='list-inline-item yellow-star'>
                                                               <i class='fa fa-star-o' aria-hidden='true'></i>
                                                             </li>";
                                                            }
                                                        } else {
                                                            echo "<li class='list-inline-item yellow-star'>
                                                            <i class='fa fa-star'></i>
                                                         </li>";
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="list-inline-item review-listing review-created-at">
                                                <?= date('d', strtotime($rev->created_at)) . " , " . date("F", strtotime($rev->created_at)) . " , " . date('Y', strtotime($rev->created_at)) ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="review-body">
                                    <p class="comment more-content-cls">
                                        <?= $rev->description ?>
                                    </p>
                                </div>

                                <?php
                                if (auth()->user()) {
                                    if (auth()->user()->username == $doctor_details->username || auth()->user()->username == "super_admin") {
                                ?>
                                        <div class="reply-review">
                                            <a href="javascript:void(0)" class="show_reply_popup" review_id="<?= $rev->id ?>">
                                                Reply
                                                <i class="fa fa-reply" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                <?php
                                    }
                                }
                                ?>

                                <!-- admin reply -->
                                <div id="AjaxUpdateReply-<?= $rev->id ?>">
                                    <?php
                                    $getReviewReply = getReviewReply($rev->id);
                                    foreach ($getReviewReply as $reply) {
                                    ?>
                                        <div class="admin-reply">
                                            <div class="col-xs-12 reply-review-cls">
                                                <div class="review-header">
                                                    <ul class="list-inline space-list">
                                                        <li>
                                                            <div class="rev-flex-cls">
                                                                <div class="img-col">
                                                                    <?php

                                                                    $doc_profile_img = asset('img/default-avatar.jpg');

                                                                    if ($reply->name == "Super Admin") {
                                                                        $doc_profile_img = asset('img/default-avatar.jpg');
                                                                    } else {
                                                                        if ($doctor_details->avatar) {
                                                                            if (file_exists(public_path() . '/storage/user/profile/' . $doctor_details->avatar)) {
                                                                                $doc_profile_img = asset('storage/user/profile/' . $doctor_details->avatar);
                                                                            }
                                                                        }
                                                                    }

                                                                    ?>
                                                                    <img src="<?= $doc_profile_img ?>" class="img-fluid" alt="user avatar">
                                                                </div>
                                                                <div class="text-col">
                                                                    <p class="name review-title">
                                                                        <?= $reply->name ?>
                                                                    </p>
                                                                    <ul class="list-inline rating-list">
                                                                        <li class="list-inline-item">
                                                                            <ul class="list-inline">
                                                                                <li class="list-inline-item review-listing">
                                                                                    <?= date('d', strtotime($reply->created_at)) . " , " . date("F", strtotime($reply->created_at)) . " , " . date('Y', strtotime($reply->created_at)) ?>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review-body">
                                                    <p class="comment more-content-cls">
                                                        <?= $reply->description ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- admin reply -->
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php if ($all_result_category->isNotEmpty()) { ?>
    <!-- before after results -->
    <section class="before-after-cls">
        <div class="container-fluid mtab pt-4 pb-4" style="background-color:#f8f8f8">
            <div class="container">
                <p class="identity text-center">
                    Dr. <?= $doctor_details->first_name . " " . $doctor_details->last_name . " " . ":" . " " . "before and after results" ?>
                </p>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a id="all_tab" class="nav-link active ancr" data-toggle="tab" href="#all" aria-expanded="true">
                            All 1
                        </a>
                    </li>
                    <?php
                    foreach ($all_result_category as $cat_tab) {
                        $explode = explode(" ", $cat_tab->name);
                        $href = strtolower(implode('-', $explode));
                        $get_tab_images = get_tab_images($cat_tab);

                        if ($get_tab_images->isNotEmpty()) {
                    ?>
                            <li class="nav-item">
                                <a onclick="eliminate_active_cls('#all_tab')" class="nav-link ancr" data-toggle="tab" href="<?= "#" . $href ?>" aria-expanded="false">
                                    <?= $cat_tab->name ?>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <div id="all" class="all_content container tab-pane active in">
                        <div class="row">
                            <?php
                            if ($all_result_category_imgs) {
                                foreach ($all_result_category_imgs as $img) {
                            ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <img src="<?= asset('storage/album') . '/' . $img->album_id . '/' . $img->name ?>" style="width:100%" alt="result image">
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    foreach ($all_result_category as $cat) {
                        $explode = explode(" ", $cat->name);
                        $target_id = strtolower(implode('-', $explode));
                        $get_tab_images = get_tab_images($cat);
                        if ($get_tab_images) {
                    ?>
                            <div id="<?= $target_id ?>" class="container tab-pane fade">
                                <div class="row">
                                    <?php foreach ($get_tab_images as $tab_img) { ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <img src="<?= asset('storage/album') . '/' . $tab_img->album_id . '/' . $tab_img->name ?>" style="width:100%">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <!-- before after results -->
<?php } ?>

<?php
$getDocPosts = getDocPosts($doctor_details->first_name . " " . $doctor_details->last_name);
if ($getDocPosts->isNotEmpty()) {
?>
    <!-- <section class="blog-list-half section-padding sub-bg">
        <div class="container">
            <p class="identity text-center">
                Dr. <?= $doctor_details->first_name . " " . $doctor_details->last_name . " " . ":" . " " . "Posts" ?>
            </p>
            <div class="row">
                <?php
                foreach ($getDocPosts as $item) {
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
        </div>
    </section> -->
<?php } ?>


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

<!-- doctor review popup -->
<div class="modal fade" id="reviewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="reachus-overlay">
                <div class="modal-header">
                    <button id="eliminate-val-error" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-header justify-content-center">
                    <h4 class="modal-title">
                        <div class="doc-title">
                            Dr. <?= $doctor_details->first_name . " " . $doctor_details->last_name ?>, MD
                        </div>
                        <p class="text-center margin-null">Plastic Surgery</p>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="review-form-main-col">
                        <div class="alert alert-danger reviewAlert" style="display: none;"></div>
                        <form id="reviewForm">
                            <div class="form-group stars-cls">
                                <div class="review-rating" data-rateit-mode="font" data-rateit-resetable="false"></div>
                                <input type="hidden" id="review-rating-hidden" value="0">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="reviewTitle" name="name" type="text" class="form-control" placeholder="Enter Name *">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="reviewPhone" name="phone" type="phone" class="form-control" placeholder="Enter Phone *">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="reviewEmail" name="email" type="email" class="form-control" placeholder="Enter Email *">
                            </div>
                            <div class="form-group mar-bottom-5">
                                <label for="">Your Review</label>
                                <textarea id="reviewDescription" class="form-control" placeholder="Enter Review *" cols="10" rows="5"></textarea>
                                <small>Your email address and phone number will not be published.</small><br>
                                <small>Required fields are marked *</small>
                            </div>
                            <div class="form-group save-btn-cls">
                                @auth
                                <input id="reviewUserId" type="hidden" value="{{Auth::user()->id}}">
                                @endauth
                                <input id="reviewDoctorId" type="hidden" value="{{$doctor_details->id}}">
                                <input type="submit" class="btn btn-primary submit-review" value="Submit Review">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- doctor review popup -->

<?php if (auth()->user()) { ?>
    <!-- Reply popup -->
    <div class="modal fade" id="replyModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reachus-overlay">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">
                            <div class="doc-title">
                                Dr. <?= $doctor_details->first_name . " " . $doctor_details->last_name ?>, MD
                            </div>
                            <p class="text-center margin-null">Plastic Surgery</p>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="review-form-main-col">
                            <div class="alert alert-danger replyAlert" style="display: none;"></div>
                            <form id="replyForm">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <?php if (auth()->user()->username == $doctor_details->username) { ?>
                                        <input id="replyTitle" value="<?= $doctor_details->first_name . " " . $doctor_details->last_name ?>" name="name" type="text" class="form-control" readonly>
                                    <?php } else { ?>
                                        <input id="replyTitle" value="Super Admin" name="name" type="text" class="form-control" readonly>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Your Reply</label>
                                    <textarea id="replyDescription" class="form-control" cols="10" rows="5"></textarea>
                                </div>
                                <div class="form-group save-btn-cls">
                                    <input name="update_review_id" id="update_review_id" type="hidden">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reply popup -->
<?php } ?>

@endsection

@push ("after-scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script>
    $(document).ready(function() {
        var options = {
            minMargin: 10,
            maxMargin: 35,
            itemSelector: ".item"
        };
        $(".containerCollage").justifiedGallery();

        $('#reviewForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('frontend.post-review')}}",
                data: {
                    '_token': "<?php echo csrf_token() ?>",
                    'user_id': $('#reviewUserId').val(),
                    'doctor_id': $('#reviewDoctorId').val(),
                    'name': $('#reviewTitle').val(),
                    'phone': $('#reviewPhone').val(),
                    'email': $('#reviewEmail').val(),
                    'rating': $('#review-rating-hidden').val(),
                    'description': $('#reviewDescription').val()
                },
                success: function(res) {
                    if (res.success) {
                        $('.reviewAlert').html('').hide();
                        $('#reviewForm').trigger('reset');
                        toastr.success(res.message, 'Review posted Successfully!');

                        setTimeout(function() {
                            $('#reviewModal').modal('hide');
                            $('#rateit-reset-2').trigger("click");
                        }, 1000);
                    } else {
                        console.log(res.message);
                        $('.reviewAlert').html(res.message).show();
                    }
                }
            });
        });

        $('#replyForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('frontend.post-reply')}}",
                data: {
                    '_token': "<?php echo csrf_token() ?>",
                    'review_id': $('#update_review_id').val(),
                    'doctor_id': '<?= $doctor_details->id ?>',
                    'avatar': '<?= $doctor_details->avatar ?>',
                    'name': $('#replyTitle').val(),
                    'your_reply': $('#replyDescription').val(),
                },
                success: function(res) {
                    console.log(res.review_id);

                    if (res.success) {
                        $('.replyAlert').html('').hide();
                        $('#replyForm').trigger('reset');
                        toastr.success(res.message, 'Reply posted Successfully!');

                        setTimeout(function() {
                            $('#replyModal').modal('hide');
                            if (res.reply_html) {
                                $("#AjaxUpdateReply-" + res.review_id).html(res.reply_html);
                            }
                        }, 1000);

                    } else {
                        console.log(res.message);
                        $('.replyAlert').html(res.message).show();
                    }
                }
            });
        });

    });

    $(document).on("click", '.show_reply_popup', function() {
        var review_id = $(this).attr("review_id");
        $("#update_review_id").val(review_id);

        $("#replyModal").modal("show");
    })
</script>

<script>
    $("#reviewModal").on('shown.bs.modal', function() {
        $('.review-rating').rateit({
            max: 5,
            step: 1,
            backingfld: '#review-rating-hidden'
        });
    });
</script>
@endpush