<?php

namespace App\Http\Helper;

use App\Product;
use App\ProductDiscount;

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
 * Calculate product discount.
 * @param $product_id
 * @param $order_quantity
 * @return string
 */
function CalculateDiscount($product_id, $order_quantity)
{
    $product = Product::find($product_id);
    $discount = ProductDiscount::find($product_id);

    // Get total price.
    $price['discount'] = 0;
    $price['normal'] = $product->price * $order_quantity;

    // If the product has discount record.
    if ($discount and $order_quantity >= $discount->quantity) {
        $price['discount'] = Percent($price['normal'], $discount->percent);
    }

    return $price;
}

/**
 * Show discount in template.
 * @param $product_id
 * @param $order_quantity
 * @return string
 */
function ShowDiscountElement($product_id, $order_quantity)
{
    // Get discount.
    $result = CalculateDiscount($product_id, $order_quantity);
    $normal_price = number_format($result['normal'], 2);
    $discount_price = number_format($result['discount'], 2);

    if ($result['discount']) {
        echo sprintf('<span class="order-price has-discount badge badge-secondary">%s EUR</span><span class="order-price badge badge-success">%s EUR</span>', $normal_price, $discount_price);
    } else {
        echo sprintf('<span class="order-price badge badge-success">%s EUR</span>', $normal_price);
    }
}
