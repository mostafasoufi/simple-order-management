@extends('layout')

@section('title', 'Orders')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 5.7 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('orders.create') }}"> Add New Order</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
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
                        <a class="btn btn-info" href="{{ route('orders.show',$order->id) }}">Show</a>
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

@endsection
