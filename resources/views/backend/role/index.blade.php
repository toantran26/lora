@extends('backend.layout.index')
@section('style')

@endsection
@section('content')
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('create-role')}}" class="btn btn-success end-0 m-2" style=""><i class="fas fa-plus"></i> Thêm mới</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách quyền </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên quyền</th>
                                    <th>Ngày tạo </th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_role as $key => $value)
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->created_at}}</td>
                                     
                                    <td>
                                        <div class=" text-center">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">
                                                <span class="fas fa-cog"></span>
                                            </a>
                                            <ul class="dropdown-menu" id="dropdown{{$value->id}}">
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-edit"></i>
                                                        Chỉnh sửa
                                                    </a>
                                                </li>
                                                <li class="remove-button">
                                                    <a  href="#" >
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Xóa 
                                                    </a>
                                                
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
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
