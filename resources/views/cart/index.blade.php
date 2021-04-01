@extends('layouts.app')

@section('content')

<div id="myCart">
    <div class="card" style="width: 55.5em;margin:0 auto;">
        <div class="card-body">
            @if(isset($userOrder) && count($userOrder->orderParts))
            <table class="table table-striped table-hover table-white table-responsive-lg ">
                <tr>
                    <th>Delivery method</th>
                    <th>Hour</th>
                    <th></th>
                </tr>

                <tr>
                    <td>
                        <select class="form-control" name="delivery_type" id="delivery_type">
                            <option value="delivery">Delivery</option>
                            <option value="meet_at_half">Meet at half</option>
                            <option value="pick-up">Pick up</option>
                        </select>
                        <input type="hidden" value="{{ $totalPrice }}" id="total" />
                        <input type="hidden" id="status" value="NEW" />
                    </td>

                    <td>
                        <select class="form-control" name="hour" id="hour">
                            <option value=""></option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="placeOrder();"> Place Order</button>
                    </td>
                </tr>
            </table>
            <table class="table table-striped table-hover table-white table-responsive-lg ">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Product price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="listing_items">
                    @foreach($userOrder->orderParts as $part)
                    <tr>
                        <td>{{ $part->product_name }}</td>
                        <td>{{ $part->product_price }}</td>
                        <td>{{ $part->quantity }}</td>
                        <td>{{ $part->price }}</td>
                        <td>
                            <form action="/delete-part" method="post" class="mr-2">
                                @csrf
                                <input type="hidden" name="part_id" class="form-control" value="{{$part->id}}">
                                <button type="submit" class="btn btn-danger">
                                    Remove from cart
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                <tbody>
            </table>
            <div class="col-md-12">Total price: {{$totalPrice }}</div>
            @else
            <div class="alert alert-danger" role="alert">
                Nu exista produse in cos!
            </div>
            @endif
        </div>
    </div>
</div>

@endsection