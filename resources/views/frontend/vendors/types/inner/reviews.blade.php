@php
    $latestReviews = array();
    $latestReviews = getDataArray('vendor_reviews', array('type_id'=> $type->id, 'city_id' => $city->id));
@endphp

@if(count($latestReviews) > 0)
    <section id="latest-reviews">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 common-heading text-center with-lines">
                    <p class="shadow-text">Reviews</p>
                    <p class="head">Latest Reviews of {{$type->name}} on Wed.in</p>
                </div>
                <div class="col-xs-12 col-sm-12 row reviews-list-col">
                    @foreach($latestReviews as $review)
                        @php
                            $review_user = getData('users', 'id', $review->user_id);
                            $review_vendor = getData('vendors', 'id', $review->vendor_id);
                            $vendorCity = getData('cities', 'id', $review_vendor->city_id);
                            $vendorType = getData('types', 'id', $review_vendor->type_id);
                        @endphp
                        <div class="col-xs-12 col-sm-6 single-review">
                            <div class="review-header">
                                <ul class="list-inline space-list">
                                    <li>
                                        <div class="d-flex">
                                            <div class="img-col">
                                                <img src="https://cdn.landesa.org/wp-content/uploads/default-user-image.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="text-col">
                                                <p class="name">{{$review_user->first_name . ' '. $review_user->last_name}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="vendor-rating"><i class="fa fa-star"></i> {{number_format($review->rating, 1)}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="review-body">
                                <p>Review for - <a href="{{url('/') . '/' . $vendorType->slug . '/' . $vendorCity->slug . '/' . $review_vendor->slug }}">{{$review_vendor->business_name}}</a></p>
                                <p>{{$review->description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif