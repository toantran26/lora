
<meta name="author" content="{{substr (Request::root(), 7)}}" />
<meta name="copyright" content="{{substr (Request::root(), 7)}}" />
<link rel="canonical" href="{{substr (Request::root(), 7)}}" />
<link href="{{asset('frontend/images/logo.png')}}" rel="apple-touch-icon">
<link rel="shortcut icon" href="{{asset('frontend/images/logo.png')}}">
<meta name="image" content="{{asset('frontend/images/logo.php')}}" />
<meta name="thumbnail" content="{{asset('frontend/images/logo.png')}}" />
<link href="{{asset('frontend/images/logo.png')}}" rel="shortcut icon" type="image/x-icon" />
@if(isset($post))
    @php
        $tags = '';
        foreach ($post->tags as $tag) {
            $tags .= $tag->name_tag.',';
        }
    @endphp
<title>{{$post->title}}</title>
<meta name="keywords" content="{{$tags ?? ''}}">
<meta name="description" charset="UTF-8" content="{{$post->desc_seo ?? $post->description}}" />
<meta name="title" charset="UTF-8" content="{{$post->title_seo ?? $post->titles}}" />
@else
    <title>Hoang Mai Group tạo ra sản phẩm tuyệt vời cho khách hàng khắp Việt Nam</title>
@endif

<!-- for Facebook -->
<meta property="og:title" content="{{ConfigSite::getInfoByName('title_seo')}}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{asset('frontend/images/logo.png')}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:description" content="{{ConfigSite::getInfoByName('desc_seo')}}" />
<meta name="og:keywords" content="{{ConfigSite::getInfoByName('key_seo')}}">

<meta property="og:site_name" content="{{ConfigSite::getInfoByName('desc_seo')}}" />
<meta property="fb:admins" content=""/>
<meta property="fb:app_id" content="" />
<meta property="og:locale" content="vi_VN" />

<!-- for Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="Tiêu đề" />
<meta name="twitter:description" content="Mô tả" />
<meta name="twitter:image" content="Link ảnh đại diện của trang, mỗi trang 1 link khác nhau" />
{{-- $head_page .= '<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage": "'.$this_link.'",
    "headline": "'.$title_page.'",
    "datePublished": "'.$startDate_schema.'",
    "dateModified": "'.$dateModified_schema.'", 
    "description": "'.$description_page.'",
    "author": { 
    "@type": "Person", 
    "name": "'.$name_schema.'"   
    },
    "publisher": {  
    "@type": "Organization", 
    "name": "vovgiaothong", 
    "logo": { 
    "@type": "ImageObject",
    "url": "'.URL_IMAGES.'/logo.png",
    "width": 206
        }   
    },  
    "image": {
    "@type": "ImageObject",
    "url":'.$url_img_chema.',
    "height": 857,
    "width": 1280    
    }   
}'; --}}
