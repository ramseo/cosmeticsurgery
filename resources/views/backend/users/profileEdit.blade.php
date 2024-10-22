@extends('backend.layouts.app')

@section('title') {{ $module_action }} {{ $module_title }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ $module_title }}
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item route='{{route("backend.$module_name.show", $user->id)}}' icon='{{ $module_icon }}'>
        {{ $user->name }}
    </x-backend-breadcrumb-item>

    <x-backend-breadcrumb-item type="active">{{ $module_action }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')

@if(Session::has('flash_success'))
<p class="alert alert-info">
    {{ Session::get('flash_success') }}
</p>
@endif

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{$module_icon}}"></i>
                    <?= "Dr." . " " . $user->first_name . " " . $user->last_name . " " . "Profile" ?>
                    <small class="text-muted">
                        {{ __('labels.backend.users.edit.action') }}
                    </small>
                </h4>
                <div class="small text-muted">
                    Surgeons Management
                </div>
            </div>
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <button onclick="window.history.back();" class="btn btn-warning ml-1" data-toggle="tooltip" title="Return Back"><i class="fas fa-reply"></i></button>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs my-4" role="tablist">
            <li class="nav-item default-active-cls nav-switch active">
                <a class="nav-link default-active-cls active ancr" data-toggle="tab" href="#home" aria-expanded="true">
                    Profile Detail
                </a>
            </li>
             <li class="nav-item remove-default-active-cls nav-switch">
                <a class="nav-link ancr" data-toggle="tab" href="#doctor-content" aria-expanded="false">
                    Profile Content
                </a>
            </li>
          <!--  <li class="nav-item remove-default-active-cls nav-switch">
                <a class="nav-link ancr" data-toggle="tab" href="#doctor-results" aria-expanded="false">
                    Results.
                </a>
            </li> -->
        </ul>

        {{ html()->modelForm($userprofile, 'PATCH', route('backend.users.profileUpdate', $$module_name_singular->id))->class('form-horizontal')->attributes(['enctype'=>"multipart/form-data"])->open() }}
        <div class="tab-content">
            <div id="home" class="container default-active-cls tab-pane active in">
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                {{ html()->label(__('labels.backend.users.fields.avatar'))->class('form-control-label')->for('name') }}
                                <div class="form-group">
                                    <label for="file-multiple-input">Click here to update photo</label>
                                    <input id="file-multiple-input" name="avatar" multiple="" type="file" class="form-control-file">
                                    <small>Please upload a 200*200 size image</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <?php if (file_exists(public_path() . '/storage/user/profile/' . $user->avatar)) { ?>
                                    <img src="<?= asset('/storage/user/profile/' . $user->avatar) ?>" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;" />
                                <?php } else { ?>
                                    <img src="<?= asset($user->avatar) ?>" class="user-profile-image img-fluid img-thumbnail" style="max-height:200px; max-width:200px;" />
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'first_name';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "required";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'last_name';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'email';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->email($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'mobile';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'gender';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = "-- Select an option --";
                                    $required = "required";
                                    $select_options = [
                                        'Female' => 'Female',
                                        'Male' => 'Male',
                                        'Other' => 'Other',
                                    ];
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'date_of_birth';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $date_value = ($user->date_of_birth != "") ? $user->date_of_birth->toDateString() : "";
                                    $required = "";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    <div class="input-group date datetime" id="{{$field_name}}" data-target-input="nearest">
                                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->value($date_value)->attributes(["$required", 'type'=>'date']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'experience_years';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "required";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {!! Form::text($field_name, $userprofile->bio, ['class' => 'form-control','placeholder' => 'Experience Years', $required => $required]) !!}
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group tags-group">
                                    <?php
                                    $field_name = 'city[]';
                                    $field_lable = label_case($field_name);
                                    $field_relation = "city";
                                    $required = "required";

                                    if (!$user) {
                                    ?>
                                        {{ html()->label($field_lable, "city") }}
                                        {{ html()->select($field_name, ($module_name_singular) ?optional($module_name_singular->$field_relation)->pluck('name', 'id'):'')->class('form-control select2-cities')->attributes(['multiple']) }}
                                    <?php
                                    } else {
                                        $getSelectedTagVal = getSelectedCityVal(json_decode($user->city));
                                    ?>
                                        <label for="city">Cities</label>
                                        <span class="text-danger">*</span>
                                        <select name="city[]" class="form-control select2-cities" multiple>
                                            <?php
                                            if ($getSelectedTagVal) {
                                                foreach ($getSelectedTagVal as $item) {
                                            ?>
                                                    <option value="<?= $item['id'] ?>" selected>
                                                        <?= $item['name'] ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'address';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "required";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {!! Form::textarea($field_name, $userprofile->address, ['class' => 'form-control', 'rows' => 5, 'cols' => 10,'placeholder' => 'Address', $required => $required]) !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'education';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {!! Form::text($field_name, $userprofile->degree, ['class' => 'form-control','placeholder' => 'Education', $required => $required]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->submit($text = icon('fas fa-save')." Save")->class('btn btn-success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="doctor-content" class="container tab-pane fade">
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'content';
                                    $field_lable = label_case($field_name);
                                    $field_placeholder = $field_lable;
                                    $required = "required";
                                    ?>
                                    {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                    {!! Form::textarea($field_name, $userprofile->content, ['class' => 'form-control', 'rows' => 5, 'cols' => 10,'placeholder' => 'Address', $required => $required]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->submit($text = icon('fas fa-save')." Save")->class('btn btn-success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="doctor-results" class="container tab-pane fade">
                <div class="row">
                    <div class="table-responsive">
                        <table width="100%" id="datatable" class="table table-bordered table-hover table-responsive-sm">
                            <thead>
                                <th width="5%">#</th>
                                <th width="20%">Name</th>
                                <th width="60%">Status</th>
                                <th width="15%">Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ html()->closeModelForm() }}

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        Updated: {{$user->updated_at->diffForHumans()}},
                        Created at: {{$user->created_at->isoFormat('LLLL')}}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@push('after-styles')

<!-- Select2 Bootstrap 4 Core UI -->
<link href="{{ asset('vendor/select2/select2-coreui-bootstrap4.min.css') }}" rel="stylesheet" />

<!-- Date Time Picker -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-4-datetime-picker/css/tempusdominus-bootstrap-4.min.css') }}" />

@endpush

@push ('after-scripts')
<!-- Select2 Bootstrap 4 Core UI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            theme: "bootstrap",
            placeholder: "-- Select an option --",
            allowClear: true,
        });
    });
</script>

<!-- Date Time Picker & Moment Js-->
<script type="text/javascript" src="{{ asset('vendor/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap-4-datetime-picker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar-alt',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'far fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'fas fa-times'
            }
        });
    });
</script>
@endpush


@push ('after-scripts')
<script>
    $(document).ready(function() {

        $('.select2-cities').select2({
            theme: "bootstrap",
            multiple: true,
            placeholder: '@lang("Select an option")',
            minimumInputLength: 0,
            allowClear: true,
            ajax: {
                url: '{{route("frontend.users.get_user_cities")}}',
                dataType: 'json',
                data: function(params) {
                    return {
                        q: $.trim(params.term),
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });
</script>
@endpush

@push ('after-scripts')
<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
    CKEDITOR.replace('content', {
        filebrowserImageBrowseUrl: '/file-manager/ckeditor',
        language: '{{App::getLocale()}}',
        defaultLanguage: 'en',
        allowedContent: true
    });

    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
        });
    });

    // set file link
    function fmSetLink($url) {
        document.getElementById('featured_image').value = $url;
    }
</script>
@endpush

@push ('after-styles')
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push ('after-scripts')
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="text/javascript">
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('backend.customer.results.index',$user->id)}}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [{
            targets: [0, 1],
        }],
        "order": [
            [1, 'desc']
        ]
    });
</script>

@endpush