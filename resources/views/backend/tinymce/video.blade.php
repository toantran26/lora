<!DOCTYPE html>

<head>
    <link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('library/editor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('library/editor/css/style-metro.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('library/editor/css/style.css?v=1')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('library/editor/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css"
          href="{{asset('library/editor/bootstrap-fileupload/bootstrap-fileupload.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('library')}}/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('library')}}/editor/dropzone/dropzone.css"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('library')}}/editor/bootstrap-daterangepicker/daterangepicker.css"/>

    <script src="{{asset('library')}}/editor/js/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="{{asset('library')}}/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="{{asset('library')}}/editor/scripts/jquery.ui.datepicker-vn.js"></script>

    <style>
        body.media {
            padding: 15px !important;
            font-family: Arial;
        }

        body.media .tab_btn {
            margin-bottom: 15px;
        }

        body.media #tab-4,
        body.media #tab-5 {
            border: 1px solid rgba(0, 0, 0, 0.03);
            border-radius: 3px;
            background: rgba(0, 0, 0, 0.03);
            padding: 23px;
        }

        body.media h3 {
            font-family: 'Open Sans', sans-serif;
        }

        body.media .oneVideo {
            position: relative;
            margin-bottom: 13px;
        }

        body.media .oneVideo .btn_Insert {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        body.media .oneVideo .btn_Insert span {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: rgba(0, 0, 0, 0.7);
            color: #FFF;
            font-size: 11px;
            padding: 0 3px;
            line-height: 13px;
            font-weight: bold;
        }

        body.media .oneVideo .p {
            font-size: 11px;
            position: absolute;
            left: 0;
            top: 0;
            background: #000;
            color: #FFF;
            width: 92%;
            padding: 0 4%;
            background: -webkit-linear-gradient(#000, transparent);
        }

        body.media .oneVideo .title {
            color: #167ac6;
            display: block;
            max-height: 32px;
            line-height: 16px;
            margin: 5px 0 0;
            overflow: hidden;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            -ms-text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
        }

        body.media #frm_upload {
            position: relative;
        }

        body.media #frm_upload label {
            position: absolute;
            left: 0;
            bottom: -30px;
        }
    </style>
</head>

<body class="media">

<div class="row-fluid tab_btn">
    <a href="#tab-1" class="btn <?= ($tab == 1) ? 'red' : 'blue' ?>"><i class="icon-plus"></i> Tải lên</a>
<!-- <a href="#tab-2" class="btn <?= ($tab == 2) ? 'red' : 'blue' ?>"><i class="icon-bookmark"></i> Đã tải lên từ bài này</a> -->
    <a href="#tab-3" class="btn <?= ($tab == 3) ? 'red' : 'blue' ?>"><i class="icon-film"></i> Tất cả</a>
    <a href="#tab-4" class="btn <?= ($tab == 4) ? 'red' : 'blue' ?>"><i class="icon-youtube-play"></i> Youtube</a>
    <a href="#tab-5" class="btn <?= ($tab == 5) ? 'red' : 'blue' ?>"><i class="icon-cloud"></i> Embed</a>
</div>

<div id="tab-1" class="tab_content <?= ($tab == 1) ? '' : 'hide' ?>">
    <form method="post" id="frm_upload" action="" class="dropzonez dz-clickable">
        <input type="file" accept=".mp4" name="file" class="hide"/>
        <input type="hidden" name="action" value="upload"/>
        <input type="hidden" name="wm" value="0"/><input type="hidden" name="cv" value="0"/>
    @csrf
    <!-- <label class="checkbox-fix"><input type="checkbox" name="wm" value="1" /> Đóng dấu video</label>
            <label  class="checkbox-fix" style="left: 160px;"><input type="checkbox" name="cv" value="1" /> Chèn hình hiệu</label> -->
        <div id="btn_tab_1" class="dz-default dz-message"
             style="width: 100%;margin: 0;left: 0;top: 0;height: 100%;background: none;"><span
                style="display: block;background: url({{asset('library/editor/images/spritemap.png')}}) no-repeat 0 -296px;width: 320px;height: 90px;position: absolute;left: 37%;top: 32%;"></span>
        </div>
    </form>

    <div class="uploadbar hide" style="margin-top: 130px; transition: margin .6s ease;">
        <h3>Tải lên <span id="lbl_upload" style="float: right;"></span></h3>
        <div class="progress progress-striped active">
            <div style="width: 0%;" class="bar bar-success"></div>
        </div>
    </div>

    <div class="progressbar hide">
        <h3>Xử lý video</h3>
        <div class="progress progress-striped active">
            <div style="width: 0%; transition: width 10s ease;" class="bar"></div>
        </div>
    </div>

    <div class="row-fluid hide">
        <h3>Chọn ảnh cover cho video</h3>
        <div id="list_images_cover"></div>
    </div>

