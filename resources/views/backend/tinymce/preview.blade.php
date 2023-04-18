<!DOCTYPE html>
<html lang="vi">

<head>
  <link href="{{asset('library/editor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('library/editor/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

  <link href="{{asset('library/editor/css/font.css?v=1')}}" rel="stylesheet">
  <link href="https://doanhnghiepthuonghieu.vn/css/style.css?v=<?= time() ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}" />
  <script src="{{asset('library/editor/js/jquery-1.10.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('library/editor/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('library/editor/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>

  <style>
    .container {
      width: 780px;
    }

    .content p {
      margin-bottom: 1em !important;
    }

    .content p:empty {
      height: 15px;
    }


    .tab-content {
      padding: 0 20px;
      background: #fff;
    }

    #menu1 .content-single {
      background: var(--light-gray);
    }

    .nav-tabs {
      border-bottom: 0;
    }

    .nav-tabs>li>a {
      font-family: Arial;
      font-size: 30px;
    }

    .nav-tabs>li,
    .nav-pills>li {
      float: right;
    }

    #menu1 .content-single {
      width: 375px;
      position: relative;
      margin: 0 auto;
      padding: 0 10px;
    }

    #menu1 .content-single .title-single {
      margin-top: 0;
    }

    #home .content-single .content figure {
      width: 85%;
    }



    .preview .content figure {
      width: 85%;
      margin: 0 auto;
      margin-bottom: 1em;
    }

    .preview .content figure figcaption {
      padding: 5px;
      text-align: center;
      background: #ececec;
      margin-bottom: 1rem;
      font-style: italic;
      font-size: 17px;
    }

    .preview .content figure img {
      margin-bottom: 0;
      width: 100%;
    }

    body {
      font-size: 18px;
    }

    .cl-083f59 {
      color: #333;
      line-height: 1.2;
    }

    .dt-des {
      color: #333;
      line-height: 1.3;
      margin-bottom: 15px;
      font-family: 'Roboto';
      font-weight: 500;
      font-size: 17px;
    }

    .preview .content .content-mb p,
    .preview .content .content-mb span,
    .preview .content .content-mb em {
      font-size: 20px;
      font-family: "Roboto";
      font-style: normal;
      font-weight: 500;
      line-height: 1.3em;
      color: #333;
      margin-block-start: 0em;
      margin-block-end: 0em;
    }
  </style>
  <style type="text/css">
    @media (max-width: 991px) {

      .social {
        display: none !important;
        right: 30px !important;
        bottom: 100px !important;
        top: unset;
      }
    }

    .main-content.single-page .content-main * {
      max-width: 100%;
    }

    .main-content.single-page .content span,
    .main-content.single-page .content p {
      font-size: 17px;
      font-family: Roboto;
      font-style: normal;
      font-weight: 400;
      line-height: 1.3em;
      color: #333;
      margin-block-start: 0em;
      margin-block-end: 0em;
      margin-bottom: 1em;
      text-align: justify;
    }

    .main-content.single-page .content strong {
      font-family: "Roboto";
      font-weight: bold;
    }

    em {
      background: unset !important;
    }

    .list-blog-category .list-view {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      padding-bottom: 50px;
    }

    .list-blog-category .list-view .item-blog {
      width: calc(50% - 15px);
    }

    .main-content.single-page .section-1 .list-blog-category .btn-loadmore {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }

    .pswp--zoom-allowed .pswp__img {
      object-fit: contain;
      height: auto !important;
    }

    .single-page .content-main figure img {
      cursor: zoom-in;
    }

    .single-page .content-main figure.expNoEdit {
      position: relative;
    }

    .single-page .content-main figure.expNoEdit::before {
      position: absolute;
      content: 'Nhấn để phóng to ảnh';
      font-size: 12px;
      padding: 0 20px;
      top: 0;
      width: 90%;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, .2);
      color: #fff;
      overflow: hidden;
      height: 0;
      display: flex;
      margin: 0 auto;
      transition: all .3s ease;
    }

    .single-page .content-main figure.expNoEdit:hover::before {
      height: 30px;

    }

    .main-content.single-page .content .quote span {
      font-family: 'Roboto';
    }
  </style>
</head>

<body class="preview">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-desktop" aria-hidden="true"></i></a></li>
    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-mobile" aria-hidden="true"></i></a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active view-pc">

      <main class="main-content category-page single-page">
        <div class="container">
          <section class="section-1">
            <div class="">
              <div class="col-12 col-sm-12 col-xl-8 dt-left col-71">

                <div id="contentPrint">
                  <h1 class="title-single t-25 f-roboto-b cl-083f59 mb-10">
                  </h1>
                  <!-- <div class="infomation-mb-single">
                                        <a href="/thong-tin-%E2%80%93-tu-lieu/nghien-cuu-bao-chi-truyen-thong" class="category">Nghiên cứu báo chí truyền thông</a>
                                        <span class="date">Thứ năm, 28-01-2021 09:26</span>
                                    </div> -->
                  <br>
                  <div class="description-single dt-des">
                  </div>

                  <div class="content content-main" style="display: inline-block;width: 100%;">
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
    </div>
    <div id="menu1" class="tab-pane fade view-mb">
      <div class="content-single">
        <h1 class="title-single t-25 f-roboto-b cl-083f59 mb-10"> </h1>

        <p class="description-single dt-des">
        </p>

        <div class="content">
        </div>
        <div class="mask"></div>
      </div>
    </div>
  </div>



  <script>
    var args = top.tinymce.activeEditor.windowManager.getParams();
    console.log(args);
    $('.title-single').html(args.title);
    $('.description-single').html(args.description);
    $('.content').html(args.content.replace(/<\/p>/i, '<\/p>'));
  </script>
</body>

</html>
