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
    
    <link rel="stylesheet" href="{{asset('library/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('library/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('library/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('library/plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{asset('backend/css/admin.css')}}?v=12">
    <script src="{{asset('library/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
    <script src="{{asset('library/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    @yield('style')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>

    {{-- <script type = "text/javascript">
    // var client = new Paho.MQTT.Client("broker.mqttdashboard.com", 8000, 'clientId-L7GFXMDlJK');

    //     // Connect to the MQTT broker
    //     client.connect({
    //         onSuccess: function () {
    //             // Send the "scan" message to the "rfid/remote" topic
    //             client.send('rfid/remote', 'scan');

    //             // Subscribe to the "rfid/rec/" topic
    //             client.subscribe('rfid/rec/');

    //             // Listen for incoming messages on the "rfid/rec/" topic
    //             client.onMessageArrived = function (message) {
    //                 $('#input__add-item-rfid').val(message);
    //                 $('#btn__submit_add-item').prop('disabled', false);
    //             };
    //         }
    //     });
        var max,at_OK;
        function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 5; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }
        // Create a client instance
        var client = new Paho.MQTT.Client("broker.hivemq.com", 8000, makeid());

        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        var options = {
            useSSL: false,
            userName: "",
            password: "",
            onSuccess:onConnect,
            onFailure:doFail
        }
        console.log("kết nối tới broker.hivemq.com:1883");
        // connect the client
        client.connect(options);

        function doFail(e){
            console.log(e);
        }

        function onConnect() //sự kiên kết nối thành công
        {
            console.log("kết nối : OK");
            client.subscribe("gateway1/rec");////đăng kí kênh nhận dữ liệu giám sat
            client.subscribe("gateway1/remote");// nhận dữ liêu về trạng thái thiết bị điều khiển
            client.subscribe("gateway2/rec");////đăng kí kênh nhận dữ liệu giám sat
            client.subscribe("gateway2/remote");// nhận dữ liêu về trạng thái thiết bị điều khiển
            client.subscribe("offline");
        }

        // called when the client loses its connection
        // function onConnectionLost(responseObject)
        // {
        //     if (responseObject.errorCode !== 0)
        //     {
        //         console.log(responseObject.errorMessage);
        //     }
        // }
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log('Connection lost: ' + responseObject.errorMessage);
            }
        }
        // var str = "Hello World";

        // var subStr = "World";
        // if(str.indexOf(subStr) !== -1){
        //     console.log(subStr + " có is a substring of " + str);
        // } else {
        //     console.log(subStr + " không is not a substring of " + str);
        // }
        // called when a message arrives
        function onMessageArrived(message)
        {
            // console.log(message.destinationName + ":" +message.payloadString);
            // document.getElementById("tinnhan").innerHTML = "Tin nhắn từ esp8266: " + message.payloadString;
            if (message.destinationName=="gateway1/rec"){
                var data = message.payloadString;
                var gateway_id =  1;
                console.log(data);
                if(data.indexOf('temp') !== -1){
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url:"{{route('sensor-store')}}",
                        method:"POST",
                        data:{data:data,gateway_id:gateway_id},
                        success:function(result)
                        {
                            console.log(result);
                            if(result.data){
                                var tbody = $('#tinnhan');
                                // Tạo một hàng mới
                                var newRow = $('<tr>');
                                // Thêm các ô mới vào hàng mới
                                newRow.append('<td><span class="temp">'+result.data.temperature+'</span>&deg;C</td>');
                                newRow.append('<td><span class="hum">'+result.data.humidity+'</span>%</td>');
                                newRow.append('<td><span class="bat">'+result.data.pin+'</span>%</td>');
                                // Thêm hàng mới vào đầu của phần tử <tbody>
                                tbody.prepend(newRow);
                                // $('#tinnhan').html(data);
                            }
                            
                        }
                    });
                }else{
                    var  arr = data.split("#");
                    var rl1 =  arr[0].split(":")[1];
                    var rl2 =  arr[1].split(":")[1];
                    if(rl1 == 0){

                        $('.gateway1 .box-light').removeClass('active');
                        $('.relay_1').bootstrapSwitch(); 
                        console.log($(this).bootstrapSwitch('state'));
                        $(".relay_1").prop("checked", false);
                        // $('.gateway1 .relay_1').removeClass('active');
                        console.log('ádasda');
                        
                    }
                    console.log(rl1);
                    console.log(arr); // ["rl1:0", "rl2:1", "bat:40"]


                }
            }
            if (message.destinationName=="gateway2/rec"){
                var data = message.payloadString;
                var gateway_id = 2;
                console.log(data);
                if(data.indexOf('temp') !== -1){
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url:"{{route('sensor-store')}}",
                        method:"POST",
                        data:{data:data,gateway_id:gateway_id},
                        success:function(result)
                        {
                            console.log(result);
                            if(result.data){
                                var tbody = $('#tinnhan');
                                // Tạo một hàng mới
                                var newRow = $('<tr>');
                                // Thêm các ô mới vào hàng mới
                                newRow.append('<td><span class="temp">'+result.data.temperature+'</span>&deg;C</td>');
                                newRow.append('<td><span class="hum">'+result.data.humidity+'</span>%</td>');
                                newRow.append('<td><span class="bat">'+result.data.pin+'</span>%</td>');
                                // Thêm hàng mới vào đầu của phần tử <tbody>
                                tbody.prepend(newRow);
                                // $('#tinnhan').html(data);
                            }
                            
                        }
                    });
                }
            }
            // if (message.destinationName ==="node_dt010134_remote") {
            //     var trangthai_tb = message.payloadString;
            //     console.log(trangthai_tb);
            //     $.ajax({
            //         url:"?controller=admin&action=dieukhien",
            //         method:"GET",
            //         data:{query:trangthai_tb},
            //         success:function(data)
            //         {
            //             $('#trangthai_tb_1').html(data);
            //         }
            //     });
            // }
        }
        function public (topic,data)
        {
            message = new Paho.MQTT.Message(data);
            message.destinationName = topic;
            client.send(message);
        }
    </script> --}}
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
<script src="{{asset('library/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('library/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('library/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('library/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('library/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('library/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('library/plugins/inputmask/jquery.inputmask.min.js')}}?v=12"></script>
<script src="{{asset('library/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>
<script src="{{asset('backend/js/admin.js')}}"></script>
<script src="{{asset('library/plugins/toastr/toastr.min.js') }}"></script>

<script type = "text/javascript">
        var max,at_OK;
        function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 5; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }
        // Create a client instance
        var client = new Paho.MQTT.Client("broker.hivemq.com", 8000, makeid());

        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        var options = {
            useSSL: false,
            userName: "",
            password: "",
            onSuccess:onConnect,
            onFailure:doFail
        }
        console.log("kết nối tới broker.hivemq.com:1883");
        // connect the client
        client.connect(options);

        function doFail(e){
            console.log(e);
        }

        function onConnect() //sự kiên kết nối thành công
        {
            console.log("kết nối : OK");
            client.subscribe("gateway1/rec");////đăng kí kênh nhận dữ liệu giám sat
            client.subscribe("gateway1/remote");// nhận dữ liêu về trạng thái thiết bị điều khiển
            client.subscribe("gateway2/rec");////đăng kí kênh nhận dữ liệu giám sat
            client.subscribe("gateway2/remote");// nhận dữ liêu về trạng thái thiết bị điều khiển
            client.subscribe("offline");
        }

        function onConnectionLost(responseObject)
        {
            if (responseObject.errorCode !== 0)
            {
                console.log(responseObject.errorMessage);
            }
        }
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log('Connection lost: ' + responseObject.errorMessage);
            }
        }
        function onMessageArrived(message)
        {
            // console.log(message.destinationName + ":" +message.payloadString);
            // document.getElementById("tinnhan").innerHTML = "Tin nhắn từ esp8266: " + message.payloadString;
            if (message.destinationName=="gateway1/rec"){
                var data = message.payloadString;
                var gateway_id =  1;
                console.log(data);
                if(data.indexOf('temp') !== -1){
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url:"{{route('sensor-store')}}",
                        method:"POST",
                        data:{data:data,gateway_id:gateway_id},
                        success:function(result)
                        {
                            console.log(result);
                            if(result.data){
                                var tbody = $('#gateway1');
                                // Tạo một hàng mới
                                var newRow = $('<tr>');
                                // Thêm các ô mới vào hàng mới
                                newRow.append('<td><span class="temp">'+result.data.temperature+'</span>&deg;C</td>');
                                newRow.append('<td><span class="hum">'+result.data.humidity+'</span>%</td>');
                                newRow.append('<td><span class="bat">'+result.data.pin+'</span>%</td>');
                                // Thêm hàng mới vào đầu của phần tử <tbody>
                                tbody.prepend(newRow);
                                // $('#tinnhan').html(data);
                            }
                            
                        }
                    });
                }else{
                    var  arr = data.split("#");
                    var rl1 =  arr[0].split(":")[1];
                    var rl2 =  arr[1].split(":")[1];
                    if(rl1 == 0){

                        $('.gateway1 .box-light-1').removeClass('active');
                        $('.relay_1').bootstrapSwitch("state", false);
                    }else{
                        $('.gateway1 .box-light-1').addClass('active');
                        $('.relay_1').bootstrapSwitch("state", true);
                    }
                    if(rl2 == 0){

                        $('.gateway1 .box-light-2').removeClass('active');
                        $('.relay_1').bootstrapSwitch("state", false);
                    }else{
                        $('.gateway1 .box-light-2').addClass('active');
                        $('.relay_2').bootstrapSwitch("state", true);
                    }
                }
            }
            if (message.destinationName=="gateway2/rec"){
                var data = message.payloadString;
                var gateway_id = 2;
                console.log(data);
                if(data.indexOf('temp') !== -1){
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url:"{{route('sensor-store')}}",
                        method:"POST",
                        data:{data:data,gateway_id:gateway_id},
                        success:function(result)
                        {
                            console.log(result);
                            if(result.data){
                                var tbody = $('#gateway2');
                                // Tạo một hàng mới
                                var newRow = $('<tr>');
                                // Thêm các ô mới vào hàng mới
                                newRow.append('<td><span class="temp">'+result.data.temperature+'</span>&deg;C</td>');
                                newRow.append('<td><span class="hum">'+result.data.humidity+'</span>%</td>');
                                newRow.append('<td><span class="bat">'+result.data.pin+'</span>%</td>');
                                // Thêm hàng mới vào đầu của phần tử <tbody>
                                tbody.prepend(newRow);
                                // $('#tinnhan').html(data);
                            }
                            
                        }
                    });
                }else{
                    var  arr = data.split("#");
                    var rl1 =  arr[0].split(":")[1];
                    var rl2 =  arr[1].split(":")[1];
                    if(rl1 == 0){

                        $('.gateway2 .box-light-1').removeClass('active');
                        $('.relay_1').bootstrapSwitch("state", false);
                    }else{
                        $('.gateway2 .box-light-1').addClass('active');
                        $('.relay_1').bootstrapSwitch("state", true);
                    }
                    if(rl2 == 0){

                        $('.gateway2 .box-light-2').removeClass('active');
                        $('.relay_1').bootstrapSwitch("state", false);
                    }else{
                        $('.gateway2 .box-light-2').addClass('active');
                        $('.relay_2').bootstrapSwitch("state", true);
                    }
                }
            }
        }
        function public (topic,data)
        {
            message = new Paho.MQTT.Message(data);
            message.destinationName = topic;
            client.send(message);
        }
    </script>

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
    $(document).ready(function(){
        $('.user_cms').select2({
            width: 'resolve'
        });
    });
</script>
@yield('script')
</html>
