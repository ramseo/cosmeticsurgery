@extends('backend.layouts.app')

@section('title')
Customer | Index
@endsection

@section('content')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-left: 10px;
        margin-right: 10px;
        margin-bottom: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2eb85c;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2eb85c;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .switch-flex-cls a {
        padding: 0.375rem 0.75rem;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="c-icon cil-people"></i>
                    Surgeons
                    <small class="text-muted">
                        Data Table
                    </small>
                </h4>
                <div class="small text-muted">
                    Surgeons Management Dashboard
                </div>
            </div>
            <div class="col-4">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route("backend.customer.index") }}" class="btn btn-secondary btn-sm ml-1" data-toggle="tooltip"><i class="fas fa-list-ul"></i> List</a>
                </div>
            </div>
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <div id="loadingImage">
                        <img src="<?= asset("img/giphy.gif") ?>">
                    </div>
                    <table class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('labels.backend.users.fields.name') }}</th>
                                <th>{{ __('labels.backend.users.fields.email') }}</th>
                                <th>{{ __('labels.backend.users.fields.status') }}</th>
                                <th class="text-center">{{ __('labels.backend.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            <?php
                            foreach ($surgeons as $doc) {
                                if ($doc->is_active == 1) {
                                    $checked = "checked";
                                } else {
                                    $checked = "";
                                }
                            ?>
                                <tr id="item-<?= $doc->id ?>">
                                    <td><?= $doc->id ?></td>
                                    <td><?= $doc->name ?></td>
                                    <td><?= $doc->email ?></td>
                                    <td><?= $doc->status ?></td>
                                    <td>
                                        <div class='switch-flex-cls'>
                                            <a href="<?= route("backend.customer.edit", $doc->id) ?>" class="btn btn-sm btn-primary mt-1" data-toggle="tooltip">
                                                <i class="fas fa-wrench"></i>
                                            </a>
                                            <label class="switch">
                                                <input onclick="userIsActive(this)" user_id="<?= $doc->id ?>" name="is_active" type="checkbox" <?= $checked ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
        ajax: "{{ route('backend.customer.index')}}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
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

    function userIsActive(elm) {
        var user_id = $(elm).attr("user_id");

        if ($(elm).is(":checked")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('backend.customer.is_active')}}",
                type: 'GET',
                data: {
                    is_active: 1,
                    user_id: user_id,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                }
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('backend.customer.is_active')}}",
                type: 'GET',
                data: {
                    is_active: 0,
                    user_id: user_id,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                }
            });
        }
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $('#sortable').sortable({
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
                url: '<?= route('backend.customer.sortable') ?>',
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