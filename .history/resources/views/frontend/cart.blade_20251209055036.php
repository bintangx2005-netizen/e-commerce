@extends('frontend.layout.frontend_master')

@section('frontend')

<div class="page-header breadcrumb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="page-title">Shopping Cart</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            @if(count($carts) > 0)
                <div class="shopping-cart">
                    <div class="cart-table-head">
                        <div class="row row-cols-lg-5 row-cols-md-5 row-cols-sm-3 row-cols-xs-2 gy-3 gx-3">
                            <div class="col-lg-5"><h6 class="heading-6 ms-15">Product</h6></div>
                            <div class="col"><h6 class="heading-6 text-center">Price</h6></div>
                            <div class="col"><h6 class="heading-6 text-center">Qty</h6></div>
                            <div class="col"><h6 class="heading-6 text-center">Subtotal</h6></div>
                            <div class="col"><h6 class="heading-6 text-center">Action</h6></div>
                        </div>
                    </div>

                    @foreach($carts as $cart)
                        <div class="cart-table-wrap">
                            <div class="row row-cols-lg-5 row-cols-md-5 row-cols-sm-3 row-cols-xs-2 gy-3 gx-3">
                                <div class="col-lg-5">
                                    <div class="display-flex mb-15 mb-md-0">
                                        <div class="img-prod-small me-3">
                                            <img src="{{ file_exists(public_path('uploaded/product/'.$cart->product->thumbnail)) ? asset('uploaded/product/'.$cart->product->thumbnail) : asset('uploaded/no_image.jpg') }}" alt="{{ $cart->product->product_name }}" />
                                        </div>
                                        <div>
                                            <h6><a href="{{ route('product_details', [$cart->product->id, $cart->product->slug]) }}">{{ $cart->product->product_name }}</a></h6>
                                            <p class="text-muted">
                                                <span>Vendor: </span>
                                                <a href="{{ route('vendor_details', $cart->product->vendor_id) }}">{{ $cart->product->vendor->name ?? 'N/A' }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <h6 class="text-muted">{{ config('app.currency', '$') }}{{ $cart->product->selling_price }}</h6>
                                </div>
                                <div class="col text-center">
                                    <div class="qty-control accent">
                                        <span class="qty-btn btn-decrement">−</span>
                                        <input type="number" name="number" class="qty-val" value="1" min="1" />
                                        <span class="qty-btn btn-increment">+</span>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <h6 class="text-muted">{{ config('app.currency', '$') }}{{ $cart->product->selling_price }}</h6>
                                </div>
                                <div class="col text-center">
                                    <a href="#" class="btn-close remove-cart-btn" data-product-id="{{ $cart->product_id }}"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-40">
                    <div class="col-lg-7 col-md-12">
                        <div class="mb-20">
                            <h6 class="text-muted mb-15">Special Offers:</h6>
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="fi-rs-arrow-right me-10"></i>Save 5% on orders over $100</a></li>
                                <li><a href="#"><i class="fi-rs-arrow-right me-10"></i>Free shipping on all orders</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="apply-coupon">
                            <h6 class="text-muted mb-10">Have a coupon?</h6>
                            <div class="d-flex gap-3">
                                <input type="text" placeholder="Enter coupon code" />
                                <button class="btn btn-sm">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center mt-40">
                    <p class="text-muted mb-20">Your shopping cart is empty</p>
                    <a href="{{ route('home') }}" class="btn btn-md">Continue Shopping</a>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="sticky-top">
                <div class="card mb-2" style="border: 1px solid #e7e7e7;">
                    <div class="card-body">
                        <h5 class="mb-30">Order Summary</h5>
                        
                        <div class="summary-item d-flex justify-content-between mb-15">
                            <h6 class="text-body">Subtotal:</h6>
                            <h6 class="text-body">{{ config('app.currency', '$') }}<span id="subtotal">{{ $total_amount }}</span></h6>
                        </div>

                        <div class="summary-item d-flex justify-content-between mb-15">
                            <h6 class="text-body">Shipping:</h6>
                            <h6 class="text-body"><span id="shipping">0</span> (Flat Rate – Excluding Taxes)</h6>
                        </div>

                        <div class="summary-item d-flex justify-content-between mb-15">
                            <h6 class="text-body">Tax:</h6>
                            <h6 class="text-body">{{ config('app.currency', '$') }}<span id="tax">0</span></h6>
                        </div>

                        <hr class="my-20" />

                        <div class="summary-item d-flex justify-content-between">
                            <h5>Total:</h5>
                            <h5 class="heading-5 color-second">{{ config('app.currency', '$') }}<span id="total">{{ $total_amount }}</span></h5>
                        </div>

                        @if(count($carts) > 0)
                            <a href="#" class="btn btn-md w-100 mt-30">Proceed to Checkout</a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-md w-100 mt-30">Continue Shopping</a>
                        @endif

                        <a href="{{ route('home') }}" class="btn btn-light w-100 mt-10">Continue Shopping</a>
                    </div>
                </div>

                @if(count($carts) > 0)
                    <div class="card" style="border: 1px solid #e7e7e7;">
                        <div class="card-body">
                            <h6 class="mb-15">
                                <i class="fi-rs-shield-check"></i> <span class="ms-10">Security & Privacy</span>
                            </h6>
                            <p class="font-xs mb-15">Your security is important. We use industry-standard encryption.</p>
                            <h6 class="mb-15">
                                <i class="fi-rs-truck"></i> <span class="ms-10">Free Shipping & Returns</span>
                            </h6>
                            <p class="font-xs mb-15">We offer free shipping on orders over $100 with easy returns.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 0;
        color: white;
        margin-bottom: 40px;
    }

    .page-header .page-title {
        font-weight: 600;
        margin: 0;
    }

    .breadcrumb {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .breadcrumb li {
        display: inline-block;
        margin-right: 10px;
    }

    .breadcrumb li a {
        color: white;
        text-decoration: none;
    }

    .breadcrumb li:last-child {
        color: white;
    }

    .shopping-cart {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .cart-table-head {
        background: #f8f8f8;
        padding: 20px;
        border-bottom: 1px solid #e7e7e7;
    }

    .cart-table-wrap {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .img-prod-small {
        width: 80px;
        overflow: hidden;
        border-radius: 4px;
    }

    .img-prod-small img {
        width: 100%;
        height: 80px;
        object-fit: cover;
    }

    .qty-control {
        display: inline-flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        background: white;
    }

    .qty-btn {
        padding: 5px 10px;
        cursor: pointer;
        background: #f8f8f8;
        border: none;
        font-size: 16px;
    }

    .qty-btn:hover {
        background: #e7e7e7;
    }

    .qty-val {
        width: 50px;
        text-align: center;
        border: none;
        padding: 5px 0;
    }

    .qty-val:focus {
        outline: none;
    }

    .summary-item {
        font-size: 14px;
    }

    .btn-close {
        width: 20px;
        height: 20px;
        cursor: pointer;
        opacity: 0.6;
    }

    .btn-close:hover {
        opacity: 1;
    }

    .sticky-top {
        position: sticky;
        top: 20px;
    }

    @media (max-width: 768px) {
        .sticky-top {
            position: static;
            margin-top: 30px;
        }

        .img-prod-small {
            width: 60px;
        }

        .img-prod-small img {
            height: 60px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove from cart
    document.querySelectorAll('.remove-cart-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            if (confirm('Are you sure you want to remove this item?')) {
                window.location.href = '/remove-from-cart/' + productId;
            }
        });
    });

    // Quantity control
    document.querySelectorAll('.btn-increment').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        });
    });

    document.querySelectorAll('.btn-decrement').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });
});
</script>

@endsection
