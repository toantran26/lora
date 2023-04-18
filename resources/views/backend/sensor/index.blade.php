@extends('backend.layout.index')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="p-2">
                        <a href="#" role="button" data-toggle="modal" data-target="#create_model"
                            class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách chuyên mục </h3>
                            <form class="card-tools" action="">
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
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Nhiệt độ</th>
                                        <th>Độ ẩm</th>
                                        <th>Acquy <i class="fas fa-car-battery"></i></th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listSensor as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->temperature }}</td>
                                            <td>{{ $value->humidity }}</td>
                                            <td>{{ $value->acquy }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>
                                                <div class=" text-center">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">
                                                        <span class="fas fa-cog"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" id="dropdown{{$value->id}}">
                                                        <li>
                                                            <a href="{{route('edit-sensor',['id'=>$value->id])}}">
                                                                <i class="fas fa-edit"></i>
                                                                Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li class="remove-button">
                                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa chuyên mục này?')" href="{{route('delete-cate',['id'=>$value->id])}}" >
                                                                <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                                            </a>
                                                        
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
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
<div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('node-store') }}" method="post" id="form_category">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới Node </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        @error('name')
                            <p style="color: red; font-size: 14px">* {{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <small id="code" class="form-text text-muted">Code</small>
                        <input type="text" name="code" class="form-control" id="code">
                    </div>
                    <div class="form-group">
                        <label for="rec">rec</label>
                        @error('rec')
                            <p style="color: red; font-size: 14px">* {{ $message }}</p>
                        @enderror
                        <input type="text" name="rec" class="form-control" id="rec">
                    </div>
                    <div class="form-group">
                        <label for="remote">remote</label>
                        @error('remote')
                            <p style="color: red; font-size: 14px">* {{ $message }}</p>
                        @enderror
                        <input type="text" name="remote" class="form-control" id="remote">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="submit_category">Lưu lại</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        @if ($errors->any())
            $('#create_model').modal('show');
        @endif
        $(document).ready(function () {
            $('#submit_category').click(function() { 
                $(this).prop('disabled', true);
                $('#form_category').submit(); 
            })
        });
    </script>
@endsection
