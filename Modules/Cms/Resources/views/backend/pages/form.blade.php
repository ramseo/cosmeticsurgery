<div class="row">
    <div class="col-5">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_lable = __("cms::$module_name.$field_name");
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <?php
            $field_name = 'slug';
            $field_lable = __("cms::$module_name.$field_name");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php
            $field_name = 'content';
            $field_lable = __("cms::$module_name.$field_name");
            $field_placeholder = $field_lable;
            $required = "required";
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
            $field_name = 'bottom_content';
            $field_lable = __("cms::$module_name.$field_name");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php
            // $field_name = 'featured_image';
            // $field_lable = __("cms::$module_name.$field_name");
            // $field_placeholder = $field_lable;
            // $required = "required";
            ?>
            {!! Form::label("$field_name", "$field_lable") !!} {!! fielf_required($required) !!}
            <div class="input-group mb-3">
                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image', 'aria-describedby'=>'button-image']) }}
                <div class="input-group-append">
                    <button class="btn btn-info" type="button" id="button-image"><i class="fas fa-folder-open"></i> @lang('Browse')</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_lable = __("cms::$module_name.$field_name");
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
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php
            $field_name = 'meta_title';
            $field_lable = __("cms::$module_name.$field_name");
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
            $field_lable = __("cms::$module_name.$field_name");
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
            $field_lable = __("cms::$module_name.$field_name");
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <!-- <div class="col-12 col-sm-6">
        <div class="form-group">
            <?php
            // $field_name = 'meta_og_image';
            // $field_lable = __("cms::$module_name.$field_name");
            // $field_placeholder = $field_lable;
            // $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div> -->
</div>
<!-- <div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php
            // $field_name = 'meta_og_url';
            // $field_lable = __("cms::$module_name.$field_name");
            // $field_placeholder = $field_lable;
            // $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div> -->

<!-- Select2 Library -->
<x-library.select2 />
<x-library.datetime-picker />

@push('after-styles')
<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('after-scripts')
<!-- Date Time Picker & Moment Js-->
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
        defaultLanguage: 'en',
        allowedContent: true
    });

    CKEDITOR.replace('bottom_content', {
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