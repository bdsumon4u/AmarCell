<section class="checkout">
    <form method="POST" action="{{ route('order.store') }}" id="checkout-form">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="wizard">
                    <div id="" class="" role="tabpanel">
                        <div class="box-wrapper address clearfix">
                            <div class="box-header">
                                <h4>Checkout Information</h4>
                            </div>

                            <div class="personal-information clearfix">
                                <h5>Customer Info</h5>

                            <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('customer_name') ? 'has-error': '' }}">
                                        <label for="customer-name">
                                            Name<span>*</span>
                                        </label>

                                        <input type="text" name="customer_name" class="form-control" id="customer-name" value="{{ old('customer_name') }}">

                                        {!! $errors->first('customer_name', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('customer_email') ? 'has-error': '' }}">
                                        <label for="customer-email">
                                            Email
                                        </label>

                                        <input type="text" name="customer_email" class="form-control" id="customer-email" value="{{ old('customer_email') }}">

                                        {!! $errors->first('customer_email', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('customer_phone') ? 'has-error': '' }}">
                                        <label for="customer-phone">
                                            Phone<span>*</span>
                                        </label>

                                        <input type="text" name="customer_phone" class="form-control" id="customer-phone" value="{{ old('customer_phone') }}">

                                        {!! $errors->first('customer_phone', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('customer_address') ? 'has-error': '' }}">
                                        <label for="customer-address">
                                            Address<span>*</span>
                                        </label>

                                        <input type="text" name="customer_address" class="form-control" id="customer-address" value="{{ old('customer_address') }}">

                                        {!! $errors->first('customer_address', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="personal-information clearfix">
                                <br>
                                <h5>Order Info</h5>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('shop') ? 'has-error': '' }}">
                                        <label for="reseller-shop">
                                            Select Shop<span>*</span>
                                        </label>

                                        @if($shops->count() == 1)
                                        <input type="text" name="shop" id="reseller-shop" class="form-control" value="{{ old('shop', $shops->first()->name) }}" readonly>
                                        <input type="hidden" name="shop" value="{{ old('shop', $shops->first()->id) }}" readonly>
                                        @else
                                        <select name="shop" id="reseller-shop" class="form-control" @if($shops->count() == 1) readonly @endif>
                                            <option value="">Select Shop</option>
                                            @foreach($shops as $shop)
                                            <option value="{{ $shop->id }}" @if(old('shop') == $shop->id) selected @endif>{{ $shop->name }}</option>
                                            @endforeach
                                        </select>
                                        @endif

                                        {!! $errors->first('shop', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('delivery_method') ? 'has-error': '' }}">
                                        <label for="delivery-method">
                                            Delivery Method<span>*</span>
                                        </label>

                                        <input type="text" name="delivery_method" class="form-control" id="delivery-method" value="{{ old('delivery_method') }}">

                                        {!! $errors->first('delivery_method', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cart-list-sidebar order-review">
                    <div class="cart-total">
                        @include('reseller.cart.sidebar')
                        <button type="submit" class="btn btn-primary btn-checkout" data-loading>
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>