</div>

<div id="tab-2" class="tab_content <?= ($tab == 2) ? '' : 'hide' ?> ">

    <div style="min-height: 390px;">
        <div class="row-fluid">
            <?php
            $i = 0;
            foreach ($media as $row) {
            // echo \Yii::$app->params['mediaUrl'] . '/' .$row->cover; die;
            // $newImage = Image::getImagine()->open(\Yii::$app->params['mediaUrl'] . '/' .$row->cover);
            // $imageSizes = $newImage->getSize();
            // $width = $imageSizes->getWidth();
            // $height = $imageSizes->getHeight();
            ?>
            <div class="span3">
                <div class="oneVideo">
                    <a href="#" class="btn_Insert" title="<?= $row->name ?>">
                        <img src="/<?= $row->cover ?>" alt="" style="width:100%;height:100px; object-fit:cover;"><span>00:41</span>
                    </a>
                    <div class="team-info">
                        <p class="title"><?= $row->name ?></p>

                    </div>
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
            foreach ($models as $row) {
            ?>
            <div class="span3">
                <div class="oneVideo">
                    <a href="#" class="btn_Insert" data-id="<?=$row->id?>" title="<?= $row->name ?>">
                        <img src="<?= $row->cover ?>" alt=""
                             style="width:100%; height:100px; object-fit:cover;"><span></span>
                    </a>
                    <div class="team-info">
                        <p class="title"><?= $row->name ?></p>
                    </div>
                </div>
            </div>
            <?php
            $i++;

            if ($i % 4 == 0) {
                echo '</div><div class="row-fluid">';
            }
            } ?>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <form class="control" method="get" action="/" style="margin:20px 0 0;float: left;">
                    <input type="hidden" name="mod" value="tinymce"/>
                    <input type="hidden" name="act" value="media"/>
                    <input type="hidden" name="news_id" value="12"/>
                    <input type="hidden" name="tab" value="3"/>
                    <input autofocus="true" name="q" value="" type="text" placeholder="từ khóa ..." class="m-wrap"
                           style="padding: 4px !important;"/>
                    <button class="btn mini green" style="padding: 8px;height: 30px;"><i class="icon-arrow-right"></i>
                        Tìm kiếm
                    </button>

                </form>
                <nav class="page pagination pull-right" aria-label="Page navigation example text-center">
                    @include('component.pagination', $object = $models)
                </nav>
            </div>
        </div>
    </div>
</div>

<div id="tab-4" class="tab_content <?= ($tab == 4) ? '' : 'hide' ?>">
    <form action="" method="post" id="form-youtube">
        <div class="control-group">
            <div class="controls">
                <input type="text" class="m-wrap" name="youtube" style="width: 60%; background: #FFF;"
                       placeholder="https://www.youtube.com/watch?v=xxxxxx"/>
                <button type="submit" class="btn green"><i class="icon-ok"></i> Chèn vào bài</button>
                <div class="help-block">Nhập đường dẫn URL Youtube để chèn video vào trong bài viết.</div>
            </div>
        </div>
    </form>
</div>

<div id="tab-5" class="tab_content hide">
    <form action="" method="post" id="form-embed">
        <div class="control-group">
            <div class="controls">
                <textarea class="m-wrap span12" name="embed" style="background: #FFF; height: 120px;"></textarea>
            </div>
            <button type="submit" class="btn green"><i class="icon-ok"></i> Chèn vào bài</button>
        </div>
    </form>
</div>

<script src="{{asset('library/editor/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

<script src="{{asset('library/editor/dropzone/dropzone.min.js')}}"></script>


<!-- x-editable (bootstrap version) -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css"
      rel="stylesheet"/>
<script
    src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

<script src="{{asset('library/editor/js/jquery.form.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    var news_id = 1;
</script>
<script src="{{asset('library/editor/scripts/media.js')}}?v=2" type="text/javascript"></script>

</body>

</html>
