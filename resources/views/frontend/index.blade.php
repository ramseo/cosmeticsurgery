@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->meta_title}} @endsection

@section('content')
@php
$cities = getDataArray('cities');
$types = getDataArray('types');
@endphp

<!-- Banner search -->
@include('frontend.includes.banner-search')

<!-- Home content list -->
@include('frontend.includes.home-content')

<!-- Category list -->
@include('frontend.includes.category-list')

<!-- About block -->
@include('frontend.includes.about-block')

<!-- Home cities -->
@include('frontend.includes.home-cities')

@endsection