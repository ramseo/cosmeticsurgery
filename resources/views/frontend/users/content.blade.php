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

            <div class="col-xs-12 col-sm-9">
                <h4 class="card-title mb-0">
                    <i class="c-icon cil-people"></i>
                    Content
                    <small class="text-muted">Add / Edit</small>
                </h4>
                <div class="small text-muted">
                    Content Management Dashboard
                </div>

                {{ html()->form('PATCH', route("frontend.content.update",$userprofile->user_id))->class('form')->attributes(["enctype"=>"multipart/form-data"])->open() }}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::textarea('content', $userprofile->content, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <div class="form-group">
                            {{ html()->submit($text = icon('fa fa-save')." Save")->class('btn btn-success') }}
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@stop


@push ('after-scripts')
<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
    CKEDITOR.replace('content', {
        filebrowserImageBrowseUrl: '/file-manager/ckeditor',
        language: '{{App::getLocale()}}',
        defaultLanguage: 'en',
        allowedContent: true,
    });

    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
        });
    });
</script>
@endpush