<div class="modal fade" tabindex="-1" role="dialog" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>User:</strong>
                                <select class="form-control" name="user_id" required>
                                    <option value="">Select User...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}">
                                            {{ $user['first_name'] }} {{ $user['last_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Product:</strong>
                                <select class="form-control" name="product_id" required>
                                    <option value="">Select Product...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product['id'] }}">
                                            {{ $product['name'] }} ({{ $product['price'] }} EUR)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Quantity:</strong>
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
