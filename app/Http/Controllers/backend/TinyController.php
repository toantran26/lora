<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Image;

class TinyController extends Controller
{
//    protected $ffmpeg = 'C:\Users\ASUS\ffmpeg-2022-07-06-git-03d81a044a-essentials_build\bin\ffmpeg.exe';

    protected $ffmpeg = "/usr/bin/ffmpeg";
    public function image(Request $request)
    {
    
        $tab = $request->get('tab', 1);
        $is_news = $request->get('is_news', 0);
        $page = $request->get('page', -1);
        $keyword = $request->get('q', '');
        $wm = $request->post('wm', 0);
        $image = $request->post('image', '');

        if ($page != -1) {
            $tab = 3;
        }

        $media = Media::where('type', 0)
            ->orderBy('id', 'DESC')
            ->get();

        if ($is_news == 1) {
            $query = Media::where('like', $keyword)
                ->where('type', 0)
                ->orderBy('id', 'DESC');
        } else {
            $query = Media::where('caption', 'like', '%' . $keyword . '%')
                ->orWhere('name', 'like', '%' . $keyword . '%')
                ->where('type', 0)
                ->orderBy('id', 'DESC');
        }

        $models = $query->paginate(12);

        if ($image != '') {
            $path = public_path("uploads/images");
            $names = explode('/', $image);
            $name = $names[count($names) - 1];
            $ch = curl_init($image);
            $fp = fopen($path .'/'. $name, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $modelMedia = new Media();
            $modelMedia->name = $name;
            $modelMedia->link = '/uploads/images/' . $name;
            $modelMedia->type = 0;
            $modelMedia->created_at = date('Y-m-d H:s:i');
            $modelMedia->save();

            $tab = 2;

            return redirect('/admin/editor/image')->with(compact('tab'));
        }

        if (isset($_FILES['file'])) {
            $name = $_FILES['file']['name'];

            $filename = time() . $name;

            $path = public_path('uploads/images');

            $image = $_FILES['file']['tmp_name'];
            

            $imginfo = getimagesize($image);
           
            if ($wm) {
                $watermarkImage = public_path('backend/watermark/watermark.png');
                $markinfo = getimagesize($watermarkImage);
    
                $top = (($imginfo[0] - $markinfo[0] - 20) < 0) ? 0 : $imginfo[0] - $markinfo[0] - 20;
                $left = (($imginfo[1] - $markinfo[1] - 20) < 0) ? 0 : $imginfo[1] - $markinfo[1] - 20;
    
                $newImage = Image::make($image);
                $newImage->insert($watermarkImage, 'bottom-right', $top, $left);
                $newImage->save($path . '/' . $filename);
            } else {
                $request->file->move($path, $filename);
            }

            $modelMedia = new Media();
            $modelMedia->name = $filename;
            $modelMedia->link = '/uploads/images' . '/' . $filename;
            $modelMedia->type = 0;
            $modelMedia->created_at = date('Y-m-d H:s:i');
            $modelMedia->save();

            return '<figure class="expNoEdit"><img src="' . '/' . 'uploads/images' . '/' . $filename . '" alt="' . $name . '" width="' . $imginfo[0] . '" height="' . $imginfo[1] . '" /></figure>';
        }

        return view('backend.tinymce.image', compact('media', 'tab', 'models'));
    }

   /* video */
   public function video(Request $request)
   {
       $this->layout = false;

       $is_news = $request->get('is_news', 0);
       $keyword = $request->get('q', '');
       $tab = $request->get('tab', 1);
       $page = $request->get('page', -1);

       if ($page != -1) {
           $tab = 3;
       }

       $media = Media::where('type', 1)
           ->orderBy('id', 'DESC')
           ->get();

       if ($is_news == 1) {
           $query = Media::where('type', 1)
               ->orderBy('id', 'DESC');
       } else {
           $query = Media::where('caption', 'like', '%' . $keyword . '%')
               ->orWhere('name', 'like', '%' . $keyword . '%')
               ->where('type', 1)
               ->orderBy('id', 'DESC');
       }

       $models = $query->paginate(12);

       if (isset($_FILES['file'])) {
           $path = public_path("uploads/videos");
           $name = str_replace("-mp4", ".mp4", $this->makeAlias($_FILES['file']['name']));
           $filename = time() . $name;

           $request->file->move($path, $filename);

           $info = $this->get_video_attributes($path.'/'. $filename, $this->ffmpeg);

           $min = $info['mins'];
           $sec = $info['secs'];
           $min1 = (int)((int)$min / 2);
           $sec1 = (int)((int)$sec / 2);

           $min1 = ($min1 > 9) ? "$min1" : "0$min1";
           $sec1 = ($sec1 > 9) ? "$sec1" : "0$sec1";

           $command = $this->ffmpeg . " -i " . $path . "/" . $filename . " -ss 00:00:01.000 -vframes 1 " . $path . "/" . $name . "-01.png";
           system($command);

           $command = $this->ffmpeg . " -i " . $path . "/" . $filename . " -ss 00:$min1:$sec1.000 -vframes 1 " . $path . "/" . $name . "-02.png";
           system($command);

           $modelMedia = new Media();
           $modelMedia->name = $_FILES['file']['name'];
           $modelMedia->link = '/uploads/videos'.'/'.$filename;
           $modelMedia->type = 1;

           $img1 = '/uploads/videos/'.$name."-01.png";
           $img2 = '/uploads/videos/'.$name."-02.png";

           if ($modelMedia->save()) {
               $mediaId = $modelMedia->id;
               return view('backend.tinymce._video-thumb', compact('img1', 'img2', 'mediaId'));
           } else {
               var_dump($modelMedia->errors);
               die;
           }
       }
       return view('backend.tinymce.video', compact('media', 'tab', 'models'));
   }

   public function setcover(Request $request)
   {
       $this->layout = false;

       $mediaid = $request->get('id', 0);
       $image = $request->get('image', 1);

       $model = Media::where('id', $mediaid)->first();
       $model->cover = $image;

       $newImage = Image::make(public_path($image));
       $imageSizes = $newImage->getSize();
       $width = $imageSizes->getWidth();
       $height = $imageSizes->getHeight();
       $rato = $height / $width;
       $height = intval(560 * $rato);

       if ($model->save()) {
           return '<p><iframe class="exp_video" src="/watch/' . $mediaid . '" width="100%" height=" 400px" frameborder="0" allowfullscreen="true"></iframe></p>';
       } else {
           return "";
       }
   }

   public function watch($id)
   {
       $this->layout = false;
       $data = Media::where('id', $id)->first();
       return view('backend.tinymce._watch', compact('data'));
   }

   public function insertVideo(Request $request)
   {
       $this->layout = false;

       $mediaid = $request->get('id', 0);

       $model = Media::where('id', $mediaid)->first();

       $newImage = Image::make(public_path($model->cover));
       $imageSizes = $newImage->getSize();
       $width = $imageSizes->getWidth();
       $height = $imageSizes->getHeight();
       $rato = $height / $width;
       $height = intval(560 * $rato);

       return '<p><iframe class="exp_video" src="/watch/' . $mediaid . '" width="100%" height="400px" frameborder="0" allowfullscreen="true"></iframe></p>';

   }

   public function link()
   {
       $this->layout = 'tiny';
       return view('backend.tinymce.link');
   }

   public function editimage()
   {
       $this->layout = false;
       return view('backend.tinymce.editimage');
   }

   public function resize($size,$path)
   {

       try {
           $sizes = explode('x', $size);
           $imageFullPath = public_path($path);

           if (!file_exists($imageFullPath)) {
               abort(404);
           }
        // dd($public_path('resizes'));
           $savedPath = public_path('resizes/'.$size.'/'.$path);

           $savedDir = dirname($savedPath);
        //    dd($savedDir);
           if (!is_dir($savedDir)) {
               mkdir($savedDir, 0777, true);
           }
           list($width, $height) = $sizes;

           $image = Image::make($imageFullPath)->fit($width, $height)->save($savedPath);
           return $image->response();

       } catch (\Throwable $th) {
           abort(404);
       }

   }

   public function pdf(Request $request)
   {
       if (isset($_FILES['file'])) {
           $name = $_FILES['file']['name'];

           $filename =time().$name;

           $path = public_path("uploads/pdf");

           $request->file->move($path, $filename);
           $modelMedia = new Media();
           $modelMedia->name = $filename;
           $modelMedia->link = $path.'/'.$filename;
           $modelMedia->type = 2;
           $modelMedia->save();

           // return '<object class="file-pdf" style="width:100%; height:50vh" type="application/pdf" data="' . \Yii::$app->params['baseUrl'] . '/'.  $path . '/' . $filename . '"></object>';

           return '<iframe  class="expNoEdit file-pdf" src="/uploads/pdf/'. $filename.'" alt="'.$name.'" style="width:100%;height:70vh"  frameborder="0" scrolling="yes"  />';
           // die;
       }
   }

   protected static function get_video_attributes($video, $ffmpeg)
   {
       $command = $ffmpeg . ' -i ' . $video . " -vstats 2>&1";
       $output = shell_exec($command);
       $regex_duration = "/Duration: ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}).([0-9]{1,2})/";
       if (preg_match($regex_duration, $output, $regs)) {
           $hours = $regs [1] ? $regs [1] : null;
           $mins = $regs [2] ? $regs [2] : null;
           $secs = $regs [3] ? $regs [3] : null;
           $ms = $regs [4] ? $regs [4] : null;
       }

       return array(
           'hours' => $hours,
           'mins' => $mins,
           'secs' => $secs,
           'ms' => $ms
       );
   }

   public function attack(Request $request)
   {
       if (isset($_FILES['file'])) {
           $name = $_FILES['file']['name'];

           $filename = time().$name;

           $path = public_path("uploads/file");

           $request->file->move($path, $filename);

           $modelMedia = new Media();
           $modelMedia->name = $filename;
           $modelMedia->link = $path . '/' . $filename;
           $modelMedia->type = 2;
           $modelMedia->save();
           return '<a   class="expNoEdit file" href="/uploads/file' . $filename . '" alt="' . $name . '">' . $filename . '</a>';
       }

       return view('backend.tinymce.file');
   }

   protected function makeAlias($str, $lowerCase = true)
   {
       $search = array(
           '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
           '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
           '#(ì|í|ị|ỉ|ĩ)#',
           '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
           '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
           '#(ỳ|ý|ỵ|ỷ|ỹ)#',
           '#(đ)#',
           '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
           '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
           '#(Ì|Í|Ị|Ỉ|Ĩ)#',
           '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
           '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
           '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
           '#(Đ)#',
           "/[^a-zA-Z0-9\-\_]/",
       );
       $replace = array(
           'a',
           'e',
           'i',
           'o',
           'u',
           'y',
           'd',
           'A',
           'E',
           'I',
           'O',
           'U',
           'Y',
           'D',
           '-',
       );
       $str = preg_replace($search, $replace, $str);
       $str = preg_replace('/(-)+/', '-', $str);
       $str = preg_replace('/^-+|-+$/', '', $str);
       if ($lowerCase)
           $str = strtolower($str);
       return $str;
   }

}
