@extends('frontend.layouts.app')

@section('title') {{$user->name}}'s Profile @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("frontend.results.index")}}' icon='c-icon cil-people'>
        Category
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">
        Edit
    </x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>
            Dr. <?= $user->first_name . " " . $user->last_name . " " . "Profile" ?>
        </p>
    </div>
</div>

<section class="profile-form-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-3 avatar-menu-bar">
                @include('frontend.users.menu')
            </div>

            <div class="col-xs-12 col-sm-9">
                <h4 class="card-title mb-0">
                    <i class="c-icon cil-people"></i>
                    Category
                    <small class="text-muted">Edit</small>
                </h4>
                <div class="small text-muted">
                    Categories Management Dashboard
                </div>
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="<?= route("frontend.results.index") ?>" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" >
                        <i class="fa fa-list-ul"></i>
                        List
                    </a>
                </div>

                {{ html()->form('PATCH', route("frontend.results.update",$album->id))->class('form')->attributes(["enctype"=>"multipart/form-data"])->open() }}
                {{ Form::hidden('vendor_id', $album->vendor_id) }}

                <div class="row">
                    <div class="col-12 col-md-6 padd-null">
                        <div class="form-group">
                            {{ Form::label('name', 'Name') }} {!! fielf_required("required") !!}
                            <select name="name" id="result-categories" class="form-group res-cat">
                                <?php
                                $get_cat_res = dynamic_menu('menutype', 'url', 'result-categories');
                                if ($get_cat_res) {
                                    foreach ($get_cat_res as $res) {
                                ?>
                                        <option value="<?= $res->title ?>" <?= ($album->name == $res->title) ? "selected" : "" ?>>
                                            <?= $res->title ?>
                                        </option>

                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('status', 'Status') }}
                            <br>
                            Enable {{ Form::radio('status', 1, $album->status == 1?  true : false) }}
                            Disable {{ Form::radio('status', 0, $album->status == 0 ? true : false) }}
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <?php
                            // Form::label('image', 'Image');
                            // if ($album->image) {
                            //     if (file_exists(public_path() . '/storage/album/image/' . $album->image)) {
                            ?>
                                    <img id="imgPreview" src="<? //= asset('storage/album/image/' . $album->image) 
                                                                ?>" alt="img" class="img-fluid">
                            <?php
                            //     }
                            // }
                            ?>
                            <label for="file-multiple-input">
                                Click here to update photo
                            </label>
                            <input id="file-multiple-input" name="image" type="file" class="form-control-file" accept="image/gif, image/jpeg, image/png">
                            <small>
                                Server max upload size is : <? //= ini_get("upload_max_filesize") 
                                                            ?>
                            </small>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('description', 'Description') }}
                            {{ Form::textarea('description', $album->description, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {{ html()->submit($text = icon('fa fa-save')." Save")->class('btn btn-success') }}
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="float-right">
                            <a href="<?= route('frontend.results.index') ?>" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}">
                                <i class="fa fa-reply"></i>
                                Cancel
                            </a>
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
                    Updated: {{$album->updated_at->diffForHumans()}},
                    Created at: {{$album->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</section>

@stop


@push ('after-scripts')
<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserImageBrowseUrl: '/file-manager/ckeditor',
        language: '{{App::getLocale()}}',
        defaultLanguage: 'en'
    });

    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
        });
    });
</script>
@endpush


@push('after-styles')
<link href="{{ asset('vendor/select2/select2-coreui-bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@push ('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $('.res-cat').select2({
            theme: "bootstrap",
            placeholder: '@lang("Select an option")',
            minimumInputLength: 0,
            allowClear: true,
        });
    });
</script>
@endpush