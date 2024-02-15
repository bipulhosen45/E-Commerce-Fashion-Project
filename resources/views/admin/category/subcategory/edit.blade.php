<form action="{{ route('subcategory.update') }}" method="POST">
    @csrf  
    <div class="modal-body">
        <div class="mb-3">
            <label for="category_name" class="form-label">Category name</label>
            <select class="form-select" name="category_id" aria-label="Default select example">
                <option selected>Select Category</option>
                @foreach ($category as $row)
                    <option value="{{ $row->id }}" @if ($row->id == $data->category_id) selected @endif>{{ $row->category_name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{ $data->id }}">
        </div>

        <div class="mb-3">
            <label for="subcategory_name" class="form-label">Sub-Category name</label>
            <input type="text" class="form-control" name="subcategory_name" value="{{$data->subcategory_name}}" required>
            <small id="emailHelp" class="form-text text-muted">This is your sub category</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
