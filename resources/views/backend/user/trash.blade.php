@extends('layouts.admin')
@section('title', 'Thùng rác người dùng')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý người dùng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Quản lý người dùng</li>
          </ol>
        </div>
      </div>
    </div>
</section>
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-12 text-right">
          <a href="{{ route('admin.user.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
      </div>
    </div>
    
    <div class="card-body">
      
      {{-- @includeIf('components.message') --}}

      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th style="width: 30px">#</th>
            <th style="width: 130px">Hình ảnh</th>
            <th>Tên người dùng</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Vai trò</th>
            <th style="width: 200px">Chức năng</th>
            <th style="width: 30px">ID</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list as $row)
            <tr>
              <td class="text-center"><input type="checkbox" style="width: 20px"></td>
              <td class="text-center"><img src="{{ asset('images/users/'.$row->image) }}" style="width: 100px" alt="{{ $row->image }}"></td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->username }}</td>
              <td>{{ $row->email }}</td>
              <td>{{ $row->phone }}</td>
              <td>{{ $row->roles }}</td>
              @php
                $args = ['id' => $row->id];
              @endphp
              <td class="text-center">
                <a href="{{ route('admin.user.show', $args) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                <a href="{{ route('admin.user.restore', $args) }}" class="btn btn-success"><i class="fas fa-undo-alt"></i></a>
                <form class="d-inline" action="{{ route('admin.user.destroy', $args) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit" style="width:40px; height: 40px;">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>            
              </td>
              <td class="text-center">{{ $row->id }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection
