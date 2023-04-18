@extends('backend.layout.index')
@section('style')
    <link rel="stylesheet"
        href="{{ request()->getSchemeAndHttpHost() }}/library/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="{{ request()->getSchemeAndHttpHost() }}/library/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ request()->getSchemeAndHttpHost() }}/library/plugins/jqvmap/jqvmap.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ request()->getSchemeAndHttpHost() }}/library/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ request()->getSchemeAndHttpHost() }}/library/plugins/summernote/summernote-bs4.min.css">
    <style>
        
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title"> Thông số giám sát </h3>
                </div>
                <!-- /.card-header -->
                <div class="">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-lg-6 max-height-box">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Giám sát gateway1</h3>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nhiệt độ</th>
                                                    <th>Độ ẩm</th>
                                                    <th>Pin</th>
                                                </tr>
                                            </thead>
                                            <tbody id="gateway1">
                                                @foreach ($listSensor1 as $key => $item)
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
                            <div class="col-lg-6 max-height-box">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Giám sát gateway 2</h3>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nhiệt độ</th>
                                                    <th>Độ ẩm</th>
                                                    <th>Pin</th>
                                                </tr>
                                            </thead>
                                            <tbody id="gateway2">
                                                @foreach ($listSensor2 as $key => $item)
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
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{asset('library/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('library/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->

    {{-- <script src="{{asset('library/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('library/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}

    <!-- jQuery Knob Chart -->
    <script src="{{asset('library/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('library/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('library/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('library/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('library/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{asset('backend/dist/js/pages/dashboard.js')}}?v=1"></script> --}}
    
@endsection
