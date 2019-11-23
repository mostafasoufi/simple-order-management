<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use function App\Http\Helper\Percent;

class Order extends Model
{
    use Sortable;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

    public $sortable = [
        'user_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the order price.
     * @param $id
     * @return mixed
     */
    public static function getOrderPrice($id)
    {
        $order = Order::where('id', $id)->first();
        $product = Product::find($order->product_id);
        $discount = ProductDiscount::find($order->product_id);

        // Get total price.
        $price['normal'] = $product->price * $order->quantity;
        $price['discount'] = 0;
        $price['total'] = $price['normal'];

        // If the product has discount record.
        if ($discount and $order->quantity >= $discount->quantity) {
            $price['total'] = Percent($price['total'], $discount->percent);
            $price['discount'] = $price['total'];
        }

        return $price;
    }

    /**
     * Get the user for relation sorting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product for relation sorting.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get user full name.
     * @return mixed
     */
    public function getUserFullName()
    {
        return User::getFullName($this->user_id);
    }

    /**
     * Get product detail.
     * @return mixed
     */
    public function getProductName()
    {
        return Product::find($this->product_id);
    }
}
