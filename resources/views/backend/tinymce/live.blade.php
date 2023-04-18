<!DOCTYPE html>
<html lang="vi">

<head>
    <link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('library/editor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('library/editor/css/style-metro.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('library/editor/css/style.css?v=1')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('library/editor/css/style-responsive.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}" />
    <script src="{{asset('library/editor/js/jquery-1.10.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
    <style>
        body.block {
            font-family: Arial;
            overflow: hidden;
        }

        .nav_radio {
            float: left;
            margin-top: 7px;
        }

        .nav_radio label {
            display: inline-block;
            margin-right: 8px;
        }

        input[type="color"] {
            width: 50px;
            padding: 0;
            margin: 0;
        }

        .time-input {
            width: 50px !important;
            float: left;
        }

        .lb {
            float: left;
            margin-right: 15px;
            line-height: 40px;
        }
    </style>
</head>

<body class="block">

    <div style="padding: 15px;">
        <div class="row">
            <div class="col-md-6" style="width:50%;float:left">
                <span class="lb">Giờ</span>
                <input type="text" name="hours" value="<?= date('H') ?>" class="m-wrap span12 time-input" />

            </div>
            <div class="col-md-6" style="width:50%;float:left">
                <span class="lb">Phút</span>
                <input type="text" name="min" value="<?= date('i') ?>" class="m-wrap span12 time-input" />

            </div>
        </div>


        <textarea name="info" class="m-wrap span12" style="height: 180px;" placeholder="Nội dung"></textarea>

        <div id="js_wrap_live" class="hide">
            <div class="live-inner expNoEdit" style="display: flex; width: 100%;  padding: 5px; margin-bottom: 1em; border: 1px solid #f4f4f4;">
                <div class="expEdit time" style="float:left; width:60px; border-right:solid 1px #f4f4f4"></div>
                <div class="expEdit content" style="padding-left: 10px;width:100%"></div>
            </div>
        </div>
    </div>



    <div class="modal-footer">
        <div class="nav_radio">
            <label><input type="color" id="border" name="border" value="#f4f4f4"> Màu khung</label>
        </div>
        <button type="button" id="btn_insert_content" class="btn green"><i class="icon-signout"></i> Chèn</button>
    </div>


    <script src="{{asset('library/editor/scripts/live.js?v=1.9.631')}}" type="text/javascript"></script>

</body>

</html>
