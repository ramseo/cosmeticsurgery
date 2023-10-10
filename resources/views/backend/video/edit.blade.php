@extends('backend.layouts.app')

@section('title') Edit Album @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("vendor.album.index")}}' icon='c-icon cil-people' >
        Album
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
                    <i class="c-icon cil-people"></i>  Service <small class="text-muted">Edit</small>
                </h4>
                <div class="small text-muted">
                    Album Management Dashboard
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route("vendor.video.index") }}" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" ><i class="fas fa-list-ul"></i> List</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                {{ html()->form('PATCH', route("vendor.video.update",$video->id))->class('form')->open() }}
                {{ Form::hidden('vendor_id', $video->vendor_id) }}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('url', 'URL') }} {!! fielf_required("required") !!}
                            {{ Form::textarea('url', $video->url, array('class' => 'form-control')) }}
                        </div>
                    </div>


                </div>
                <div class="row">
{{--                    <div class="col-6 ">--}}
{{--                        @php $type =  array(''=>'Select', 'youtube'=> 'YouTube','vimeo'=>'Vimeo');  @endphp--}}
{{--                        <div class="form-group">--}}
{{--                            {{ Form::label('type', 'Video Type') }}--}}
{{--                            {{ Form::select('type', $type, $video->type, array('class' => 'form-control')) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="form-group">--}}
{{--                            {{ Form::label('image', 'Image') }}--}}
{{--                            <div class="custom-file">--}}
{{--                                <input type="file" class="custom-file-input"  name="image">--}}
{{--                                <label class="custom-file-label">Choose file</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-6 col-md-4">
                        <div class="form-group">
                            {{ Form::label('order', 'Order') }}
                            {{ Form::text('order', $video->order, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            {{ Form::label('status', 'Status') }}
                            <br>
                            Enable {{ Form::radio('status', 1, $video->status == 1?  true : false) }}
                            Disable {{ Form::radio('status', 0, $video->status == 0 ? true : false) }}
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
                            @can('delete_service')
{{--                            <a href="{{route("backend.service.destroy", $service)}}" class="btn btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}" data-confirm="Are you sure?"><i class="fas fa-trash-alt"></i></a>--}}
                            @endcan
                            <a href="{{ route("vendor.album.index") }}" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}"><i class="fas fa-reply"></i> Cancel</a>
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
                    Updated: {{$video->updated_at->diffForHumans()}},
                    Created at: {{$video->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@stop
