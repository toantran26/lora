@extends('backend.layout.index')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('account-add') }}" class="btn btn-success end-0 m-2" style=""><i
                            class="fas fa-plus"></i> Thêm mới</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách tài khoản</h3>
                            <form class="card-tools" action="{{ route('account-list') }}">
                                {{-- <div class="card-tools"> --}}
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    @csrf
                                    <input type="text" name="keyword" value="{{ old('keyword', '') }}"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                                {{-- </div> --}}
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tài khoản</th>
                                        <th>Họ và tên</th>
                                        <th>Nhóm quyền</th>
                                        <th>Ngày tạo</th>
                                        @can('edit users')
                                            <th>Thao tác</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($account as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->username }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td><span class="badge badge-info">{{ $value->getRoleNames() }}</span></td>
                                            <td>{{ $value->created_at }}</td>
                                            @can('edit users')
                                                <td>
                                                    <div class=" text-center">
                                                        <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">
                                                            <span class="fas fa-cog"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" id="dropdown{{$value->id}}">
                                                            <li>
                                                                <a href="{{ route('post-account-edit', ['id' => $value->id]) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                    Chỉnh sửa
                                                                </a>
                                                            </li>
                                                            <li class="remove-button">
                                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" href="#" >
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Xóa 
                                                                </a>
                                                            
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
