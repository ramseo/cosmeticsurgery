@extends('frontend.layouts.app')

@section('title') {{$user->name}}'s Profile @endsection


@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("frontend.results.index")}}' icon='c-icon cil-people'>
        Album
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">Create</x-backend-breadcrumb-item>
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
                <div class="row justify-content-between">
                    <div class="one">
                        <h4 class="card-title mb-0">
                            <i class="c-icon cil-people"></i>
                            Result Categories
                            <small class="text-muted">
                                Data Table.
                            </small>
                        </h4>
                        <div class="small text-muted">
                            Categories Management Dashboard
                        </div>
                    </div>

                    <div class="two mar-right-50">
                        <a href='<?= route("frontend.results.create") ?>' class='btn btn-success btn-sm' data-toggle="tooltip" title="{{__('Create')}}">
                            Create <i class="fa fa-plus-circle"></i>
                        </a>

                        
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
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
    </div>

</section>
@endsection

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
        ajax: "{{ route('frontend.results.index')}}",
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