@extends('frontend.layouts.app')

@section ('title', '404 Error' . " - " . config('app.name'))

@section('content')
<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <p>Page Not Found</p>
    </div>
</div>
<div class="card margin-404">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <h2>Page Not Found</h2>
                    <p class="text-center">
                        <button onclick="window.history.back()" class="btn btn-warning ml-1" data-toggle="tooltip" title="" data-original-title="Return Back">
                            <i class="fa fa-reply"></i>
                            Return Back
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection