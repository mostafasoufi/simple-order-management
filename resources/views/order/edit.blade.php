@extends('layout')

@section('title', 'Update Order')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Order</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-outline-dark" href="{{ route('orders.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <hr />

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

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <div class="col-7">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">User</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="user_id" required>
                            <option value="">Select User...</option>
                            @foreach ($users as $user)
                                <option value="{{ $user['id'] }}" {{ ( $user['id'] == $order->user_id) ? 'selected' : '' }}>
                                    {{ $user['first_name'] }} {{ $user['last_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="product_id" required>
                            <option value="">Select Product...</option>
                            @foreach ($products as $product)
                                <option value="{{ $product['id'] }}" {{ ( $product['id'] == $order->product_id) ? 'selected' : '' }}>
                                    {{ $product['name'] }} ({{ $product['price'] }} EUR)
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" name="quantity" value="{{ $order->quantity }}" class="form-control" placeholder="Quantity">
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection
