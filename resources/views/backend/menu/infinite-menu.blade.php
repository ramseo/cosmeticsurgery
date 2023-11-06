<ul id="ui-sortable_<?= $item->id ?>" class="ui-sortable ui-sortable-menu">
    <?php
    foreach ($menus as $item) {
        $child_item = getChildItems($item->id);
    ?>
        <li class="child_li" id="menu_<?= $item->id ?>">
            <table class="page_item">
                <tbody>
                    <tr class="flex-cls-tr">
                        <td class="page_item_name">
                            <?php if ($child_item->isNotEmpty()) { ?>
                                <i onclick="append_menu(this)" class="fa fa-plus-square" aria-hidden="true"></i>
                            <?php } ?>
                            <a target="_blank" href="<?= url("admin/menus/edit/$item->id") ?>">
                                <?php
                                echo $item->title;
                                if ($child_item->isNotEmpty()) {
                                    if ($child_item->count() > 0) {
                                        echo "<span>[" . " " . $child_item->count() . " " . "]</span>";
                                    }
                                }
                                ?>
                            </a>
                        </td>
                        <td class="merlinCats">
                            <span><?= $item->url ?></span>
                        </td>
                        <td class="menu_item_options">
                            <a href="<?= url("admin/menus/edit/$item->id") ?>" class="btn" data-toggle="tooltip" title="Edit Service">
                                <i class="fas fa-wrench"></i>
                            </a>
                            <a href="<?= url("admin/menus/destroy/$item->menu_id/$item->id") ?>" class="btn del-review-popup" data-method="DELETE" data-token="<?= csrf_token() ?>" data-toggle="tooltip" title="Delete" data-confirm="Are you sure?">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if ($child_item->isNotEmpty()) { ?>
                @include('backend.menu.infinite-menu', ['menus' => $child_item])
            <?php } ?>
        </li>
    <?php } ?>
</ul>