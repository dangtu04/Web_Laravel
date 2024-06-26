@extends('layouts.admin')
@section('title', 'Quản lý liên hệ')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý liên hệ</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Quản lý liên hệ</li>
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
                <a href="{{ route('admin.contact.trash')}}" class="btn btn-danger"><i class="fas fa-trash"></i> Thùng rác</a>
              </div>
            </div>
        </div>
        <div class="card-body">
            <table id="contact-table" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                      <th style="width: 30px">#</th>                                                       
                      <th>Tên liên hệ</th>
                      <th>Tên người dùng</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Tiêu đề</th>
                      <th style="width: 270px">Chức năng</th>
                      <th style="width: 30px">Replay_id</th>
                      <th style="width: 30px">ID</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($list as $row)
                    <tr>
                      <td class="text-center"><input type="checkbox" style="width: 20px"></td>
                     <td>{{$row->name}}</td>                  
                      <td>{{$row->username}}</td>
                      <td>{{$row->email}}</td>
                      <td>{{$row->phone}}</td>
                      <td>{{$row->title}}</td>
                      @php
                        $args = ['id' => $row->id];
                      @endphp
                       <td class="text-center">
                        @if($row->status == 1)
                          <a href="{{ route('admin.contact.status', $args)}}" class="btn btn-success"><i class="fas fa-toggle-on"></i></a>
                         @else
                          <a href="{{ route('admin.contact.status', $args)}}" class="btn btn-danger"><i class="fas fa-toggle-off"></i></a>
                        @endif 
                        <a href="{{ route('admin.contact.show', $args)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.contact.edit', $args)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('admin.contact.delete', $args)}}" class="btn btn-warning text-white"><i class="far fa-trash-alt"></i></a>
                      </td>
                      <td class="text-center">{{$row->replay_id}}</td>
                      <td class="text-center">{{$row->id}}</td>
                      
                    </tr>                    
                  @endforeach                  

                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

{{-- @section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#contact-table').DataTable();
    });
</script>
@endsection --}}
