@extends('reseller.layout')

@section('styles')
<style>
    .address {
        margin-top: .25rem;
        margin-bottom: .25rem;
        white-space: break-spaces;
    }
    @media print {
        tr.head-row {
            background-color: red !important;
            -webkit-print-color-adjust: exact; 
        }
    }
    .subtotal {
        border-top: 3px solid #555;
        border-bottom: 3px solid #555;
    }
    .payable {
        border-top: 3px solid #ccc;
    }
</style>

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 my-5">
        <div id="ui-view">
            <div>
                <div class="card rounded-0 shadow-sm">
                    <div class="card-header d-flex align-items-center">Invoice&nbsp;<strong>#{{ $order->id }}</strong>
                        <a class="btn btn-sm btn-secondary ml-auto mr-1 d-print-none" href=""
                            onclick="javascript:window.print();">Print</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-7">
                                <div class="shop-logo mt-3">
                                    @if($logo = $order->shop->logo)
                                    <img src="{{ asset($logo) }}" alt="" class="img-responsive">
                                    @else
                                    <h1 class="ml-2 my-5">{{ $order->shop->name }}</h1>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <h6 class="mb-3">Details:</h6>
                                <div>Invoice&nbsp;<strong>#{{ $order->id }}</strong></div>
                                <div>{{ date('F d, Y', strtotime($order->created_at)) }}</div>
                                <div>Delivery Method: <strong>{{ $order->data['delivery_method'] }}</strong></div>
                                <div>Payment Status: <strong>{{ $order->data['payable'] ? 'Incomplete' : 'Complete' }}</strong></div>
                            </div>

                        </div>

                        <h2 class="mb-4"><strong>INVOICE</strong></h2>

                        <div class="row mb-4">
                            <div class="col-sm-7">sj</div>
                            <div class="col-sm-5">jsj</div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="head-row">
                                        <th class="center">#</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th class="center">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->data['products'] as $product)
                                    <tr>
                                        <td class="center">{{ $loop->index + 1 }}</td>
                                        <td class="left">{{ $product['slug'] }}</td>
                                        <td class="center">{{ $product['code'] }}</td>
                                        <td class="right">{{ $product['quantity'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-sm-5"></div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-striped table-sm">
                                    <tbody>
                                        <tr class="subtotal">
                                            <td class="left"><strong>Subtotal</strong></td>
                                            <td class="right"><strong>{{ $order->data['sell'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Shipping</strong></td>
                                            <td class="right">{{ $order->data['shipping'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>{{ $order->data['sell'] + $order->data['shipping'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Advanced</strong></td>
                                            <td class="right">{{ $order->data['advanced'] }}</td>
                                        </tr>
                                        <tr class="payable">
                                            <td class="left"><strong>Payable</strong></td>
                                            <td class="right"><strong>{{ $order->data['payable'] }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection