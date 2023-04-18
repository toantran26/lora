<!DOCTYPE html>

<head>
  <link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('library/editor/bootstrap/css/bootstrap-responsive.min.css')}}" type="text/css" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link href="{{asset('library/editor/css/style-metro.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{asset('library/editor/css/style.css?v=1')}}" />
  <link href="{{asset('library/editors/css/style-responsive.css')}}" />

  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/dropzone/dropzone.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/bootstrap-daterangepicker/daterangepicker.css')}}" />
  <script src="{{asset('library/editor/js/jquery-1.10.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('library/editor/scripts/jquery.ui.datepicker-vn.js')}}" type="text/javascript"></script>

  <style>
    body.image {
      padding: 15px !important;
      font-family: Arial;
    }

    body.image .tab_btn {
      margin-bottom: 15px;
    }

    body.image #tab-4 {
      border: 1px solid rgba(0, 0, 0, 0.03);
      border-radius: 3px;
      background: rgba(0, 0, 0, 0.03);
      padding: 23px;
    }

    body.image .meet-our-team {
      position: relative;
    }

    body.image .meet-our-team svg {
      display: none;
      position: absolute;
      top: 3px;
      left: 3px;
      fill: #FFF;
      cursor: pointer;
    }

    body.image .meet-our-team.s0:hover svg.orgUxc {
      display: inline-block;
    }

    body.image .meet-our-team.s1 svg.rqet2b {
      display: inline-block;
      opacity: 0.8;
    }

    body.image .meet-our-team.s1:hover svg.rqet2b {
      display: none;
    }

    body.image .meet-our-team.s1:hover svg.orgUxc {
      display: inline-block;
    }

    body.image .meet-our-team.active svg.eoYPIb {
      display: inline-block;
    }

    body.image .meet-our-team.active svg.orgUxc {
      display: inline-block;
      fill: #4285f4;
    }

    body.image .meet-our-team .team-info {
      white-space: nowrap;
      overflow: hidden;
      -ms-text-overflow: ellipsis;
      -o-text-overflow: ellipsis;
      text-overflow: ellipsis;
    }

    body.image #my-awesome-dropzone {
      position: relative;
    }

    body.image #my-awesome-dropzone label {
      position: absolute;
      left: 0;
      bottom: -30px;
    }

    ul.pagination {
      margin: 0;
    }
  </style>
</head>

