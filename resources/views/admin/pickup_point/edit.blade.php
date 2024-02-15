<form action="{{ route('pickuppoint.update') }}" method="POST" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="pickup_point_name" class="form-label">Pickup Point Name</label>
            <input type="text" name="pickup_point_name" id="" class="form-control @error('pickup_point_name') is-invalid @enderror" value="{{$data->pickup_point_name}}" required>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="mb-3">
            <label for="pickup_point_address" class="form-label">Pickup Point Address</label>
            <textarea name="pickup_point_address" id="" class="form-control @error('pickup_point_address') is-invalid @enderror" cols="30" rows="2">{{$data->pickup_point_address}}</textarea>
        </div>
        <div class="mb-3">
            <label for="pickup_point_phone" class="form-label">Pickup Point Phone</label>
            <input type="number" class="form-control @error('pickup_point_phone') is-invalid @enderror" name="pickup_point_phone" id="pickup_point_phone" value="{{$data->pickup_point_phone}}" required>
        </div>
        <div class="mb-3">
            <label for="pickup_point_phone_two" class="form-label">Pickup Point Phone Two</label>
            <input type="number" class="form-control @error('pickup_point_phone_two') is-invalid @enderror " name="pickup_point_phone_two" id="pickup_point_phone_two" value="{{$data->pickup_point_phone_two}}" required>
        </div>
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="btn btn-danger btn_close" data-bs-dismiss="modal">Close</button> --}}
        <button type="submit" class="btn btn-primary"><span class="loading d-none">Loading...</span>Submit</button>
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
