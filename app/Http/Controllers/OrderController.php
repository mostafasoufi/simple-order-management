<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->get('s');
        $date = $request->get('date');

        $data['orders'] = Order::sortable()
            ->where(function ($q) use ($search) {
                if ($search) {
                    $q->orWhereHas('user', function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%');
                    })->orWhereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                }
            })->where(function ($q) use ($date) {
                if ($date == 'week') {
                    $q->whereBetween('orders.created_at', [Carbon::now()->subDays(7), Carbon::now()]);
                } elseif ($date == 'today') {
                    $q->whereDate('orders.created_at', Carbon::now());
                }
            })->paginate(15);

        $data['users'] = User::select(['id', 'first_name', 'last_name'])->get();
        $data['products'] = Product::select(['id', 'name', 'price'])->get();

        return view('order.index', $data)->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        $data['order'] = $order;
        $data['users'] = User::select(['id', 'first_name', 'last_name'])->get();
        $data['products'] = Product::select(['id', 'name', 'price'])->get();

        return view('order.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     * @throws Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
