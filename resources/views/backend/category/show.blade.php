@extends('layouts.admin')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chi tiết danh mục</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">

    <div class="card">
        <div class="card-header">
            <div class="row">
                @php
                    $args = ['id' => $category->id];
                @endphp
                <div class="col-12 text-right">
                    <a href="{{ route('admin.category.edit', $args) }}" class="btn btn-sm btn-primary">
                        <i class="far fa-edit"></i> Sửa
                    </a>
                    <a href="{{ route('admin.category.delete', $args) }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Xóa
                    </a>
                    <a class="btn btn-sm btn-info" href="category_index.html">
                        <i class="fa fa-arrow-left"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th style="width: 30px">#</th>
                <th style="width: 150px">Hình ảnh</th>
                <th>Tên danh mục</th>
                <th>Danh mục cha</th>
                <th>Slug</th>
                <th>Thứ tự</th>
                <th>Mô tả</th>
                <th>Ngày tạo</th>
                <th>Ngày Cập nhật</th>
                <th>Người tạo</th>
                <th>Người cập nhật</th>
                <th>Trạng thái</th>
                <th style="width: 30px">ID</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td class="text-center"><input type="checkbox" style="width: 20px"></td>
                  <td class="text-center"><img src="{{ asset('images/categories/'.$category->image) }}" style="width: 100px" alt="{{ $category->image }}"></td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->parent_id }}</td>
                  <td>{{ $category->slug }}</td>
                  <td>{{ $category->sort_order }}</td>
                  <td>{{ $category->description }}</td>
                  <td>{{ $category->created_at }}</td>
                  <td>{{ $category->updated_at }}</td>
                  <td>{{ $category->created_by }}</td>
                  <td>{{ $category->updated_by }}</td>
                  <td>{{ $category->status }}</td>
                  <td class="text-center">{{ $category->id }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    </section>
@endsection
