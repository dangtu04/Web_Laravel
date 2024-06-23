@extends('layouts.site')
@section('title', 'Sản phẩm theo danh mục')
@section('header')

@endsection
@section('content')

    <!-- Breadcrumb start -->
    <section class="breadcrumb container my-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/DangThanhTu_Laravel_W1/public/" class="text-main">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
                <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                <li class="breadcrumb-item active" aria-current="page">{{$row->name}}</li>
            </ol>
        </nav>
    </section>
    <!-- Breadcrumb end -->

    <!-- Product start -->
    <section class="product my-3">
      <div class="container">
        <div class="row">

          @foreach ($list_product as $productitem)
            <div class="col-lg-3">
              <x-card-product :$productitem/>
             
            </div>
           
          @endforeach
          <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
              {{ $list_product->links() }}
            </div>
          </div>

         
          
        </div>
      </div>
    </section>
    <!-- Product end -->


@endsection

@section('footer')
@endsection