<body class="image">

  <div class="row-fluid tab_btn">
    <a href="#tab-1" class="btn <?= ($tab == 1) ? 'red' : 'blue' ?>"><i class="icon-plus icon-white"></i> Tải lên</a>
    <a href="#tab-2" class="btn <?= ($tab == 2) ? 'red' : 'blue' ?>"><i class="icon-picture icon-white"></i> Đã tải lên từ bài này</a>
    <a href="#tab-3" class="btn <?= ($tab == 3) ? 'red' : 'blue' ?>"><i class="icon-picture icon-white"></i> Tất cả</a>
    <a href="#tab-4" class="btn <?= ($tab == 4) ? 'red' : 'blue' ?>"><i class="icon-download-alt icon-white"></i> Chèn từ URL</a>
    <a href="#" id="btn_insert_content" class="btn green pull-right" style="display: none;"><i class="icon-signout"></i> Chèn vào bài</a>
  </div>

  <div id="tab-1" class="tab_content <?= ($tab == 1) ? '' : 'hide' ?>">
    <form action="{{route('images-action')}}" method="post" enctype="multipart/form-data" class="dropzonez" id="my-awesome-dropzone">
      @csrf
      <label class="checkbox-fix"><input type="checkbox" name="wm" value="1"> Đóng dấu ảnh</label>
      <div class="dz-default dz-message" data-dz-message=""><span>Drop files here to upload</span></div>
    </form>
  </div>

  <div id="tab-2" class="tab_content <?= ($tab == 2) ? '' : 'hide' ?>">
    <div style="min-height: 390px;">
      <div class="row-fluid">
        <?php
        $i = 0;
        foreach ($media as $row) { ?>
          <div class="span3">
            <div class="meet-our-team s0 img-list-edit" id="oneImage_<?=$row->id?>">
              <a href="<?=  $row->link ?>" data-width="1554" data-height="1330" class="btn_Insert">
                <img src="<?=  $row->link ?>" alt=""></a>
              <div class="team-info">
                <p><a href="#" title="" class="editable editable-click editable-empty" data-pk="27860" data-placement="right" data-original-title="Nhập Caption"><?= $row->name ?></a></p>
              </div>
              <svg width="24px" height="24px" class="rqet2b" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path>
              </svg>
              <svg width="24px" height="24px" class="eoYPIb" viewBox="0 0 24 24">
                <circle cx="12.5" cy="12.2" r="8.292"></circle>
              </svg>
              <svg width="24px" height="24px" class="orgUxc" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
              </svg>
            </div>
          </div>
        <?php
          $i++;

          if ($i % 4 == 0) {
            echo '</div><div class="row-fluid">';
          }
        } ?>
      </div>
    </div>
  </div>

  <div id="tab-3" class="tab_content <?= ($tab == 3) ? '' : 'hide' ?>">
    <div style="min-height: 390px;">
      <div class="row-fluid">
        <?php
        $i = 0;
        foreach ($models as $row) { ?>
          <div class="span3">
            <div class="meet-our-team s0 img-list-edit" id="oneImage_27852">
              <a href="<?=  $row->link ?>" data-width="984" data-height="291" class="btn_Insert">
                <img src="<?=  $row->link ?>" alt="" />
              </a>
              <div class="team-info">
                <p><a href="#" title="" class="editable" data-pk="27852" data-placement="right" data-original-title="Nhập Caption"><?= $row->name ?></a></p>
              </div>
              <svg width="24px" height="24px" class="rqet2b" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path>
              </svg>
              <svg width="24px" height="24px" class="eoYPIb" viewBox="0 0 24 24">
                <circle cx="12.5" cy="12.2" r="8.292"></circle>
              </svg>
              <svg width="24px" height="24px" class="orgUxc" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
              </svg>
            </div>
          </div>
        <?php
          $i++;

          if ($i % 4 == 0) {
            echo '</div><div class="row-fluid">';
          }
        } ?>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="control" method="get" action="{{route('images-action')}}" style="margin:20px 0 0;float: left;">
          <input type="hidden" name="tab" value="3" />
          <input autofocus="true" name="q" value="" type="text" placeholder="từ khóa ..." class="m-wrap" style="padding: 4px !important;" />
          <button class="btn mini green" style="padding: 8px;height: 30px;"><i class="icon-arrow-right"></i> Tìm kiếm</button>

        </form>

        <nav class="page pagination pull-right" aria-label="Page navigation example text-center">
          @include('component.pagination', $object = $models)
        </nav>
      </div>
    </div>
  </div>

  <div id="tab-4" class="tab_content <?= ($tab == 4) ? '' : 'hide' ?>">
    <form action="" method="post" id="form-username">
      <div class="control-group">
        <div class="controls">
          @csrf
          <input type="text" class="m-wrap" name="image" style="width: 60%; background: #FFF;" placeholder="http://example.com/image.jpg" />
          <button type="submit" class="btn green"><i class="icon-ok"></i> Download</button>
          <div class="help-block">Nhập đường dẫn ảnh và nhấn Download để tải ảnh về hệ thống.</div>
        </div>
      </div>
    </form>
  </div>
  <script src="{{asset('library/editor/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js"></script>

  <!-- x-editable (bootstrap version) -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

  <script type="text/javascript">
    var max_width = 1024;
  </script>
  <script src="{{asset('library/editor/scripts/image.js')}}" type="text/javascript"></script>

</body>

</html>
