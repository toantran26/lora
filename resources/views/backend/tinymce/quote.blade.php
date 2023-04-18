
<!DOCTYPE html>
<html lang="vi">
<head>
<link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('library/editor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('library/editor/css/style-metro.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('library/editor/css/style.css?v=1')}}/" rel="stylesheet" type="text/css" />
    <link href="{{asset('library/editor/css/style-responsive.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
    <script src="{{asset('library/editor/js/jquery-1.10.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
    <style>
    body.block {font-family: Arial; overflow: hidden;}
    .nav_radio {float: left; margin-top: 7px;}
    .nav_radio label {display: inline-block; margin-right: 8px;}
    </style>
</head>

<body class="block">

<div style="padding: 15px;">
    <textarea name="info" class="m-wrap span12" style="height: 180px;" placeholder="Nội dung trích dẫn"></textarea>
    <input type="text" name="fullname" class="m-wrap span12" placeholder="Tên nhân vật" />
</div>

<div id="js_wrap_quote" class="hide">
    <div class="quote-inner expNoEdit" style="float: left; display: block; width: 165px; margin: 5px 13px 0 0; padding: 0; /*border-top: 8px solid #E0E0E0;*/">
        <div class="expEdit"><figure class="expNoEdit"><img src="{{asset('library/editor/img/no-photo.png')}}" width="500" height="375" /></figure></div>
        <blockquote class="quote expEdit" style="border: none; font-size: 15px; text-align: justify; line-height: 20px; margin: 0 0 8px; padding: 28px 0 0; max-width: 100%; color: #000;font-weight: bold;font-family: Arial;background: url(https://media.lyluanchinhtrivatruyenthong.vn/images/quote.png) no-repeat;"></blockquote>
        <p class="expEdit" style="font-size: 13px; color: #666; text-align: right;"></p>
    </div>
</div>

<div class="modal-footer">
    <div class="nav_radio">
        <label><input type="radio" name="type" value="left" checked="checked"/> Căn trái</label>
        <label><input type="radio" name="type" value="center" /> Căn giữa</label>
        <label><input type="radio" name="type" value="right"/> Căn phải</label>
    </div>
    <button type="button" id="btn_insert_content" class="btn green"><i class="icon-signout"></i> Chèn</button>
</div>


<script src="{{asset('library/editor/scripts/quote1.js?v=23d3')}}" type="text/javascript"></script>

</body>
</html>
