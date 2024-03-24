@extends('frontend.layouts.app')

@section('title') {{$user->name}}'s Profile @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("frontend.results.index")}}' icon='c-icon cil-people'>
        Category
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">
        Create
    </x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>
            <?= "Dr." . " " . $user->first_name . " " . $user->last_name . " " . "Profile" ?>
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
                    <small class="text-muted">
                        Create
                    </small>
                </h4>
                <div class="small text-muted">
                    Categories Management Dashboard
                </div>
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="<?= route("frontend.results.index") ?>" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" title="Type List">
                        <i class="fa fa-list-ul"></i>
                        List
                    </a>
                </div>

                {{ html()->form('POST', route("frontend.results.store"))->class('form')->attributes(["enctype"=>"multipart/form-data"])->open() }}
                {{ Form::hidden('vendor_id', $user->id) }}
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
                                        <option value="<?= $res->title ?>">
                                            <?= $res->title ?>
                                        </option>

                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-group">
                            {{ Form::label('status', 'Status?') }}
                            <br>
                            Enable {{ Form::radio('status', 1, true) }}
                            Disable {{ Form::radio('status', 0) }}
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="file-multiple-input">Click here to update photo</label>
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
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {{ html()->button($text = "<i class='fa fa-plus-circle'></i> Create ", $type = 'submit')->class('btn btn-success') }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-warning" onclick="history.back(-1)">
                                    <i class="fa fa-reply"></i>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}

            </div>
        </div>
    </div>
</section>

@stop

<!-- code -->
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

        var elem1 = document.getElementById('button-image');
        if (elem1 !== null && elem1 !== 'undefined') {
            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            });
        }

    });
</script>

@endpush
<!-- code -->

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