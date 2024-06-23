@extends('layouts.site')
@section('title', 'Chi tiết sản phẩm')
@section('header')
@endsection

@section('content')
 <!-- Breadcrumb start -->
 <section class="breadcrumb container my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html" class="text-main">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
        </ol>
    </nav>
  </section>
  <!-- Breadcrumb end -->

  <!-- Product Detail Start -->
  <div class="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="{{ asset('images/products/'.$product->image)}}" alt="Product Image">                                
                            </div>                                    
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h2>{{$product->name}}</h2></div>
                                <div class="price">
                                    <h4>Giá:</h4>
                                    @if ($product->pricesale > 0)
                                        <p>{{ number_format($product->pricesale) }}₫ <span>{{ number_format($product->price) }}₫</span></p>
                                    @else
                                        <span>{{ number_format($product->price) }}₫</span>
                                    @endif
                                    
                                </div>
                                <div class="quantity">
                                    <h4>Số lượng:</h4>
                                    <div class="qty">
                                        <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                        <input id="qty" type="text" value="1" min="0" aria-describedby="basic-addon2">
                                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="p-size">
                                    <h4>Kích cỡ:</h4>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn bg-main text-white border">S</button>
                                        <button type="button" class="btn bg-main text-white border">M</button>
                                        <button type="button" class="btn bg-main text-white border">L</button>
                                        <button type="button" class="btn bg-main text-white border">XL</button>
                                    </div> 
                                </div>
                                <div class="action">
                                    <a onclick="handleAddCart({{ $product->id }})" class="btn border bg-main text-white input-group-text">
                                        <i class="fa-solid fa-cart-plus text-white"></i>Thêm vào giỏ hàng
                                    </a>
                                    <a class="btn border bg-main text-white" href="#"><i class="fa fa-shopping-bag text-white"></i>Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Side Bar Start -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-widget category">
                    <h2 class="title">Danh mục sản phẩm</h2>
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link mx-3 text-main" href="#">Thời trang nam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-3 text-main" href="#">Thời trang nữ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-3 text-main" href="#">Phụ kiện</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-3 text-main" href="#">Áo nam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-3 text-main" href="#">Áo nữ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> 

            <!-- Side Bar End -->
        </div>

        <div class="row">
            <div class="col-12">    
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="text-main fw-bold nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Mô tả</button>
                      <button class="text-main fw-bold nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Chi tiết</button>
                      <button class="text-main fw-bold nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Sản phẩm liên quan</button>
                      {{-- <button class="text-main fw-bold nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false" disabled>Disabled</button> --}}
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">{{ $product->description }}</div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">{{ $product->detail }}</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                        <div class="row">
                            @foreach ($list_product as $productitem)
                                <div class="col-lg-3">
                                    <x-card-product :$productitem/>                             
                                </div>                           
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">...</div> --}}
                  </div>
            </div>
        </div>
    </div>
  </div>
  <!-- Product Detail End -->

@endsection

@section('footer')
{{-- thêm sản phẩm vào giỏ hàng --}}
<script>
    function handleAddCart(productid) {
        let qty = document.getElementById("qty").value;
        $.ajax({
            url: "{{ route('site.addcart') }}",
            type: "GET",
            data: {
                productid: productid,
                qty: qty,
            },
            success: function (response) {
                document.getElementById("showqty").innerHTML = response.total_items;
                toastr.success(response.message, 'Thành công');
            },
            error: function (xhr, status, error) {
                toastr.error('Có lỗi xảy ra. Vui lòng thử lại.', 'Lỗi');
            }
        });
    }
</script>
{{-- tăng giảm số lượng sản phẩm --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnMinus = document.querySelector('.btn-minus');
        const btnPlus = document.querySelector('.btn-plus');
        const qtyInput = document.getElementById('qty');

        btnMinus.addEventListener('click', function () {
            let currentValue = parseInt(qtyInput.value);
            if (!isNaN(currentValue) && currentValue > 0) {
                qtyInput.value = currentValue - 1;
            }
        });

        btnPlus.addEventListener('click', function () {
            let currentValue = parseInt(qtyInput.value);
            if (!isNaN(currentValue)) {
                qtyInput.value = currentValue + 1;
            }
        });
    });
</script>
@endsection


