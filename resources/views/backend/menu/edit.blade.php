@extends('layouts.admin')
@section('title', 'Chỉnh sửa Menu')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý Menu</h1>
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
                <div class="col-12 text-right">
                  <a href="{{ route('admin.menu.index') }}" class="btn btn-info">
                    <i class="fas fa-arrow-left"></i> Quay lại
                  </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.menu.update',['id'=>$menu->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                  <label for="name">Tên Menu</label>
                  <input type="text" value="{{ old('name',$menu->name)}}" name="name" id="name" class="form-control">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="link">Liên kết</label>
                  <textarea name="link" id="link" class="form-control">{{ old('link',$menu->link)}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="position">Vị trí</label>
                    <select name="position" id="position" class="form-control">
                        <option value="mainmenu">Main Menu</option>
                        <option value="footermenu">Footer Menu</option>
                    </select>
                </div>
                <div class="mb-3">
                  <label for="status">Trạng thái</label>
                  <select name="status" id="status" class="form-control">
                    <option value="2" {{ ($menu->status==2)?'selected':'' }}>Chưa xuất bản</option>
                    <option value="1" {{ $menu->status==1?'selected':'' }}>Xuất bản</option>
                </select>                
                </div>
                <div class="mb-3">
                  <button type="submit" name="create" class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
                </div>
              </form>
        </div>
    </div>
</section>
@endsection
