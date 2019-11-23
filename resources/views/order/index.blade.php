@extends('layout')

@section('title', 'Orders')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h2>Orders</h2>
            </div>

            <div class="float-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addOrderModal"><i class="fa fa-plus"></i> New Order</button>
            </div>
        </div>
    </div>

    <hr/>

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

    <div class="float-right">
        <form class="form-inline">
            <select name="date" class="form-control mb-2 mr-sm-2">
                <option value="">All Time</option>
                <option value="week" {{ ( app('request')->input('date') == 'week') ? 'selected' : '' }}>Last 7 days</option>
                <option value="today" {{ ( app('request')->input('date') == 'today') ? 'selected' : '' }}>Today</option>
            </select>

            <div class="input-group mb-2 mr-sm-2">
                <input type="text" name="s" class="form-control" placeholder="Enter search term..." value="{{ app('request')->input('s') }}">
            </div>

            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Search</button>
        </form>
    </div>

    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>@sortablelink('user.first_name', 'User')</th>
            <th>@sortablelink('product.name', 'Product')</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>@sortablelink('created_at', 'Date')</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->getUserFullName() }}</td>
                <td>{{ $order->getProductName()->name }}</td>
                <td>{{ $order->getProductName()->price }} EUR</td>
                <td>{{ $order->quantity }}</td>
                <td>
                    {{ App\Http\Helper\PricePriceElement($order->id) }}
                </td>
                <td>{{ $order->created_at->format('d M Y, h:m A') }}</td>
                <td class="text-right">
                    <form action="{{ route('orders.destroy',$order->id) }}" method="POST">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-primary btn-sm" href="{{ route('orders.edit',$order->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $orders->appends(\Request::except('page'))->render() !!}

    @include('modals.create')
@endsection
