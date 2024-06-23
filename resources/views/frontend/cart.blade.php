@extends('layouts.site')
@section('title', 'Giỏ hàng')
@section('header')
@endsection

@section('content')
    <!-- Breadcrumb start -->
    <section class="breadcrumb container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-main">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
    </section>
    <!-- Breadcrumb end -->

    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 30px;" class="text-center">Mã</th>
                                        <th>Tên sản phẩm</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Thành tiền</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($list_cart as $row_cart)
                                        <tr>
                                            <td class="text-center">{{ $row_cart['id'] }}</td>
                                            <td>
                                                <div class="img">
                                                    <img style="width:120px" src="{{ asset('images/products/'.$row_cart['image']) }}" alt="{{ $row_cart['image'] }}">
                                                    <p>{{ $row_cart['name'] }}</p>
                                                </div>
                                            </td>
                                            <td>{{ number_format($row_cart['price']) }}</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus" style="background-color: #FD5634"><i class="fa fa-minus"></i></button>
                                                        <input type="text" value="{{ $row_cart['qty'] }}" 
                                                        name="qty[]" min="0" >
                                                    <button class="btn-plus" style="background-color: #FD5634"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>{{ number_format($row_cart['price']*$row_cart['qty']) }}</td>
                                            <td><button style="background-color: #FD5634"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                    @endforeach

                                 
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">                           
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Chi tiết</h1>
                                        <p>Tổng phụ<span>{{ number_format($total_price) }}</span></p>
                                        <p>Phí vẫn chuyển<span>0</span></p>
                                        <h2>Tổng cộng<span>{{ number_format($total_price) }} VNĐ</span></h2>
                                    </div>
                                    <div class="cart-btn">
                                        <button>Cập nhật giỏ hàng</button>
                                        <button>Thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

  

@endsection  

   
@section('footer')
@endsection