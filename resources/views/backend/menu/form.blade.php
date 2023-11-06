<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="parent_id">Parent</label>
            <select class="form-control" name="parent_id">
                <option value="0">Root</option>
                <?php
                $getMenuItems = getMenuItems($menu_id);
                foreach ($getMenuItems as $item) {

                    $selected = "";
                    if ($menuData) {
                        if ($item->id == $menuData->parent_id) {
                            $selected = "selected";
                        }
                    }

                ?>
                    <option value="<?= $item->id ?>" <?= $selected ?>>
                        <?= $item->title ?>
                    </option>
                <?php
                }
                ?>
            </select>

        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <?php
            $field_name = 'title';
            $field_lable = label_case('name');
            $field_placeholder = $field_lable;
            $required = "required";

            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->value($menuData->title) }}
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <?php
            $field_name = 'url';
            $field_lable = label_case($field_name);
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->value($menuData->url) }}
        </div>
    </div>
</div>