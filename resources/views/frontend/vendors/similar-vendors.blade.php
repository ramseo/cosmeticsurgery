@php
    $similar_vendors = get_similar_vendors($type_id);
@endphp

@if($similar_vendors)
    <section id="photographers-section">
        <div class="container-fluid">
            <div class="col-xs-12 common-left-heading">
                <p class="head">Similar {{$type->name}}</p>
                <p class="grey-text">These are {{$type->name}} similar to '{{$vendor_details->business_name}}'</p>
            </div>
            <div class="row vendor-list-row">
                @foreach($similar_vendors as $similar_vendor)
                    @php 
                        $vendorCity = getData('cities', 'id', $similar_vendor->city_id);
                        $vendorType = getData('types', 'id', $similar_vendor->type_id); 
                    @endphp
                    <div class="col-xs-12 col-sm-4">
                        <div class="common-card vendor-card-col">
                            <div class="img-col">
                                <img src="images/real-story.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="text-col">
                                <ul class="list-inline space-list">
                                    <li>
                                        <p class="title">{{$similar_vendor->business_name}}</p>
                                        <p class="grey-text">{{$vendorCity->name}}</p>
                                    </li>
                                    <li class="text-right">
                                        <span class="vendor-rating"><i class="fa fa-star"></i> 5.0</span>
                                        <p><a href="#" class="grey-text">10 Reviews</a></p>
                                    </li>
                                </ul>
                                <ul class="list-inline vendor-card space-list v-center">
                                    <li>
                                        <p class="price"><span>Rs. 50,000</span></p>
                                    </li>
                                    <li class="text-right">
                                        <p class="grey-text" style="margin: 0px;">For 1 Day of Photo + Video</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- <div class="col-xs-12 col-sm-12 load-more-col text-center">
                <a href="#" class="btn btn-primary text-uppercase">Show more Photographers</a>
            </div> -->
        </div>
    </section>
@endif