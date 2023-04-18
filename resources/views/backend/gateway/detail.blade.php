@extends('backend.layout.index')
@section('style')
    <style>
        .width-800{
            width: 800px;
            margin: auto
        }

        @media only screen and (max-width: 600px) {
            .width-800{
                width: 100%;
                margin: auto
            }
            .small-box .icon {
                display: block !important;
            }
            .box-light .box-color-icon i {
                font-size: 36px !important;
            }
            .small-box {
                text-align: unset;
                padding-left: 10px;
            }
            .mb-mt-4{
                margin-top: 20px;
            }
        }
    </style>
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
                            <h3 class="card-title"> Thông tin chi tiết GateWay : {{ $data->name}} </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <div class="row width-800 pt-4 pb-4 {{$data->code}}">
                                <div class="col-lg-6 col-12">
                                    <div class="bg-box-top">
                                        <div class="p-3">
                                            <div class="pb-2 box-header">
                                                <div class="text_header">
                                                    <span>Điều khiển Đèn I</span>
                                                </div>
                                            </div>
                                            <div class="box-content pt-2 box-light box-light-1">
                                                <div class="small-box" style="box-shadow:none">
                                                    <div class="inner">
                                                        <div class="remote">    
                                                            <input type="checkbox" class="relay_1" name="relay_1" id="relay_1"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="ON"  data-off-text="OFF"  >
                                                        </div>
                                                    </div>
                                                    <div class="icon box-color-icon">
                                                        <i class="fas fa-lightbulb"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-mt-4">
                                    <div class="bg-box-top">
                                        <div class="p-3">
                                            <div class="pb-2 box-header">
                                                <div class="text_header">
                                                    <span>Điều khiển Đèn II</span>
                                                </div>
                                            </div>
                                            <div class="box-content pt-2 box-light box-light-2">
                                                <div class="small-box" style="box-shadow:none">
                                                    <div class="inner">
                                                        <div class="remote">    
                                                            <input type="checkbox" name="relay_2" id="relay_2" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                        </div>
        
                                                    </div>
                                                    <div class="icon box-color-icon">
                                                        <i class="fas fa-lightbulb"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Thông số giám sát </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nhiệt độ</th>
                                            <th>Độ ẩm</th>
                                            <th>Pin</th>
                                        </tr>
                                    </thead>
                                    <tbody id="{{$data->code}}">
                                        {{-- @foreach ($listGateWay as $key => $value)
                                        <tr>
                                          <td>{{ $value->code }}</td>
                                          <td>{{ $value->rec }}</td>
                                          <td>{{ $value->remote }}</td>
                                        </tr>
                                        @endforeach --}}
                                        @foreach ($listSensor as $key => $item)
                                        <tr>
                                            <td><span class="temp">{{$item->temperature}}</span>&deg;C</td>
                                            <td><span class="hum">{{$item->humidity}}</span>%</td>
                                            <td><span class="bat">{{$item->acquy}} </span>%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('gateway-store') }}" method="post" id="form_category">
                    @method('post')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới GateWay </h5>
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
            // $('input[name="relay_1"]').on('switchChange.bootstrapSwitch', function (event, state) {
            //     if (state === true) {
            //         // Checkbox được bật
            //         public('gateway'+{{$data->id}}+'/remote','on1');
            //         $(this).parents('.box-light').addClass('active');
            //         console.log('Checkbox được bật');
            //     } else {
            //         public('gateway'+{{$data->id}}+'/remote','off1');
            //         $(this).parents('.box-light').removeClass('active');
            //         // Checkbox được tắt
            //         console.log('Checkbox được tắt');
            //     }
            // });
            // $('input[name="relay_2"]').on('switchChange.bootstrapSwitch', function (event, state) {
            //     if (state === true) {
            //         // Checkbox được bật
            //         public('gateway'+{{$data->id}}+'/remote','on2');
            //         $(this).parents('.box-light').addClass('active');

            //         console.log('Checkbox được bật');
            //     } else {
            //         public('gateway1'+{{$data->id}}+'remote','off2');
                    
            //         // Checkbox được tắt 
            //         console.log('Checkbox được tắt');
            //     }
            // });
            $('input[name="relay_1"]').on('switchChange.bootstrapSwitch', function (event, state) {
                if (state === true) {
                    // Checkbox được bật
                    public('{{$data->code."/".$data->remote}}','on1');
                    $(this).parents('.box-light').addClass('active');
                    console.log('Checkbox được bật');
                } else {
                    public('{{$data->code."/".$data->remote}}','off1');
                    $(this).parents('.box-light').removeClass('active');
                    // Checkbox được tắt
                    console.log('Checkbox được tắt');
                }
            });
            $('input[name="relay_2"]').on('switchChange.bootstrapSwitch', function (event, state) {
                if (state === true) {
                    // Checkbox được bật
                    public('{{$data->code."/".$data->remote}}','on2');
                    $(this).parents('.box-light').addClass('active');

                    console.log('Checkbox được bật');
                } else {
                    public('{{$data->code."/".$data->remote}}','off2');
                    $(this).parents('.box-light').removeClass('active');

                    // Checkbox được tắt 
                    console.log('Checkbox được tắt');
                }
            });
        });
        
    </script>

@endsection
