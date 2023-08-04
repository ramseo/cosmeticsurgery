@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->name}}'s Profile @endsection

@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>
            Dr. <?= $user->first_name . " " . $user->last_name . " " . "Profile" ?>
        </p>
    </div>
</div>
<!-- <section id="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> -->

<section id="user-profile-section">
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-12 user-profile-main-col">

            {{-- <div class="row text-right">--}}
            {{-- @if ($$module_name_singular->email_verified_at == null)--}}
            {{-- <p class="lead">--}}
            {{-- <a href="{{route('frontend.users.emailConfirmationResend', $$module_name_singular->id)}}">Confirm Email</a>--}}
            {{-- </p>--}}
            {{-- @endif--}}
            {{-- @include('frontend.includes.messages')--}}
            {{-- </div>--}}

        </div>
    </div>
</section>

<section class="profile-form-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                @include('frontend.users.menu')
            </div>
            <div class="col-xs-12 col-sm-9">
                @include('backend.includes.errors')
                <div class="card bg-white border-light shadow-soft flex-md-row no-gutters p-4">
                    <!-- <div class="card-body d-flex flex-column justify-content-between col-auto py-4 p-lg-5"> -->
                    <div class="card-body d-flex flex-column justify-content-between col-auto">
                        <div class="row mt-4 mb-4">
                            <div class="col">
                                {{ html()->form('PATCH', route('frontend.users.changePasswordUpdate', auth()->user()->username))->class('form-horizontal')->open() }}

                                <div class="form-group">
                                    {{ html()->label(__('labels.backend.users.fields.old_password'))->class('form-control-label')->for('old_password') }}
                                    <div class="password-container">
                                        {{ html()->password('old_password')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.users.fields.old_password'))
                                            ->required() }}
                                        <span class="displayPassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <!--form-group-->

                                <div class="form-group">
                                    {{ html()->label(__('labels.backend.users.fields.new_password'))->class('form-control-label')->for('new_password') }}
                                    <div class="password-container">
                                        {{ html()->password('new_password')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.users.fields.new_password'))
                                            ->required() }}
                                        <span class="displayPassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <!--form-group-->

                                <div class="form-group">
                                    {{ html()->label(__('labels.backend.users.fields.new_password_confirmation'))->class('form-control-label')->for('new_password_confirmation') }}
                                    <div class="password-container">
                                        {{ html()->password('new_password_confirmation')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.users.fields.new_password_confirmation'))
                                            ->required() }}
                                        <span class="displayPassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <!--form-group-->

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            {{ html()->button($text = "Save", $type = 'submit')->class('btn btn-primary btn-block') }}
                                        </div>
                                    </div>
                                </div>
                                {{ html()->closeModelForm() }}
                            </div>
                            <!--/.col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<script>

</script>