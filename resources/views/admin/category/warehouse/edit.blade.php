<form action="{{route('warehouse.update', $data->id)}}" method="POST" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="warehouse_name" class="form-label">Warehouse name</label>
            <input type="text" class="form-control" name="warehouse_name" id="warehouse_name"
                required value="{{$data->warehouse_name}}">
        </div>
    <input type="hidden" name="id" id="" value="{{ $data->id }}">
        <div class="mb-3">
            <label for="warehouse_address" class="form-label">Warehouse Address</label>
            <input type="text" class="form-control" name="warehouse_address" id="warehouse_address"
                required placeholder="Warehouse Address" value="{{$data->warehouse_address}}">
        </div>
    
        <div class="mb-3">
            <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
            <input type="number" class="form-control" name="warehouse_phone" id="warehouse_phone"
                required placeholder="Warehouse phone" value="{{$data->warehouse_phone}}">
            <small id="emailHelp" class="form-text text-muted">This is your Warehouse</small>
        </div>
    
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none loader"><i class="fas fa-spinner"></i> loading.... </span> <span class="submit_btn">Submit</span></button>
    </div>
</form>
