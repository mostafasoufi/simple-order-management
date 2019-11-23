<?php

namespace App\Http\Helper;

use App\Order;

/**
 * Calculate discount.
 * @param $total
 * @param $discount
 * @return float|int
 */
function Percent($total, $discount)
{
    return $total - ($total * ($discount / 100));
}

/**
 * Show discount in template.
 * @param $order_id
 * @return string
 */
function PricePriceElement($order_id)
{
    // Get order price.
    $order = Order::getOrderPrice($order_id);

    $normal_price = number_format($order['normal'], 2);
    $discount_price = number_format($order['discount'], 2);

    if ($order['discount']) {
        echo sprintf('<span class="order-price has-discount badge badge-secondary">%s EUR</span><span class="order-price badge badge-success">%s EUR</span>', $normal_price, $discount_price);
    } else {
        echo sprintf('<span class="order-price badge badge-success">%s EUR</span>', $normal_price);
    }
}
