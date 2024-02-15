<form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="brand_name" class="form-label">Brand name</label>
            <input type="text" name="brand_name" id="" class="form-control" value="{{ $data->brand_name }}">
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="brand-name">Home Pgae Show</label>
            <select class="form-control" name="front_page">
              <option value="1" @if($data->front_page==1) selected @endif>Yes</option>
              <option value="0" @if($data->front_page==0) selected @endif>No</option>
            </select>
            <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page </small>
          </div> 
        <div class="mb-3">
            <label for="brand_logo" class="form-label">Brand Logo</label>
            <div><img src="{{asset($data->brand_logo)}}" width="120" height="60" alt=""></div>
            <input type="file" class="form-control" name="brand_logo" >
            <small id="emailHelp" class="form-text text-muted">This is your Brand</small>
            <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none">loading....... </span> Update</button>
    </div>
</form>
