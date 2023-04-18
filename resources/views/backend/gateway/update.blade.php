@extends('backend.layout.index')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa chuyên mục  </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('cate-list') }}">chuyên mục</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                {{-- <form class="form-horizontal"> --}}
                <form action="{{route('post-edit-cate',['id'=>$data['category']->id])}}" method="post" id="submitForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$data['category']->id}}">
                    <div class="row">
                        <div class="col-md-11" style="margin: auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="category_name">Tên chuyên mục <span
                                                                        style="color: red">*</span></label>
                                                                @error('category_name')
                                                                    <span style="color: red; font-size: 14px">{{ $message }}
                                                                    </span>
                                                                @enderror
                                                                <input type="text" id="title" value="{{ old('category_name',$data['category']->category_name) }}"
                                                                    class="form-control" name="category_name" aria-invalid="false">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-description has-success">
                                                                <label class="d-block control-label" for="cate_id">Chuyên mục cha</label>
                                                                @error('cate_id')
                                                                <p style="color: red; font-size: 14px">* {{$message}}</p>
                                                                @enderror
                                                                <select class="form-control" id="exampleFormControlSelect1" name="cate_id">
                                                                    <option value="" {{$data['category']->parent_id == 0 ?'selected':''}} >Chuyên mục gốc</option>
                                                                    @foreach($data['allCategory'] as $index => $parent)
                                                                        <option value="{{$parent->id}}" {{$parent->id == $data['category']->parent_id ?'selected':''}}>{{$parent->category_name}}</option>
                                                                        @foreach($parent['children'] as $index => $child)
                                                                            <option value="{{$child->id }}" {{$child->id == $data['category']->parent_id ?'selected':''}}>|-- {{$child->category_name}}</option>
                                                                            @foreach ($child['children2'] as $index2 => $child2)
                                                                            <option value="{{$child2->id }}" {{$child2->id == $data['category']->parent_id ?'selected':''}}> &nbsp; |--- {{$child2->category_name}}</option>
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endforeach
                                                                </select>
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="en_category_name">Tên chuyên mục tiếng anh (nếu có)</label>
                                                                @error('en_category_name')
                                                                    <span style="color: red; font-size: 14px">{{ $message }}
                                                                    </span>
                                                                @enderror
                                                                <input type="text" id="category_name" value="{{ old('en_category_name',$data['category']->en_category_name) }}"
                                                                    class="form-control" name="en_category_name" aria-invalid="false">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group col-sm-6">
                                                            <div class="wrap-count field-news-title has-success">
                                                                <label class="control-label" for="en_category_name">Vị trí trang chủ</label>
                                                                    <select class="form-control" id="exampleFormControlSelect1" name="top_cate">
                                                                        <option value="" selected disabled hidden>Chọn vị trí</option>
                                                                        @for ($i = 1; $i < 4; $i++)
                                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-sm-12">
                                                            <div class="card card-primary">
                                                                <div class="card-header p-2">
                                                                    <h3 class="card-title"><i class="fas fa-cog pr-2"></i>Cài đặt SEO</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleCheck1">Slug</label>
                                                                        <input type="text" name="slug" class="form-control" id="slug" value="{{$data['category']->slug}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleCheck1">Key SEO</label>
                                                                        <input type="text" name="key_seo" class="form-control" id="exampleCheck1" value="{{$data['category']->key_seo}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleCheck1">Title SEO</label>
                                                                        <input type="text" name="title_seo" class="form-control" id="exampleCheck1" value="{{$data['category']->title_seo}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleCheck1">Desc SEO</label>
                                                                        <input type="text" name="desc_seo" class="form-control" id="exampleCheck1" value="{{$data['category']->desc_seo}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="card card-primary mt-4">
                                                        <div class="card-header p-2">
                                                            <span class=""><i class="fas fa-globe-americas pr-2"></i>Push Layouts</span>
                                                        </div>
                                                        <div class="card-body">
                                                            <div>
                                                                <a href="{{route('delete-cate',['id'=>$data['category']->id])}}" onclick="return confirm('Bạn có chắc chắn muốn xóa chuyên mục này?')" class="btn_trash">Bỏ vào thùng rác</a>
                                                                <button type="submit" class="btn bg-success float-right">Cập nhật</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script>
    $('#avatar').change(function () {
            const [file] =(this).files;
            if (file) {
                console.log(URL.createObjectURL(file))
                $('#avatar-show').attr("src", URL.createObjectURL(file));
            }
        })
</script>
@endsection
