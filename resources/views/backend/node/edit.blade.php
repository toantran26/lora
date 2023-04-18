
<div class="modal-dialog" data-width="600">
    <div class="modal-content">
        <form action="{{route('update-node',['id'=>$data->id])}}" method="post" id="form_category">
        @method('post')
        @csrf
        <input hidden name="id" value="{{$data->id}}">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin node - <span class="name-title-header">{{$data->name}}</span> </h5>
            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Tên</label>
                @error('name')
                    <p style="color: red; font-size: 14px">* {{ $message }}</p>
                @enderror
                <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}"
                    aria-describedby="emailHelp" placeholder="">
            </div>
            <div class="form-group">
                <small id="code" class="form-text text-muted">Code</small>
                <input type="text" name="code" class="form-control" id="code" value="{{$data->code}}">
            </div>
            <div class="form-group">
                <label for="gateway_id">gateway</label> 
                <select class="form-control user_cms" id="gateway_id" name="gateway_id">
                    <option value="" >không chọn</option>
                    @foreach ($listGateway as $index => $item)
                        <option value="{{ $item->id }}" {{($item->id == $data->gateway_id) ? 'selected="selected"':'' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
            {{-- <div class="form-group">
                <label for="rec">rec</label>
                @error('rec')
                    <p style="color: red; font-size: 14px">* {{ $message }}</p>
                @enderror
                <input type="text" name="rec" class="form-control" id="rec" value="{{$data->rec}}">
            </div>
            <div class="form-group">
                <label for="remote">remote</label>
                @error('remote')
                    <p style="color: red; font-size: 14px">* {{ $message }}</p>
                @enderror
                <input type="text" name="remote" class="form-control" id="remote" value="{{$data->remote}}">
            </div> --}}
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="submit" id="submit_category">Cập nhật</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
        </div>
        </form>
    </div>
</div>
<script>
</script>