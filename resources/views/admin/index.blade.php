@extends('layouts.app')

@section('content')

<div class="card" style="width: 55.5em;margin:0 auto;">
    <div class="card-body">
        <table class="table table-striped table-hover table-white table-responsive-lg ">
            <tr>
                <th>Customer name</th>
                <th>Delivery type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <td>
                    {{ $order->user->name }}
                </td>
                <td>
                    @if($order->delivery_type == 'delivery')DELIVERY @endif
                    @if($order->delivery_type == 'meet_at_half') MEET AT HALF @endif
                    @if($order->delivery_type == 'pick-up') PICK UP @endif
                </td>
                <td>
                    <select id="status_{{ $order->id }}" class="form-control">
                        <option value="NEW" {{ $order->status == "NEW" ? "selected" : "" }}> New
                        </option>
                        <option value="PROCESSING" {{ $order->status == "PROCESSING" ? "selected" : "" }}>
                            Processing
                        </option>
                        <option value="CANCELED" {{ $order->status == "CANCELED" ? "selected" : "" }}>
                            Canceled
                        </option>
                        <option value="DELIVERED" {{ $order->status == "DELIVERED" ? "selected" : "" }}>
                            Delivered
                        </option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-info" onclick="updateStatus({{ $order->id }});">Update
                        status</button>
                    <a class="btn btn-success" href="{{ route('orders.show', $order->id) }}">Details</a>
                </td>
            </tr>
            @endforeach

        </table>
    </div>
</div>

@endsection