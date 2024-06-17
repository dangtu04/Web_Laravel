@extends('layouts.site')
@section('title', 'Trang chủ')
@section('header')

@endsection
@section('content')

    <!-- Menu start -->
    <x-main-menu/>
    <!-- Menu end -->

    <!-- Slider start -->
    <x-slider/>
    <!-- Slider end -->    

    <!-- Promotional Product start -->
    <x-promotional-product/>
    <!-- Promotional Product end -->
    
    <!-- Promotional Product start -->
    <x-new-product/>
    <!-- Promotional Product end -->

    <!-- Product Category start -->
    <x-product-category-home/>
    <!-- Product Category end -->

    <!-- Post start -->
    <x-last-post/>
    <!-- Post end -->
@endsection

@section('footer')
@endsection