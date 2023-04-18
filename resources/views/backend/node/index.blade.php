@extends('backend.layout.index')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper mt-2">
        <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="content-header">
                    <div class="float-right">
                      <form class="card-tools" action="">
                        <div class="input-group input-group-sm" style="width: 350px;">
                            <input type="text" name="keyword" value="{{ @$_GET['keyword']}}" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-header">
                    <h3 class="card-title" style="font-size: 24px">Quản lý  Node </h3>
                    <div class="float-right">
                      <a href="#" role="button" data-toggle="modal" data-target="#create_model" class="btn btn-success"><i
                          class="fas fa-plus"></i> Thêm mới</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Tên node</th>
                          <th>ID</th>
                          <th>Gateway</th>
                          {{-- <th>Kênh nhận</th>
                          <th>Kênh điều khiển</th> --}}
                          <th>Thao tác</th>

                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($listNode as $key => $value)
                          <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->code }}</td>
                            <td>{{ $value->gateway->name }}</td>
                            {{-- <td>{{ $value->rec }}</td>
                            <td>{{ $value->remote }}</td> --}}
                            <td>
                              <div class=" text-center">
                                <a href="javascript:void(0)" data-toggle="dropdown"
                                  class="btn-default btn-xs dropdown-toggle">
                                  <span class="fas fa-cog"></span>
                                </a>
                                <ul class="dropdown-menu" id="dropdown{{$value->id}}">
                                  <li>
                                    <a class="btn_edit" data-id="{{$value->id}}" href="{{route('edit-node',['id'=>$value->id])}}">
                                      <i class="fas fa-edit"></i>
                                      Chỉnh sửa
                                    </a>
                                  </li>
                                  <li class="remove-button">
                                    <a class="delete-node" data-toppic="remove#{{hexdec($value->code)}}" data-push="{{$value->gateway->code.'/'.$value->gateway->remote}}"
                                      href="{{route('delete-node',['id'=>$value->id])}}">
                                      <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    @if (count($listNode) <= 0)                   
                      <p style="font-size: 24px;color: #999;margin: 38px 0;font-style: italic;text-align: center;">Không có bản ghi nào!</p>
                    @endif
                  </div>
                  <!-- /.card-body -->    
                  <div class="d-flex mt-3 ml-4">
                    @include('component.pagination-admin', $object = $listNode)
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" method="post" id="form_category">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới Node </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        @error('name')
                            <p style="color: red; font-size: 14px">* {{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">ID</small>
                        <input type="text" name="code" class="form-control" id="code">
                    </div>
                    <div class="form-group">
                      <label for="gateway_id">gateway</label> 
                      <select class="form-control user_cms" id="gateway_id" name="gateway_id">
                          <option value="" >không chọn</option>
                          @foreach ($listGateway as $index => $item)
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="rec">rec</label>
                        @error('rec')
                            <p style="color: red; font-size: 14px">* {{ $message }}</p>
                        @enderror
                        <input type="text" name="rec" class="form-control" id="rec">
                    </div>
                    <div class="form-group">
                        <label for="remote">remote</label>
                        @error('remote')
                            <p style="color: red; font-size: 14px">* {{ $message }}</p>
                        @enderror
                        <input type="text" name="remote" class="form-control" id="remote">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="submit_category">Lưu lại</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div id="modal_node_type" class="modal fade royalty-post" data-backdropz="static" data-width="600"></div>

@endsection
@section('script')
<script>
  $(document).ready(function () {
      $('#submit_category').on('click',function(event) { 
        event.preventDefault();
        var name = $('#name').val();
        var code = $('#code').val();
        var gateway_id = $('#gateway_id').val();
        var form_data = new FormData();
        form_data.append('name', name);
        form_data.append('code', code);
        form_data.append('gateway_id', gateway_id);
        $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        type: "POST",
        url: "{{route('node-store')}}",
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (result) {
          console.log(result.data);
          if(result.success){
              public(result.push,result.toppic);
              toastr["success"](result.success);
              setTimeout(() => {
                location.reload();
              }, "1000");
              $(this).off(event);
            }else{
              $.each(result.error, function( key, value ) {
                  toastr["error"](value);
              });
            }
        }
      })    
      })
  });
  $(document).ready(function() {
    $('a.delete-node').on('click', function(event) {
      event.preventDefault();
      const confirmation = confirm('Bạn có chắc chắn muốn xóa node này?');
      if (confirmation) {
        var push = $(this).attr('data-push');
        var toppic = $(this).attr('data-toppic');
        public(push,toppic);

        // console.log(push);
        // console.log(toppic);
        window.location.href = $(this).attr('href');
      }
    });
  });
</script>
<script>
      

  $(document).ready(function(){

    $('.btn_edit').click(function(){
        var id = $(this).data('id');
        var $modal_node_type = $('#modal_node_type');
        $modal_node_type.load('/node/edit/'+id, '', function(){
            $modal_node_type.modal().on("hidden", function() {
                $modal_node_type.empty();
            });
        });
        return false;
    });
  })
</script>
@endsection
