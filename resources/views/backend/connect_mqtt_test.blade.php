<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset('backend/dist/img/logo.jpeg')}}" rel="shortcut icon" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{request()->getSchemeAndHttpHost()}}/library/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('library/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css')}}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{request()->getSchemeAndHttpHost()}}/backend/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{request()->getSchemeAndHttpHost()}}/library/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('library/plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{asset('backend/css/admin.css')}}?v={{VERSION}}">
    @yield('style')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<script type="text/javascript">
    var max, at_OK;

    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    // Create a client instance
    var client = new Paho.MQTT.Client("103.200.20.78", 1883, makeid());

    // set callback handlers
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    var options = {
        useSSL: false,
        userName: "esp32-iot",
        password: "thang123",
        onSuccess: onConnect,
        onFailure: doFail
    };

    // connect the client
    client.connect(options);

    function doFail(e) {
        console.log("kết nối thất bại");
        console.log(e);
    }

    function onConnect() {
        console.log("kết nối thành công");
        client.subscribe("lora0001_rec");
        client.subscribe("lora0001_remote");
        client.subscribe("offline");
    }

    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("Kết nối đã mất. Lỗi: " + responseObject.errorMessage);
        }
    }

    function onMessageArrived(message) {
        console.log("Nhận tin nhắn mới: " + message.payloadString);
    }
</script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-family: Arial;">
<div class="wrapper">

@include('backend.layout.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('backend.layout.sidebar-admin')

<!-- Content Wrapper. Contains page content -->
@yield('content')
<!-- /.content-wrapper -->
    @include('backend.layout.footer')
</div>
<!-- ./wrapper -->
<!-- jQuery -->

</body>
<script src="{{asset('library/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('library/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{asset('library/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('library/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('library/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>
<script src="{{asset('backend/js/admin.js')}}"></script>
<script src="{{asset('library/plugins/toastr/toastr.min.js') }}"></script>

<script>
    toastr.options = {
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000
    };

    @if(\Session::has('error'))
    toastr.error('{{ \Session::get('error') }}');
    @endif
        @if(\Session::has('success'))
        toastr["success"]('{{ \Session::get('success') }}');
    @endif
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>
@yield('script')
</html>
