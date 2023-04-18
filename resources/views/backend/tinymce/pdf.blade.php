<?php

use \yii\web\View;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<!DOCTYPE html>

<head>
  <link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('library/editor//bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link href="{{asset('library/editor/css/style-metro.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{asset('library/editor/css/style.css?v=1')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('library/editor/css/style-responsive.css')}}" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/dropzone/dropzone.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/bootstrap-daterangepicker/daterangepicker.css')}}" />
  <script src="{{asset('library/editor/js/jquery-1.10.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('library/editor/scripts/jquery.ui.datepicker-vn.js')}}"></script>
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


  <div id="tab-1" class="tab_content">
    <form action="{{route('post.pdf')}}" method="post" enctype="multipart/form-data" class="dropzonez" id="my-awesome-dropzone" style="height: 295px;min-height:unset">
      @csrf
      <div class="dz-default dz-message" data-dz-message=""><span>Drop files here to upload</span></div>
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
  <script src="{{asset('library/editor/scripts/pdf.js?v=127')}}" type="text/javascript"></script>

</body>

</html>
