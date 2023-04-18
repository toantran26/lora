<!DOCTYPE html>

<head>
  <link href="{{asset('library')}}/editor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="{{asset('library')}}/editor/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link href="{{asset('library')}}/editor/css/style-metro.css" rel="stylesheet" type="text/css" />

  <link href="{{asset('library')}}/editor/css/style.css?v=1" rel="stylesheet" type="text/css" />
  <link href="{{asset('library')}}/editor/css/style-responsive.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="{{asset('library')}}/editor/bootstrap-fileupload/bootstrap-fileupload.css" />

  <link rel="stylesheet" type="text/css" href="{{asset('library')}}/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css" />

  <link rel="stylesheet" type="text/css" href="{{asset('library')}}/editor/bootstrap-daterangepicker/daterangepicker.css" />
  <script src="{{asset('library')}}/editor/js/jquery-1.10.1.min.js" type="text/javascript"></script>

  <link href="{{asset('library')}}/editor/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
  <link href="{{asset('library')}}/editor/css/image-crop.css" rel="stylesheet" type="text/css" />

  <style>
    body.image {
      font-family: Arial;
    }

    .nav_radio label {
      display: inline-block;
      margin-right: 8px;
    }

    #img_preview {
      max-width: 100% !important;
      max-height: 100% !important;
      width: auto !important;
      height: auto !important;
      position: absolute !important;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      margin: auto !important;
    }
  </style>
</head>

<body class="image">
  <div style="padding: 15px !important; ">
    <div class="tools" style="margin-bottom: 13px;">
      <div class="button-group">
        <button id="btn_resize" type="button" class="btn gray">Resize</button>
        <button id="btn_crop" type="button" class="btn gray">Crop</button>
        <!-- <button id="btn_paint" type="button" class="btn gray">Paint</button> -->
      </div>
      <div class="resize" style="display: none;">
        <button type="button" class="btn" disabled="disabled">Resize:</button>
        <input id="resize_w" type="text" class="m-wrap" style="width: 35px; text-align: center; margin-bottom: 0;" placeholder="W" />
        <button type="button" class="btn" disabled="disabled">X</button>
        <input id="resize_h" type="text" class="m-wrap" style="width: 35px; text-align: center; margin-bottom: 0;" placeholder="H" />
        <button type="button" class="btn red btn_ok"><i class="icon-ok"></i> OK</button>
        <button type="button" class="btn gray btn_cancel">Cancel</button>
      </div>
      <div class="crop" style="display: none;">
        <button type="button" class="btn" disabled="disabled">Crop:</button>
        <button type="button" class="btn red btn_ok"><i class="icon-ok"></i> OK</button>
        <button type="button" class="btn gray btn_cancel">Cancel</button>
        <input type="hidden" name="crop_x" id="crop_x" />
        <input type="hidden" name="crop_y" id="crop_y" />
        <input type="hidden" name="crop_w" id="crop_w" />
        <input type="hidden" name="crop_h" id="crop_h" />
      </div>
      <!-- <div class="paint" style="display: none;">
                <button type="button" class="btn" disabled="disabled">Paint:</button>
                <span>Loading ...</span>
            </div> -->
    </div>

    <div style="width: 100%; height: 316px; text-align: center; background: #eee; position: relative;">
      <img id="img_preview" src="" />
    </div>

    <div class="checkmb" style="display:none; padding-top:10px">
      <label>Chọn ảnh mobile:</label>
      <img id="img_mobile" src="" style="max-height: 200px;" />
      <div style="clear:both"></div>
      <input type="file" name="mb-image" id="mb-img" style="display: none;" />
    </div>

    <div>
      <label>Caption ảnh:</label>
      <textarea id="caption" name="caption" style="margin-top: 8px;" class="m-wrap span12" placeholder="Caption ..."></textarea>
    </div>

  </div>
  <div class="modal-footer">
    <div class="nav_radio" style="float: left;">
      <label><input type="radio" name="align" value="none" /> none</label>
      <label><input type="radio" name="align" value="left" /> Trái</label>
      <label><input type="radio" name="align" value="center" /> Giữa</label>
      <label><input type="radio" name="align" value="right" /> Phải</label>
      <label><input type="radio" name="align" value="large" /> Lớn</label>
      <label><input type="radio" name="align" value="full" /> Full</label>
      <label>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="check-img-mobile" id='check-img-mobile' /> Ảnh mobile</label>
    </div>

    <button type="button" id="btn_insert_content" class="btn green"><i class="icon-signout"></i> Update</button>
  </div>


  <script src="{{asset('library')}}/editor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


  <script src="{{asset('library')}}/editor/js/jquery.Jcrop.min.js" type="text/javascript"></script>

  <script src="{{asset('library')}}/editor/scripts/editimage.js?v=33" type="text/javascript"></script>

  <script>
    $("#check-img-mobile").change(function() {
      if (this.checked) {
        $('.checkmb').show();
        $('#mb-img').show();
      } else {
        $('.checkmb').hide();
      }
    });
    $("#mb-img").change(function() {
      //Lấy ra files
      var file_data = $('#mb-img').prop('files')[0];
      //lấy ra kiểu file
      var type = file_data.type;
      //Xét kiểu file được upload
      var match = ["image/gif", "image/png", "image/jpg", ];
      //kiểm tra kiểu file
      if (type == match[0] || type == match[1] || type == match[2]) {
        //khởi tạo đối tượng form data
        var form_data = new FormData();
        //thêm files vào trong form data

        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        console.log(csrfToken);
        form_data.append('file', file_data);
        form_data.append('_csrf_backend', csrfToken);
        //sử dụng ajax post
        $.ajax({
          url: '/admin/tinymce/uploadimagemobile', // gửi đến file upload.php
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(src) {
            $('#img_mobile').attr('src', src);
          }
        });
      } else {
        alert('Chỉ được upload file ảnh');
        $('#file').val('');
      }
    });
  </script>
</body>

</html>
