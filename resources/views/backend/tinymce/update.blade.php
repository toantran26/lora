<?php

use yii\helpers\Html;
use backend\models\News;
use backend\models\Category;
use backend\services\BaseService;
use yii\widgets\ActiveForm;
// use wbraganca\tagsinput\TagsinputWidget;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\bootstrap4\Modal;
use \yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Update News: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';


?>
<section class="content-header">
  <h1>
    <?= News::TT_STATUS()[$model->status] ?> <small><?= $model->title ?></small>
  </h1>
  <ol class="breadcrumb">
    <button type="button" class="btn btn-warning pull-right text-white" data-toggle="modal" data-target="#modalTrending">
      <i class="fa  fa-question-circle"></i>&nbsp; Viết gì hôm nay?
    </button>
    <a href="/" class="btn btn-info pull-right text-white mgr-15"><i class="fa fa-plus-circle"></i>&nbsp; Viết mới</a>
  </ol>
</section>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


<?= $this->render('_button.php', [
  'model' => $model,
]) ?>

<?= $this->render('@backend/views/_include/flash_message.php') ?>

<div class="news-update">

  <div class="row">
    <div class="col-md-8">
      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; Thông tin bài viết
        </div>
        <div class="box-body">
          <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
          <?= $form->field($model, 'title', ['options' => ['class' => 'wrap-count']])->textInput(['maxlength' => true, 'class' => 'change-slug count-length form-control', 'data-target' => 'news-slug', 'data-name' => 'news-title', 'data-length' => 70]) ?>

          <?= $form->field($model, 'description', ['options' => ['class' => 'wrap-count']])->textarea(['maxlength' => true, "rows" => 3, 'class' => 'count-length form-control', 'data-name' => 'news-description', 'data-length' => 165]) ?>

          <?= $form->field($model, 'content')->textarea(['rows' => 6, 'class' => 'tinymce']) ?>

          <div class="box box-white collapsed-box">
            <div class="box-header">

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool text-info" data-widget="collapse"><i class="fa fa-plus"></i> Tùy chỉnh trang chi tiết</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
              <div class="row">
                <div class="col-md-12">
                  <?= $form->field($model, 'title_detail')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'desc_detail')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        </div>
      </div>

      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-google" aria-hidden="true"></i>&nbsp; Hỗ trợ SEO</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <?= $form->field($model, 'tag')->textInput() ?>

          <div class="box box-white collapsed-box">
            <div class="box-header">

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool text-info" data-widget="collapse"><i class="fa fa-plus"></i> Tùy chỉnh google SEO</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
              <div class="row">
                <div class="col-md-12">
                  <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'desc_seo')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'keyword_seo')->textInput(['maxlength' => true]) ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>

        </div>
      </div>

      <div class="box box-info box-search-news">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp; Tin liên quan</h3>
          <div class="box-tools pull-right search-related">
            <a href="#" id="search-related" class="btn-search"><i class="fa fa-search" aria-hidden="true"></i></a>
            <?= Html::dropDownList('list', 1, Category::getListCategoryTree('all'), ['prompt' => 'Chọn chuyên mục', 'class' => 'form-control cate-search']) ?>
            <input type="text" id="news-text-search" name="search" class="form-control text-search" placeholder="Từ khóa" value="" />
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body ">
          <div class="gm_list">

          </div>
          <div class="gm_news_related7 gm_news_related7_bottom" style="position: relative;">
            <!-- <a href="#" id="btn_auto_related" class="btn mini" style="position: absolute;right: 0;top: -3px;">Auto</a>
                        <div><strong class="gm_news_related7_letter">Tin nên đọc</strong></div> -->
            <div class="wrap_suggest" id="wrap_related_news">
              <?php foreach ($related_news as $val) {
              ?>
                <div class="gm_news_related7_item">
                  <input type="hidden" name="related[]" value="<?= $val->id ?>">
                  <a class="gm_news_related7_photo" target="_blank" href="<?= BaseService::MakeLink($val) ?>">
                    <img src="/<?= $val->avatar ?>" alt="" width="174" height="85"></a>
                  <a class="gm_news_related7_title" target="_blank" href="<?= BaseService::MakeLink($val) ?>"><?= $val->title ?></a>
                </div>
              <?php
              } ?>
            </div>
          </div>


        </div>
      </div>

    </div>
    <div class="col-md-4">
      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Thảo luận
        </div>
        <div class="box-body">
          <ul class="chats" id="list_log_news">
            <?php
            foreach ($comment as $row) {
              if ($row['avatar'] != '') {
                $avatar = '/uploads/profiles/' . $row['avatar'];
              } else {
                $avatar = '/images/noavatar.jpg';
              }
              if ($row['userid'] == \Yii::$app->user->identity->id) {
                $class = "out";
              } else {
                $class = "in";
              }
            ?>
              <li class="<?= $class ?>"><img class="avatar" alt="" src="<?= $avatar ?>" width="45" height="45">
                <div class="message">
                  <span class="arrow"></span>
                  <a href="#" class="name"><?= $row['full_name'] ?></a>
                  <span class="datetime">at <?= $row['created_at'] ?></span>
                  <span class="body"><?= $row['comment'] ?></span>
                </div>
              </li>
            <?php
            }
            ?>


          </ul>
          <div class="chat-form">
            <div class="input-cont">
              <input id="txt_input_log" class="m-wrap" type="text" placeholder="Type a message here..." maxlength="255">
            </div>
            <div class="btn-cont">
              <a id="btn_add_log" href="#" class="btn blue icn-only text-white btn-success"><i class="fa fa-paper-plane-o "></i></a>
            </div>
          </div>
        </div>

      </div>
      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Ảnh đại diện
        </div>
        <div class="box-body">
          <div id="uploaded" class="wrap-img-News">

            <?php
            if (!empty($model->avatar)) { ?>
              <?= Html::img(\Yii::$app->params['mediaUrl']  . $model->avatar, ['class' => ' img-responsive  avatarNews']) ?>
            <?php } else { ?>
              <img class=" img-responsive avatarNews" src="/themev2/dist/img/user4-128x128.jpg" alt="User profile picture">
            <?php }
            ?>

            <input type="file" id="uploadNews" />
          </div>
          <?= $form->field($model, 'avatar')->hiddenInput(['id' => 'dataUploadNews'])->label(false) ?>
        </div>
      </div>

      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Thông tin chung
        </div>
        <div class="box-body">

          <label>Bạn muốn gửi bài này cho ai?</label>
          <?php
          echo Select2::widget([
            'name' => 'kv_theme_default_2',
            'data' => \backend\models\User::getAllUserActive(),
            'theme' => Select2::THEME_DEFAULT,
            'options' => ['placeholder' => 'Chọn người gửi ...', 'multiple' => true, 'autocomplete' => 'on', 'toggleAllSettings' => false],
            'pluginOptions' => [
              'allowClear' => true,

            ],
          ]);
          ?>

        </div>
      </div>

      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Chuyên mục
        </div>
        <div class="box-body">
          <?= $form->field($model, 'category_id')->dropDownList($category, ['prompt' => 'Chọn...']) ?>
          <label>Chuyên mục hiển thị</label>
          <div style="height: 250px; overflow: auto;">
            <?= $form->field($model, 'category_show')->checkboxList($category, ['separator' => '<br>'])->label(false); ?>
          </div>
        </div>
      </div>

      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-cog" aria-hidden="true"></i>&nbsp; Tùy chỉnh
        </div>
        <div class="box-body onoff-small">
          <?= $form->field($model, 'picture')->checkbox(['label' => 'Bài ảnh']) ?>
          <?= $form->field($model, 'video')->checkbox(['label' => 'Bài video']) ?>
          <?= $form->field($model, 'hot_new')->checkbox(['label' => 'Tin hot']) ?>
          <?= $form->field($model, 'top_new')->checkbox(['label' => 'Tin nổi bật']) ?>
          <?= $form->field($model, 'google_bot')->checkbox(['label' => 'Chặn google index']) ?>
          <?= $form->field($model, 'advertisement')->checkbox(['label' => 'Tăt quảng cáo']) ?>
        </div>
      </div>
      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-history" aria-hidden="true"></i>&nbsp; Lịch sử chỉnh sửa
        </div>
        <div class="box-body list-log">
          <ul>
            <?php
            for ($i = 0; $i < count($log); $i++) {
              $action = "";
              if ($log[$i]->status == 0) {
                $action = "Lưu nháp";
              } else {
                if (isset($log[$i + 1]) && $log[$i]->status == $log[$i + 1]->status) {
                  $action = "Chỉnh sửa";
                } else {
                  $action = News::TT_STATUS()[$log[$i]->status];
                }
              }
            ?>
              <li class="log">
                <a href="/news/log-detail?id=<?= $log[$i]->id ?>" target="_blank">
                  <p><strong><?= $log[$i]->user->full_name ?></strong> - <span><?= $action ?></span></p>
                </a>
                <p><?= $log[$i]->updated_date ?></p>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->render('_button.php', [
  'model' => $model,
]) ?>



<?php ActiveForm::end(); ?>


<div id="modelNews" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <div id="imageNews" style="width:100%; margin-top:20px"></div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success crop_imageNews">Cắt ảnh</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="modalTrending" class="modal" role="dialog">
  <div class="modal-dialog">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

    <div class="modal-content">
      <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2213_RC01/embed_loader.js"></script>
      <script type="text/javascript">
        trends.embed.renderWidget("dailytrends", "", {
          "geo": "VN",
          "guestPath": "https://trends.google.com:443/trends/embed/"
        });
      </script>

    </div>

  </div>
</div>




<style>
  .bootstrap-tagsinput {
    position: relative;
  }
</style>
<?php
$script = <<< JS

  $('#news-tag').tokenfield({
      autocomplete: {
        source: function (request, response) {
            jQuery.get("/news/search-tag", {
                query: request.term
            }, function (data) {
                data = $.parseJSON(data);
                response(data);
            });
        },
        delay: 100
      },
    showAutocompleteOnFocus: true
  });

  $('#news-tag').on('tokenfield:createtoken', function (event) {
      var existingTokens = $(this).tokenfield('getTokens');
      $.each(existingTokens, function(index, token) {
          if (token.value === event.attrs.value)
              event.preventDefault();
      });
  });


  tinymce.PluginManager.add('link', function(editor, url) {
      function createLinkList() {
          return function() {
              editor.windowManager.open({
                  title: 'Chèn liên kết',
                  url: "/tinymce/link?newsid=$model->id",
                  width: 450,
                  height: 280
              });
          };
      }
      editor.addButton('link', {
      icon: 'link',
      tooltip: 'Chèn liên kết',
      onclick: createLinkList(),
      stateSelector: 'a[href]'
    });

    editor.addButton('unlink', {
      icon: 'unlink',
      tooltip: 'Remove link',
      cmd: 'unlink',
      stateSelector: 'a[href]'
    });

    editor.addMenuItem('link', {
      icon: 'link',
      text: 'Chèn liên kết',
      shortcut: 'Meta+K',
      onclick: createLinkList(),
      stateSelector: 'a[href]',
      context: 'insert',
      prependToContext: true
    });
      editor.addShortcut('Meta+K', '', createLinkList());
    editor.addCommand('mceLink', createLinkList());
  });


  tinymce.PluginManager.add('image', function(editor, url) {
      function createImageList() {
          return function() {
              editor.windowManager.open({
                  title: 'Chèn hình ảnh',
                  url: '/tinymce/image?newsid=$model->id',
                  width: 800,
                  height: 550
              });
          };
      }

      editor.addButton('image', {
      icon: 'image',
      tooltip: 'Chèn hình ảnh',
          stateSelector: 'figure.image',
      onclick: createImageList()
    });
      editor.addMenuItem('image', {
      icon: 'image',
      text: 'Chèn hình ảnh',
      context: 'insert',
      prependToContext: true,
          onclick: createImageList()
    });

  });


  tinymce.PluginManager.add('editimage', function(editor, url) {
      function createEditImage() {
          return function() {
              editor.windowManager.open({
                  title: 'Sửa hình ảnh',
                  url: '/tinymce/image?newsid=$model->id',
                  width: 550,
                  height: 560
              });
          };
      }
  });


  tinymce.PluginManager.add('media', function(editor, url) {
      function createMediaList() {
          return function() {
              editor.windowManager.open({
                  title: 'Chèn video',
                  url: '/tinymce/video?newsid=$model->id',
                  width: 800,
                  height: 550
              });
          };
      }
      editor.addButton('media', {
      icon: 'media',
      tooltip: 'Chèn video',
          stateSelector: 'iframe.exp_video',
      onclick: createMediaList()
    });
      editor.addMenuItem('media', {
      icon: 'media',
      text: 'Chèn video',
      context: 'insert',
      prependToContext: true,
          onclick: createMediaList()
    });
      
  });


    tinymce.init({
      selector: '.tinymce',
      plugins: 'autosave,wordcount,code,fullscreen,table,noneditable,link,media,image,paste,searchreplace,textcolor,editimage',
      toolbar: 'alignleft,aligncenter,alignjustify,alignright,bold,italic,forecolor,link,unlink,image,media,block,numlist,bullist,formatselect,code,quizz,block,fullscreen',
      toolbar_mode: 'floating',
      skin:'lightgray',
      content_css: '/themev2/editor/css/tinycustomcss.css?v=11',
      noneditable_editable_class: "expEdit",
      noneditable_noneditable_class: "expNoEdit",
      height: 500,
      setup : function(ed) {
          ed.on('DblClick', function(e) {
              if (e.target.nodeName=='IMG') {
                  ed.windowManager.open({
                      title: 'Sửa hình ảnh',
                      url: '/tinymce/editimage',
                      width: 600,
                      height: 560
                  });
              }
          });
      },
        style_formats: [
          { title: 'Size 16', inline: 'span', styles: { 'font-size': '16px' } },
          { title: 'Size 18', inline: 'span', styles: { 'font-size': '18px' } },
          { title: 'Size 20', inline: 'span', styles: { 'font-size': '20px' } },
          { title: 'Size 22', inline: 'span', styles: { 'font-size': '22px' } },
          { title: 'Size 24', inline: 'span', styles: { 'font-size': '24px' } },
          { title: 'Subtitle', block: 'h2' }
      ],
    
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
      //   paste_preprocess: function (plugin, args) {
      //     args.content = args.content.replace(/<div/gi, "<p");
      //     args.content = args.content.replace(/<\/div>/gi, "</p>");
      //     args.content = args.content.replace(/<strong/gi, "<b");
      //     args.content = args.content.replace(/<\/strong>/gi, "</b>");
      //     args.content = args.content.replace(/<em/gi, "<i");
      //     args.content = args.content.replace(/<\/em>/gi, "</i>");
      //     args.content = args.content.replace(/<li/gi, "<i");
      //     args.content = args.content.replace(/<\/li>/gi, "</i>");
      //     args.content = strip_tags(args.content, '<h1><h2><h3><h4><p><b><u><i><img><table><tr><td><th><tbody><thead><ul><li><figure><figcaption>');
      //     args.content = args.content.replace(/<(p)[^>]+>/ig, '<$1>');
      //     var contentz = $('<div/>').html(args.content);
      //     var url = '';
      //     contentz.find('img').each(function () {
      //         url = $(this).attr('src');
      //         if (url.substring(0, LENGTH_MEDIA_DOMAIN) != MEDIA_DOMAIN) $(this).remove();
      //     });
      //     contentz.find('p').each(function () {
      //         $(this).attr('style', 'text-align: justify;');
      //         if ($(this).html().length <= 1) $(this).remove();
      //     });
      //     args.content = contentz.html();
      // },
      entity_encoding: "raw",
      paste_as_text: true,
      relative_urls : false,
      remove_script_host : false,
  // document_base_url : "http://hoptacxanamanh.com/"
      });

      function strip_tags(b, k) { var e = "", f = !1, g = [], h = [], d = "", a = 0, l = "", c = ""; k && (h = k.match(/([a-zA-Z0-9]+)/gi)); b += ""; g = b.match(/(<\/?[\S][^>]*>)/gi); for (e in g) if (!isNaN(e)) { c = g[e].toString(); f = !1; for (l in h) if (d = h[l], a = -1, 0 != a && (a = c.toLowerCase().indexOf("<" + d + ">")), 0 != a && (a = c.toLowerCase().indexOf("<" + d + " ")), 0 != a && (a = c.toLowerCase().indexOf("</" + d)), 0 == a) { f = !0; break } f || (b = b.split(c).join("")) } return b };

JS;
$this->registerJs($script, View::POS_END);
?>