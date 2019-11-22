@extends('layout')

@section('title', 'Orders')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h2>Orders</h2>
            </div>

            <div class="float-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addOrderModal">New Order</button>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>User</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->product_id }}</td>
                <td>{{ $order->quantity }}</td>
                <td></td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <form action="{{ route('orders.destroy',$order->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('orders.edit',$order->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $orders->links() !!}

    @include('modals.create')
@endsection
