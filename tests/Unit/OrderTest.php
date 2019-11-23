<?php

namespace Tests\Unit;

use App\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Order price test.
     *
     * @return void
     */
    public function testOrderPrice()
    {
        $orders = Order::where('product_id', '!=', '1')->first();

        if ($orders) {
            $price = Order::getOrderPrice($orders->id);
            $this->assertEquals($price['normal'], $price['total']);
        }
    }

    /**
     * Order price with discount test.
     *
     * @return void
     */
    public function testOrderPriceWithDiscount()
    {
        $orders = Order::where('product_id', '1')->where('quantity', '>=', '3')->first();

        if ($orders) {
            $price = Order::getOrderPrice($orders->id);
            $this->assertLessThan($price['normal'], $price['total']);
        }
    }
}
