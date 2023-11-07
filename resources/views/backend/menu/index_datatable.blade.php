@extends('backend.layouts.app')

@section('title')Service @endsection
{{--@section('header-title') Manage Service @endsection--}}
{{--@section('styles') @endsection--}}


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="c-icon cil-people"></i>
                    <b class="text-capitalize"><?= $menuName->title ?></b>
                    <small class="text-muted">Menu Items</small>
                </h4>
                <div class="small text-muted">
                    Menu Management Dashboard
                </div>
            </div>
            <div class="col-4">
                <div class="btn-toolbar float-right">
                    <a href='{{ url("admin/menutype") }}' class="btn btn-secondary btn-sm ml-1">
                        <i class="fas fa-list-ul"></i>
                        List
                    </a>
                </div>
                <div class="float-right">
                    <a href="{{ route('backend.menus.create').'/'. $menu_id}}" class='btn btn-success btn-sm' title="{{__('Create')}}">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <div class="table table-bordered table-hover table-responsive-sm">
                        <div id="loadingImage">
                            <img src="<?= asset("img/giphy.gif") ?>">
                        </div>
                        <ul id="pagetree" class="ui-sortable ui-sortable-menu sortable-menu">
                            <?php
                            foreach ($menus as $item) {
                                $child_item = getChildItems($item->id);
                            ?>
                                <li class="parent_li" id="menu-<?= $item->id ?>">
                                    <table class="page_item">
                                        <tbody>
                                            <tr class="flex-cls-tr">
                                                <td class="page_item_name <?= ($child_item->isNotEmpty()) ? "" : "name-left-padd" ?>">
                                                    <?php if ($child_item->isNotEmpty()) { ?>
                                                        <i onclick="append_menu(this)" class="fa fa-plus-square" aria-hidden="true"></i>
                                                    <?php } ?>
                                                    <a target="_blank" href="<?= url("admin/menus/edit/$item->id") ?>">
                                                        <?php
                                                        echo $item->title . " " . "<span class='merlinCats'>" . $item->url . "</span>";
                                                        if ($child_item->isNotEmpty()) {
                                                            if ($child_item->count() > 0) {
                                                                echo "<span>[" . " " . $child_item->count() . " " . "]</span>";
                                                            }
                                                        }
                                                        ?>
                                                    </a>
                                                </td>
                                                <td class="menu_item_options">
                                                    <a href="<?= url("admin/menus/edit/$item->id") ?>" class="btn" title="Edit Service">
                                                        <i class="fas fa-wrench"></i>
                                                    </a>
                                                    <a href="<?= url("admin/menus/destroy/$item->menu_id/$item->id") ?>" class="btn del-review-popup" data-method="DELETE" data-token="<?= csrf_token() ?>" title="Delete" data-confirm="Are you sure?">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">

@endpush
@push ('after-scripts')
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="text/javascript">
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('backend.menus.index').'/'. $menu_id}}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'url',
                name: 'url'
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

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $('.sortable-menu').sortable({
        axis: 'y',
        update: function(event, ui) {
            $("#loadingImage").show();
            var data = $(this).sortable('serialize');

            $.ajax({
                data: {
                    data: data,
                    _token: '<?= csrf_token() ?>'
                },
                type: 'POST',
                url: '<?= route('backend.menus.sortable') ?>',
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        $("#loadingImage").hide();
                    }, 2000);
                },
                error: function(request, error) {
                    setTimeout(function() {
                        $("#loadingImage").hide();
                    }, 2000);
                    alert("FOUT:" + error);
                }
            });
        }
    });
</script>

@endpush