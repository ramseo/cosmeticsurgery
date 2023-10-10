@extends('backend.layouts.app')

@section('title') Vendor @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.vendor.index")}}' icon='c-icon cil-people' >
        Vendor
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">Edit</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="c-icon cil-people"></i>  Edit <small class="text-muted">Vendor</small>
                </h4>
                <div class="small text-muted">
                    Edit Management Vendor
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route("backend.vendor.index") }}" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" ><i class="fas fa-list-ul"></i> List</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                {{ Form::open(array('method' => 'post','url' => route('backend.vendor.update', $vendor->id) , 'files' => true,'id' => 'profileForm')) }}
                {{ Form::hidden('id', $vendor->id) }}
                <div class="row">
                    <div class="col-2" >
                        @php
                            $vendor_profile_img = asset('img/default-vendor.jpg');
                            if($vendor->image){
                                if(file_exists( public_path().'/storage/vendor/profile/'. $vendor->image )){
                                    $vendor_profile_img = asset('storage/vendor/profile/'.$vendor->image);
                                }
                            }
                        @endphp
                        {{--                                @if ($user->userImages->isEmpty())--}}
                        <img id="imgPreview" src="{{ $vendor_profile_img }}" alt="alt img" class="img-fluid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {{ Form::label('business_name', 'Business Name') }}
                            {{ Form::text('business_name', $vendor->business_name, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug') }}
                            {{ Form::text('slug', $vendor->slug, array('class' => 'form-control')) }}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {{ Form::label('phone', 'Phone Number') }}
                            {{ Form::text('phone', $vendor->mobile, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            {{ Form::label('wedding_covered', 'Number of weddings covered') }}
                            {{ Form::text('wedding_covered', $vendor->wedding_covered, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            {{ Form::label('image', 'Profile Image') }}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"  name="image">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {{ Form::label('price', 'Default Price') }}
                            {{ Form::number('price', $vendor->price, array('class' => 'form-control', 'placeholder'=> 'Service default price')) }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{ Form::label('label', 'Price Label') }}
                            {{ Form::text('label', $vendor->label, array('class' => 'form-control', 'placeholder'=> 'Price label')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('business_address', 'Address') }}
                            {{ Form::textarea('business_address', $vendor->business_address, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('travel_to_other_cities', 'Travel to other Indian cities?') }} {!! fielf_required("required") !!}
                            <br>
                           Yes  {{ Form::radio('travel_to_other_cities', 1, $vendor->travel_to_other_cities == 1?  true : false) }}
                           No {{ Form::radio('travel_to_other_cities', 0, $vendor->travel_to_other_cities == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('safety_assured', 'Safety Assured') }}
                            <br>
                            Yes  {{ Form::radio('safety_assured', 1, $vendor->safety_assured == 1?  true : false) }}
                            No {{ Form::radio('safety_assured', 0, $vendor->safety_assured == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('flexi_sure_policy', 'Flexi sure policy') }}
                            <br>
                            Yes  {{ Form::radio('flexi_sure_policy', 1, $vendor->flexi_sure_policy == 1?  true : false) }}
                            No {{ Form::radio('flexi_sure_policy', 0, $vendor->flexi_sure_policy == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('video_meetings', 'Video Meetings') }}
                            <br>
                            Yes  {{ Form::radio('video_meetings', 1, $vendor->video_meetings == 1?  true : false) }}
                            No {{ Form::radio('video_meetings', 0, $vendor->video_meetings == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('most_popular', 'Most Popular') }}
                            <br>
                            Yes  {{ Form::radio('most_popular', 1, $vendor->most_popular == 1?  true : false) }}
                            No {{ Form::radio('most_popular', 0, $vendor->most_popular == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('is_featured', 'Is Featured') }}
                            <br>
                            Yes  {{ Form::radio('is_featured', 1, $vendor->is_featured == 1?  true : false) }}
                            No {{ Form::radio('is_featured', 0, $vendor->is_featured == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('status', 'Approved') }}
                            <br>
                            Yes  {{ Form::radio('status', 1, $vendor->status == 1?  true : false) }}
                            No {{ Form::radio('status', 0, $vendor->status == 0 ? true : false) }}
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="form-group">
                            {{ Form::label('website_link', 'Website') }}
                            {{ Form::text('website_link', $vendor->website_link, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="form-group">
                            {{ Form::label('facebook_link', 'Facebook') }}
                            {{ Form::text('facebook_link', $vendor->facebook_link, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="form-group">
                            {{ Form::label('instagram_link', 'Instagram') }}
                            {{ Form::text('instagram_link', $vendor->instagram_link, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {{ html()->submit($text = icon('fas fa-save')." Save")->class('btn btn-success') }}
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="float-right">
                            {{--<a href="{{route("backend.profile")}}" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}"><i class="fas fa-reply"></i> Cancel</a>--}}
                        </div>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                     Updated: {{$vendor->updated_at->diffForHumans()}},
                     Created at: {{$vendor->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@stop

@push ('after-scripts')
    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush
