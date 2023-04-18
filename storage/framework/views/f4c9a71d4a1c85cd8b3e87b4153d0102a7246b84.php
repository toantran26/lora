<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link href="<?php echo e(asset('backend/dist/img/logo.jpeg')); ?>" rel="shortcut icon" type="image/x-icon">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('library/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css')); ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/backend/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(request()->getSchemeAndHttpHost()); ?>/library/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('library/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('library/plugins/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/plugins/toastr/toastr.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/admin.css')); ?>?v=12">
    <script src="<?php echo e(asset('library/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
    <script src="<?php echo e(asset('library/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('style'); ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>

    
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-family: Arial;">
<div class="wrapper">

<?php echo $__env->make('backend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
<?php echo $__env->make('backend.layout.sidebar-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Wrapper. Contains page content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- /.content-wrapper -->
    <?php echo $__env->make('backend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- ./wrapper -->
<!-- jQuery -->

</body>
<script src="<?php echo e(asset('library/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/bs-custom-file-input/bs-custom-file-input.min.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/inputmask/jquery.inputmask.min.js')); ?>?v=12"></script>
<script src="<?php echo e(asset('library/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('backend/dist/js/demo.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/admin.js')); ?>"></script>
<script src="<?php echo e(asset('library/plugins/toastr/toastr.min.js')); ?>"></script>

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
                        url:"<?php echo e(route('sensor-store')); ?>",
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
                        url:"<?php echo e(route('sensor-store')); ?>",
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

    <?php if(\Session::has('error')): ?>
    toastr.error('<?php echo e(\Session::get('error')); ?>');
    <?php endif; ?>
        <?php if(\Session::has('success')): ?>
        toastr["success"]('<?php echo e(\Session::get('success')); ?>');
    <?php endif; ?>
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $(document).ready(function(){
        $('.user_cms').select2({
            width: 'resolve'
        });
    });
</script>
<?php echo $__env->yieldContent('script'); ?>
</html>
<?php /**PATH /Users/ap24h/Desktop/iot/resources/views/backend/layout/index.blade.php ENDPATH**/ ?>