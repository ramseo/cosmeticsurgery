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
            <div class="col-xs-12 col-sm-9 user-posts">
                <!-- ERR MSG FILE -->
                @include('frontend.includes.messages')
                <!-- ERR MSG FILE -->
                <div class="row justify-content-between">
                    <div class="one">
                        <h4 class="card-title mb-0">
                            <i class="c-icon cil-people"></i>
                            Post
                            <small class="text-muted">Add</small>
                        </h4>
                        <div class="small text-muted">
                            Posts Management Dashboard
                        </div>
                    </div>

                    <div class="two mar-right-50">
                        <a href="<?= route("frontend.profile_posts.index") ?>" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip" title="Type List">
                            <i class="fa fa-list-ul"></i>
                            List
                        </a>
                    </div>
                </div>

                {{ html()->form('POST', route("frontend.profile_posts.store"))->class('form')->open() }}

                <!-- fields -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'name';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "required";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'slug';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'author';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = "Author Name";
                            $required = "required";
                            $author = ucwords($user->first_name . " " . $user->last_name);
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->value($author)->placeholder($field_placeholder)->class('form-control')->attributes(["$required",'readonly']) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <?php
                            $field_name = 'intro';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <?php
                            $field_name = 'content';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "required";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'featured_image';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "required";
                            ?>
                            {!! Form::label("$field_name", "$field_lable") !!} {!! fielf_required($required) !!}

                            <?php
                            if (isset($module_name_singular->featured_image)) {
                                if ($module_name_singular->featured_image) {
                            ?>
                                    <br>
                                    <img width="150" src="<?= $module_name_singular->featured_image ?>" class="img-responsive">
                            <?php
                                }
                            }
                            ?>

                            <div class="input-group mb-3">
                                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image', 'aria-describedby'=>'button-image']) }}
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" id="button-image">
                                        <i class="fa fa-folder-open"></i>
                                        @lang('Browse')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'alt';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'status';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = __("Select an option");
                            $required = "required";
                            $select_options = [
                                '1' => 'Published',
                                '0' => 'Unpublished',
                                '2' => 'Draft'
                            ];
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <?php
                            $field_name = 'published_at';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            <div class="input-group date datetime" id="{{$field_name}}" data-target-input="nearest">
                                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control datetimepicker-input')->attributes(["$required", 'data-target'=>"#$field_name"]) }}
                                <div class="input-group-append" data-target="#{{$field_name}}" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group tags-group">
                            <?php
                            $field_name = 'related_posts[]';
                            $field_name_label = 'related_posts';
                            $field_lable = __("article::posts.$field_name_label");
                            $required = "";

                            $getRelatedlPostsArr = getRelatedlPostsArr();

                            $getSelectedPostVal = [];
                            if (isset($module_name_singular->related_posts)) {
                                if ($module_name_singular->related_posts) {
                                    $getSelectedPostVal = getSelectedRelatedPostsVal(json_decode($module_name_singular->related_posts));
                                }
                            }

                            if (!$getSelectedPostVal) {
                            ?>
                                {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                                {{ html()->select($field_name, $getRelatedlPostsArr)->class('form-control select2-related-posts')->attributes(["$required","multiple"]) }}
                            <?php } else { ?>
                                <label for="Related Posts">Related Posts</label>
                                <select name="<?= $field_name ?>" class="form-control select2-related-posts" multiple>
                                    <?php
                                    if ($getSelectedPostVal) {
                                        foreach ($getSelectedPostVal as $item) {
                                            if ($item['id'] == $module_name_singular->id) {
                                                continue;
                                            }
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
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'meta_title';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php
                            $field_name = 'meta_keywords';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <?php
                            $field_name = 'meta_description';
                            $field_lable = __("article::posts.$field_name");
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                        </div>
                    </div>
                </div>
                <!-- fields -->
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {{ html()->submit($text = icon('fa fa-save')." Save")->class('btn btn-success') }}
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="float-right">
                            <a href="<?= route('frontend.profile_posts.index') ?>" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}">
                                <i class="fa fa-reply"></i>
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</section>

@stop


<!-- Select2 Library -->
<x-library.select2 />
<x-library.datetime-picker />

@push('after-styles')
<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('after-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2-category').select2({
            theme: "bootstrap",
            placeholder: '@lang("Select an option")',
            minimumInputLength: 0,
            allowClear: true,
            ajax: {
                url: '{{route("backend.categories.index_list")}}',
                dataType: 'json',
                data: function(params) {
                    return {
                        q: $.trim(params.term)
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

<script type="text/javascript">
    $(function() {
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
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

<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
    CKEDITOR.replace('content', {
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

    function fmSetLink($url) {
        document.getElementById('featured_image').value = $url;
    }
</script>
@endpush

@push ('after-scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('.select2-related-posts').select2({
            theme: "bootstrap",
            multiple: true,
            placeholder: '@lang("Select an option")',
            minimumInputLength: 0,
            allowClear: true,
        });

    });
</script>

@endpush