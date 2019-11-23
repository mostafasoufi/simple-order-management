<?php

namespace Tests\Unit;

use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * Test the product table has default value.
     *
     * @return void
     */
    public function testProductsTable()
    {
        $this->assertDatabaseHas('products', [
            'name' => 'Coca Cola',
            'price' => '1.80',
        ]);
    }

    /**
     * Test the product discount table has default value.
     *
     * @return void
     */
    public function testProductDiscountTable()
    {
        $this->assertDatabaseHas('product_discount', [
            'product_id' => '1',
            'quantity' => '3',
            'percent' => '20',
        ]);
    }
}
