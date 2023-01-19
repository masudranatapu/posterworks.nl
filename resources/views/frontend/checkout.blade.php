@extends('frontend.layouts.app')

@section('title')
    Checkout
@endsection

@section('meta')
@endsection

@push('style')
@endpush

@section('content')
    <!-- ============================ Checkout ================================= -->
    <div class="privacy_policy_sec section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="section_title mb-4">
                    <h5>Checkout</h5>
                </div>
                <div class="col-lg-7">
                    <div class="checkout_form mb-5 mb-lg-0">
                        <form action="#" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Country Or Regian Name</label>
                                <select class="selectpicker countrypicker form-control select2"></select>
                            </div>
                            <div class="mb-3">
                                <label for="street_address" class="form-label">Address line 1</label>
                                <input type="text" name="street_address" id="street_address" class="form-control"
                                    placeholder="Street address" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address line 2</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Apt.,suite, unit number, etc (optional)">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="City"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="post_code" class="form-label">Post Code</label>
                                <input type="number" name="post_code" id="post_code" class="form-control"
                                    placeholder="Post code" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" id="mobile_code" name="phone" class="form-control"
                                    placeholder="Phone Number">
                            </div>
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cart_wrap">
                        <div class="cart_product mb-4">
                            <div class="d-flex align-items-center">
                                <img src="assets/images/icons/gift-2.svg" class="flex-shrink-0 me-3" alt="gift box">
                                <div class="cart_info">
                                    <h5>Promo: 12 titles for US $99</h5>
                                    <span>Add 8 titles to get the deal!</span>
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <tr>
                                <td>2 titles for US $58</td>
                                <td>US $58</td>
                            </tr>
                            <tr>
                                <td>1 more tile</td>
                                <td>US $12</td>
                            </tr>
                            <tr>
                                <td>Delivery by <strong>Monday, </strong> February 6th</td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>US $75</strong></td>
                            </tr>
                        </table>
                        <div class="payment_group_btn">
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-primary rounded w-100">Pay with
                                        <strong>Paypal</strong></a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-primary rounded w-100">Pay with
                                        <strong>Card</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
