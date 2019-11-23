<?php

namespace Tests\Unit;

use App\Order;
use Tests\TestCase;
use function App\Http\Helper\CalculateDiscount;

class OrderTest extends TestCase
{
    /**
     * Order price test.
     *
     * @return void
     */
    public function testOrderPrice()
    {
        $orders = Order::join('product_discount', 'orders.product_id', '!=', 'product_discount.product_id')->first();

        if ($orders) {
            $price = CalculateDiscount($orders->product_id, $orders->quantity);
            $this->assertIsFloat($price['normal']);
        }
    }

    /**
     * Order price with discount test.
     *
     * @return void
     */
    public function testOrderPriceWithDiscount()
    {
        $orders = Order::join('product_discount', 'orders.product_id', '=', 'product_discount.product_id')->first();

        if ($orders) {
            $price = CalculateDiscount($orders->product_id, $orders->quantity);
            $this->assertIsFloat($price['discount']);
        }
    }
}
