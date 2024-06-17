@extends('layouts.admin')
@section('title', 'Chỉnh sửa thông tin người dùng')
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
                    <li class="breadcrumb-item active">Chỉnh sửa thông tin người dùng</li>
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
                  <a href="{{ route('admin.user.index') }}" class="btn btn-info">
                    <i class="fas fa-arrow-left"></i> Quay lại
                  </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Họ tên</label>
                            <input type="text" value="{{ old('name', $user->name) }}" name="name" id="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone">Điện thoại</label>
                            <input type="text" value="{{ old('phone', $user->phone) }}" name="phone" id="phone" class="form-control">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" value="{{ old('email', $user->email) }}" name="email" id="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image">Hình</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if($user->image)
                                <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->name }}" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="gender">Giới tính</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nam</option>
                                <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address">Địa chỉ</label>
                            <input type="text" value="{{ old('address', $user->address) }}" name="address" id="address" class="form-control">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" value="{{ old('username', $user->username) }}" name="username" id="username" class="form-control">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Để trống nếu không thay đổi">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_re">Xác nhận mật khẩu</label>
                            <input type="password" name="password_re" id="password_re" class="form-control" placeholder="Để trống nếu không thay đổi">
                            @error('password_re')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="roles">Quyền</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value="customer" {{ $user->roles == 'customer' ? 'selected' : '' }}>Khách hàng</option>
                                <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Quản lý</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                              <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Chưa xuất bản</option>
                              <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Xuất bản</option>
                          </select>                
                          </div>
                    </div>
                </div>

                <div class="mb-3">
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
              </form>
        </div>
    </div>
</section>
@endsection
