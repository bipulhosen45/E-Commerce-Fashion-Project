<form action="{{ route('coupon.update', $data->id) }}" method="POST" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="coupon_code" class="form-label">Coupon Code</label>
            <input type="text" name="coupon_code" id="" class="form-control" value="{{ $data->coupon_code }}" required>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">

        <div class="mb-3">
            <label for="type" class="form-label">Coupon Type</label>
            <select name="type" id="" class="form-control" required>
                <option value="1" @if ($data->type == 1) selected @endif>Fixed</option>
                <option value="2" @if ($data->type == 2) selected @endif>Parcentage</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="coupon_amount" class="form-label">Amount</label>
            <input type="number" class="form-control" name="coupon_amount" id="coupon_amount" value="{{ $data->coupon_amount }}" required>
        </div>
        <div class="mb-3">
            <label for="valid_date" class="form-label">Valid Date</label>
            <input type="date" class="form-control" name="valid_date" id="valid_date" value="{{ $data->valid_date }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Coupon Status</label>
            <select name="status" id="" class="form-control" required>
                <option value="Active" @if ($data->status == 'Active') selected @endif>Active</option>
                <option value="Inactive" @if ($data->status == 'Inactive') selected @endif>Inactive</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="btn btn-danger btn_close" data-bs-dismiss="modal">Close</button> --}}
        <button type="submit" class="btn btn-primary"><span class="loading d-none">Loading...</span> Submit</button>
    </div>
    </div>
    </div>
</form>

<script>
    //Coupon edit ajax call
    $('#edit_form').submit(function(e) {
        e.preventDefault();
        $('.loading').removeClass('d-none');
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#edit_form')[0].reset();
                $('.loading').addClass('d-none');
                $('#editModal').modal('hide');
                table.ajax.reload();
            }
        });
    });
    //Coupon edit ajax call end
</script>
