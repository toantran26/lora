<!DOCTYPE html>
<html lang="vi">

<head>
    <link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('library/editor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('library/editor/css/style-metro.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('library/editor/css/style.css?v=1')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('library/editor/css/style-responsive.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
    <script src="{{asset('library/editor/js/jquery-1.10.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>

    <style>
        body.block {
            font-family: Arial;
            overflow: hidden;
        }

        #wrap_quote {
            padding: 15px;
            height: 230px;
            overflow: hidden;
            font-family: Arial;
            font-size: 14px;
            line-height: 25px;
            color: #111;
        }

        #js_wrap_quote blockquote {
            max-width: 98%;
            float: none !important;
        }

        .nav_radio {
            float: left;
            margin-top: 7px;
        }

        .nav_radio label {
            display: inline-block;
            margin-right: 8px;
        }
        input[type="color"]{
            width: 50px;
            padding: 0;
            margin: 0;
        }
    </style>
    <title></title>
</head>

<body class="block">
    <div id="js_wrap_quote" class="hide">
        <blockquote class="expNoEdit box-tho" style="display: block; width: 165px;border: solid 1px #fff; text-align: justify;padding: 8px; margin: 0 8px 0 0; font-size: 13px; line-height: 17px;"></blockquote>
    </div>
    <div id="wrap_quote">
        <textarea name="info" class="m-wrap span12" style="height: 230px;"></textarea>
    </div>

    <div class="modal-footer">
        <div class="nav_radio">
            <label><input type="radio" name="type" value="bottom" checked="checked" /> Ngang</label>
        </div>
        <div class="nav_radio">
            <label><input type="color" id="border" name="border" value="#ffffff"> Màu khung</label>
            <label><input type="color" id="background" name="background" value="#ffffff"> Màu nền</label>
        </div>
        <button type="button" id="btn_insert_content" class="btn green"><i class="icon-signout"></i> Chèn</button>
    </div>


    <script src="{{asset('library/editor/scripts/info.min.js?v=032333s')}}" type="text/javascript"></script>

</body>

</html>
