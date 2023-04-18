<?php

use app\components\widgets\ViewCateHomeWidget;
use app\components\widgets\AdsWidget;
use frontend\models\News;
use frontend\models\Comment;
use frontend\services\BaseService;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use \yii\web\View;

$this->title = "$newdetail->title";
$this->registerMetaTag(['property' => 'og:image', 'content' => \Yii::$app->params['mediaUrl'] . $newdetail->avatar]);
$this->registerMetaTag(['property' => 'og:title', 'content' => "$newdetail->title"]);
$this->registerMetaTag(['property' => 'og:description', 'content' => "$newdetail->description"]);
$this->registerMetaTag(['name' => 'keywords', 'content' => "$newdetail->tag"]);
$this->registerMetaTag(['property' => 'og:url', 'content' => "http://ieem.vn/$newdetail->slug" . '.html']);
$this->registerMetaTag(['property' => 'og:id', 'content' => ""]);
$this->registerMetaTag(['property' => 'og:type', 'content' => \Yii::$app->params['home_type']]);
$this->registerMetaTag(['property' => 'og:site_name', 'content' => \Yii::$app->params['home_sitename']]);
$this->registerMetaTag(['property' => 'app_id', 'content' => '']);


?>
<div class="container mb-15 detail">
    <div class="row gutter-10">
        <div class="col-lg-9">
            <div class="d-flex align-items-center mb-15 cat-post">
                <h2 class="t-18 d-line-block text-uppercase mr-30 f-roboto-b title"><?php echo $newdetail->newnames->name ?></h2>
            </div>
            <h1 class="t-25 f-roboto-b cl-083f59 mb-10"><?php echo $newdetail->title ?></h1>
            <div class="row share align-items-center justify-content-between mb-15">
                <div class="col-12 info-author cl-737373">
                      <i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $newdetail->created_date; ?></span>
                </div>
                <!--<div class="col-6  icon-share">

                    <a  class="fb-xfbml-parse-ignore" alt="<?php echo $newdetail->title ?>" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo \Yii::$app->params['baseUrl'] . $newdetail->slug . '.html' ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook text-primary borde-ican"></i></a>

                    <a  title="chia sẻ twitter" target="_blank" class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo \Yii::$app->params['baseUrl'] . $newdetail->slug . '.html' ?>" data-size="large" class="twitter">
                        <i class="fa fa-twitter text-info borde-ican"></i>
                    </a>

                </div>-->
            </div>
            <div class="des f-roboto-b t-16-mb">
                <?php echo $newdetail->description ?>
            </div>
            <?php if ($newdetail1) : unset($newdetail1[0]); ?>
                <ul class="list-post-global list-post pb-10 mb-10 border-bottom">
                    <?php foreach ($newdetail1 as $key => $value) : ?>
                        <li class="mt-10">
                            <div class="f-roboto-b t-15 cl-737373">
                                <a href="<?= Url::to(['/news/detail', 'slug' => $value->slug]) ?>" class="link_unstyle"><?= BaseService::SplitText($value->title, 90) ?></a>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <div class="row gutter-10 mb-30">
                <div class="col-md-9">
                    <div class="content content-mb mb-20 overflow-hidden t-16-mb">
                        <?php echo $newdetail->content ?>
                    </div>
                    
                    <div class="wrap-tags mb-15">
                        <img src="../images/icon-tag.png" alt="" class="d-inline-block mr-2"><span class="f-roboto-b">Từ khóa:</span>
                        <ul class="list-tag">
                            <?php if ($newdetail->keywordsid) : foreach ($newdetail->keywordsid as $keys) : if ($keys->keywordname->tag_name) : ?>
                                        <li>
                                            <?php
                                            $slug = new News;
                                            $slug = $slug->makeAlias($keys->keywordname->tag_name);
                                            ?>
                                            <a href="<?php echo Url::to(['/keyword/index', 'id' => $keys->keywords_id, 'slug' => $slug]) ?>"><?php echo $keys->keywordname->tag_name ?></a>
                                        </li>
                            <?php endif;
                                endforeach;
                            endif; ?>
                        </ul>
                    </div>
                    <div class="comment">
                        <?php if ($newdetail->show_comment == 1) { ?>
                            <div class="d-flex justify-content-between align-items-end mb-1">
                                <h2 class="f-roboto-b t-20">Bình luận</h2>
                            </div>


                            <!-- comment -->
                            <?php
                            $form = ActiveForm::begin([
                                'id' => 'comment_news_parent',
                                'method' => 'post',
                                'action' => Url::to(['news/comment'])
                            ]);
                            ?>
                            <div class="row commentnews">

                                <?= $form->field($comment, 'news_id')->hiddenInput(['class' => 'input-text', 'value' => $newdetail->id])->label(false) ?>

                                <div class="col-md-12" style="background: #EEEEEE;padding: 10px;">
                                    <?= $form->field($comment, 'messenger')->textarea(['class' => ' form-control commentparentmes', 'placeholder' => 'Nhập nội dung ...', 'id' => 'show_mes'])->label(false) ?>

                                    <a class="btn btn-primary submitphone" id="show_modal_parents" style="color: #fff">Gửi bình luận</a>


                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">


                                    <div class="col-md-12" style="margin-bottom: 20px;margin-top:40px;">
                                        <span id="spanCommentCount" class="comment-count"><?php echo $newdetail->countcomment ?> bình luận</span>
                                    </div>

                                </div>
                                <!--  modal comment parent -->

                                <div class="modal fade" id="modal-comment-show">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-center">Nhập thông tin </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">

                                                <?= $form->field($comment, 'name')->textInput(['class' => 'input-text form-control commentparentmes', 'placeholder' => 'Nhập họ tên ...', 'id' => 'nameparent']) ?>

                                                <?= $form->field($comment, 'email')->textInput(['class' => 'input-text form-control commentparentmes', 'placeholder' => 'Nhập nội email...', 'id' => 'emailparent']) ?>
                                            </div>
                                            <div class="modal-footer ">
                                                <?= Html::submitButton('Hoàn thành', ['class' => 'btn btn-primary input_cmt', 'id' => 'comment_parent']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            </div>
                            <?php ActiveForm::end(); ?>
                            <!--  start list comment parent -->
                            <div class="list-comment clearfix">
                                <?php if ($newdetail->commentid) : foreach ($newdetail->commentid as $key) : ?>
                                        <ul class="comments" data-type="list-commentstream" data-parentid="0" data-template="tplListCommentParent">
                                            <li id="comment-d5797e20-afb5-11e7-8ad7-7319761b1588" data-type="comment-item" data-isprocessed="1" data-isparent="1" data-id="d5797e20-afb5-11e7-8ad7-7319761b1588" data-parentid="null" data-liked="0">

                                                <img class="cmt-avatar" data-type="user-avatar" src="/images/no-avatar.png">

                                                <div class=" cmt-content">

                                                    <a class="cmt-author"><?php echo $key->name ?><span class="date"> <?php echo $key->created_at ?></span></a> <?php echo $key->messenger ?>

                                                </div>
                                                <div class="action clearfix" style="margin-left: 48px">
                                                    <div id="load-<?php echo $key->id; ?>">

                                                        <?php if (isset(Yii::$app->session['like' . $key->id])) : ?>
                                                            <?php echo Html::a('Bỏ thích', ['/news/removelike', 'comment_id' => $key->id], ['class' => ' remove-to-like', 'style' => 'margin-left:10px', 'data-id' => $key->id]) ?>

                                                        <?php else : ?>
                                                            <?php echo Html::a('Thích', ['/news/addlike', 'comment_id' => $key->id], ['class' => ' add-to-like', 'style' => 'margin-left:10px', 'data-id' => $key->id]) ?>
                                                        <?php endif; ?>


                                                        <a href="javascript:;" style="margin-left: 10px;margin-right: 10px;" data-toggle="collapse" data-target="#demo_dm_<?php echo $key->id ?>" class="act-item"> Trả lời

                                                        </a>
                                                        <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $key->like_news ?></span>
                                                    </div>

                                                </div>

                                        </ul>

                                        <?php $data = Comment::find()->where(['parent' => $key->id])->all(); ?>
                                        <?php if ($data) : foreach ($data as $datas) : ?>

                                                <div class="list-comment-child " style="margin-left:30px;">
                                                    <ul class="comments" data-type="list-commentstream" data-parentid="0" data-template="tplListCommentParent">
                                                        <li id="comment-d5797e20-afb5-11e7-8ad7-7319761b1588" data-type="comment-item" data-isprocessed="1" data-isparent="1" data-id="d5797e20-afb5-11e7-8ad7-7319761b1588" data-parentid="null" data-liked="0">

                                                            <img class="cmt-avatar" data-type="user-avatar" src="/images/no-avatar.png">

                                                            <div class=" cmt-content">

                                                                <a class="cmt-author"><?php echo $datas->name ?><span class="date"> <?php echo $datas->created_at ?></span></a><?php echo $datas->messenger ?>

                                                            </div>
                                                            <div id="load-child-<?php echo $datas->id; ?>">
                                                                <?php if (isset(Yii::$app->session['like' . $datas->id])) : ?>
                                                                    <?php echo Html::a('Bỏ thích', ['/news/removelike', 'comment_id' => $datas->id], ['class' => ' remove-to-like-child', 'style' => 'margin-left:50px;', 'data-id' => $datas->id]) ?>

                                                                <?php else : ?>
                                                                    <?php echo Html::a('Thích', ['/news/addlike', 'comment_id' => $datas->id], ['class' => ' add-to-like-child', 'style' => 'margin-left:50px;', 'data-id' => $datas->id]) ?>
                                                                <?php endif; ?>
                                                                <span style="margin-left: 7px"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $datas->like_news ?></span>
                                                            </div>




                                                    </ul>
                                                </div>
                                        <?php endforeach;
                                        endif; ?>


                                        <!-- endcomment -->
                                        <div id="demo_dm_<?php echo $key->id ?>" class="collapse">
                                            <?php $form = ActiveForm::begin([
                                                'id' => "comment_news_child",
                                                'method' => 'post',
                                                'action' => Url::to(['news/commentparent'])
                                            ]); ?>

                                            <div class="col-md-12">
                                                <?= $form->field($comment, 'news_id')->hiddenInput(['class' => 'input-text', 'value' => $newdetail->id])->label(false) ?>
                                                <?= $form->field($comment, 'parent')->hiddenInput(['class' => 'input-text', 'value' => $key->id])->label(false) ?>

                                            </div>

                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 comment_child" style="background: #EEEEEE;padding: 10px;">
                                                <?= $form->field($comment, 'messenger')->textarea(['class' => 'input-text form-control commentparentmes', 'placeholder' => 'Nhập nội dung ...', 'id' => 'show_child_' . $key->id])->label(false) ?>


                                                <a class="btn btn-primary submitphone " id="show_modal_childs" data-id="<?php echo $key->id ?>">Gửi bình luận</a>

                                            </div>



                                            <div class="modal fade" id="modal_comment_child_<?php echo $key->id  ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-center">Nhập thông tin </h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <?= $form->field($comment, 'name')->textInput(['class' => 'input-text form-control commentparentmes', 'placeholder' => 'Nhập họ tên ...', 'id' => 'namechild_' . $key->id]) ?>

                                                            <?= $form->field($comment, 'email')->textInput(['class' => 'input-text form-control commentparentmes', 'placeholder' => 'Nhập nội email...', 'id' => 'emailchild_' . $key->id]) ?>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <?= Html::submitButton('Hoàn thành', ['class' => 'btn btn-primary cmt_child', 'id' => 'comment_child', 'data-id' => $key->id]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php ActiveForm::end(); ?>
                                        </div>
                                <?php endforeach;
                                endif; ?>

                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-3 ispc">

                   <?= ViewCateHomeWidget::widget(["style" => "CateDetailWidget1_1", "slug" => "", "name" => "Cùng chuyên mục", "cate" => $newdetail->category_id, "item" => 6]) ?>
                   
                </div>
            </div>
            <?php if (isset($newlienquan[0])) : ?>
                <div class="box-article-cat mb-15">
                    <div class="container container-ctbqt">
                        <div class="d-flex align-items-center mb-15 cat-post">
                            <h2 class="t-18 d-line-block text-uppercase mr-30 f-roboto-b title">Có thể bạn quan tâm?</h2>
                        </div>
                        <div class="box-article-cat_content  box-random">
                            <div class="row gutter-15 mb-6">
                                <?php foreach ($newlienquan as $item) : ?>
                                    <div class="col-md-4 col-lg-3 mb-15">
                                        <a href="<?= Url::to(['news/detail', 'slug' => $item['slug']]) ?>" class="d-block mb-15">
                                            <?= Html::img(\Yii::$app->params['mediaUrl'] . $item['images'], ['alt' => $item['title'], 'class' => 'w-100', 'height' => 173]) ?>
                                        </a>
                                        <h3 class="f-roboto-b t-15"><a href="<?= Url::to(['news/detail', 'slug' => $item['slug']]) ?>" class="link_unstyle"><?= BaseService::SplitText($item['title'], 90) ?></a></h3>
                                        <div class="des max-line max-line-3 ismb"><?= $item['description'] ?></div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-3">
            <div class="mb-15">
                <div class="p-1 ads border mb-2">
                    <?= AdsWidget::widget(["width" => "300", "height" => "250", "id" => 28]) ?>
                </div>
                <div class="p-1 ads border mb-2">
                    <?= AdsWidget::widget(["width" => "300", "height" => "250", "id" => 29]) ?>
                </div>
            </div>
            <?php
            $docnhieu1 = new News;
            if ($docnhieu1->getReadweek()) :
            ?>
                <div class="list-post-detail_2 mb-10">
                    <div class="box-article-cat mb-15 border">
                        <div class="box-article-cat_head pt-5px pb-5px">
                            <h2 class="f-roboto-b t-20 title">Được quan tâm</h2>
                        </div>
                        <ul class="list-post">
                            <?php foreach ($docnhieu1->getReadweek() as $dn1) : ?>
                                <li class="clearfix">
                                    <div class="media">
                                        <a href="<?php echo Url::to(['/news/detail', 'slug' => $dn1->slug]); ?>" class="d-block">
                                            <?= Html::img(\Yii::$app->params['mediaUrl'] . $dn1->avatar, ['alt' => $dn1->slug, 'class' => 'mr-5px', 'width' => 100]) ?>
                                        </a>
                                        <div class="media-body">
                                            <h3 class="t-14 f-roboto-b mb-1 max-line max-line-3"><a href="<?php echo Url::to(['/news/detail', 'slug' => $dn1->slug]); ?>" class="link_unstyle"><?= BaseService::SplitText($dn1->title, 90) ?></a></h3>
                                            <!-- <div class="cl-737373 t-11 d-flex align-items-center">
                                                <img src="../images/icon-clock.png" alt="" class="mr-1"><span><?php echo $dn1->created_date ?></span>
                                            </div> -->
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <div class="ispc">
                <?= ViewCateHomeWidget::widget(["style" => "CateDetailWidget2", "slug" => "tieu-diem", "name" => "Tiêu điểm", "cate" => 13, "item" => 8]) ?>
            </div>
            <?php if (isset($newslast[0])) : ?>
                <div class="list-post-detail_2 mb-15 ttmn">
                    <div class="box-article-cat border">
                        <div class="box-article-cat_head pt-5px pb-5px">
                            <h2 class="f-roboto-b t-20 title">Tin tức mới nhất</h2>
                        </div>
                        <ul class="list-post-global pt-10 list-post-last">
                            <?php foreach ($newslast as $item) : ?>
                                <li><a href="<?= Url::to(['news/detail', 'slug' => $item['slug']]) ?>" class="link_unstyle f-roboto-b"><?= BaseService::SplitText($item['title'], 90) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mb-15 sticky">
                <div class="p-1 ads border mb-2">
                    <?= AdsWidget::widget(["width" => "300", "height" => "600", "id" => 27]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-15">
    <div class="text-center pb-3 ads border-bottom">
        <?= AdsWidget::widget(["width" => "728", "height" => "90", "id" => 13]) ?>
    </div>
</div>
<div class="modal fade" id="modal_show_ok">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông báo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                Bình luận thành công !!!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đồng ý</button>

            </div>
        </div>
    </div>
</div>


<?php
$script = <<< JS
   if($(".content").height() <1000){
       $(".sticky").hide();
       $(".ttmn").hide();
   }
JS;
$this->registerJs($script, View::POS_END);
?>