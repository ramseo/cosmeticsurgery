<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="form-group">
            <?php
            $field_name = 'slug';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <!-- <div class="col-6 col-md-2">
        <div class="form-group">
            <?php
            // $field_name = 'order';
            // $field_lable = label_case($field_name);
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
            // $field_name = 'description';
            // $field_lable = label_case($field_name);
            // $field_placeholder = $field_lable;
            // $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div> -->

<!-- <div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php
            if (isset($$module_name_singular->image)) {
                $img_required = "";
            } else {
                $img_required = "required";
            }

            ?>
            {{ Form::label('image', 'Image') }} {!! fielf_required($img_required) !!}
            @if(isset($$module_name_singular->image))
            <div>
                @php
                $vendor_image = asset('img/default-vendor.jpg');
                if($$module_name_singular->image){
                if(file_exists( public_path().'/storage/categories/image/'. $$module_name_singular->image )){
                $vendor_image = asset('storage/categories/image/'.$$module_name_singular->image);
                }
                }
                @endphp
                <img width="200" id="imgPreview" src="{{ $vendor_image }}" alt="alt img" class="img-fluid">
            </div>
            @endif
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" <? //= $img_required 
                                                                            ?>>
                <label class="custom-file-label">Choose file</label>
                <small>Please upload W: 200 H: 200 file</small>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php
            // $field_name = 'alt';
            // $field_lable = label_case($field_name);
            // $field_placeholder = $field_lable;
            // $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

</div> -->


<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group">
            <?php
            $field_name = 'meta_title';
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
    <div class="col-12 col-sm-12">
        <div class="form-group">
            <?php
            $field_name = 'meta_keywords';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group">
            <?php
            $field_name = 'meta_description';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>