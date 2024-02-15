<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 30px;
        height: 30px;
        margin-left: 45%;
        margin-top: 15%;
        margin-bottom: 18%;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

@php
    $color = explode(',', $product->color);
    $sizes = explode(',', $product->size);
@endphp
{{-- preloader for product quick view --}}
<div class="loader"></div>

<div class="modal-body product_view d-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="">
                    <img src="{{ asset('backend/files/product/' . $product->thumbnail) }}" height="50%" width="100%">
                </div>
            </div>
            <div class="col-lg-8 ">
                <h3>{{ $product->name }}</h3>
                <p >{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
                <p style="margin-top: -7%">Brand: {{ $product->brand->brand_name }}</p>
                <p style="margin-top: -7%">Stock: @if ($product->stock_quantity < 1)
                        <span class="badge badge-danger">Stock Out</span>
                    @else
                        <span class="badge badge-success">Stock Available</span>
                    @endif
                </p>
                <div class="">
                    @if ($product->discount_price == null)
                        <div class="">Price: {{ $setting->currency }}{{ $product->selling_price }}</div>
                    @else
                        <div class="">
                            Price: <del class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del
                                class="text-danger">
                            {{ $setting->currency }}{{ $product->discount_price }}</div>
                    @endif
                </div>

                    <div class="order_info d-flex flex-row">
                        <form action="{{route('add.to.cart.quickview')}}" method="post" id="add_cart_form">
                            @csrf
                            {{-- cart add details --}}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @if ($product->discount_price == null)
                                <input type="hidden" name="price" value="{{ $product->selling_price }}">
                            @else
                                <input type="hidden" name="price" value="{{ $product->discount_price }}">
                            @endif

                    
                            <div class="form-group" style="margin-top: -15%">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                        <label for="" class="form-label">Size</label>
                                        <select name="size" class="form-control form-control-sm" id="">
                                            @isset($product->size)
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size }}">{{ $size }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Color</label>
                                        <select name="color" class="form-control form-control-sm" id="">
                                            @isset($product->color)
                                                @foreach ($color as $row)
                                                <option value="{{ $row }}">{{ $row }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex">
                                        <label for="" class="form-label d-flex">Quantity: </label>
                                        <div class="col-sm-8">
                                        <input type="number" min="1" max="100" name="qty" pattern="[1-9]*" value="1" class="form-control d-flex form-control-sm" id="">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                                <div class="button_container d-block" style="margin-top: -5%">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        @if ($product->stock_quantity <1)
                                        <span class="text-danger">Stock Out</span>
                                        @else
                                        <button class="btn btn-primary" type="submit" style="float: right;">
                                            <span class="loading d-none">....</span> Add to cart</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>

<script type="text/javascript">
    //store coupon ajax call
    $('#add_cart_form').submit(function(e) {
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
                $('#add_cart_form')[0].reset();
                $('.loading').addClass('d-none');
                cart();
            }
        });
    });
</script>

<script type="text/javascript">
    $('.loader').ready(function() {
        setTimeout(function() {
            $('.product_view').removeClass("d-none");
            $('.loader').css("display", "none");
        }, 500);
    });
</script>

