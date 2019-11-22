<?php

use Illuminate\Database\Seeder;

class ProductDiscountTableSeeder extends Seeder
{
    private $now;

    /**
     * ProductsTableSeeder constructor.
     */
    public function __construct()
    {
        $this->now = now();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the specific product.
        $product = DB::table('products')->where('name', 'Coca Cola')->first();
        
        DB::table('product_discount')->insertOrIgnore([
            'product_id' => $product->id,
            'quantity' => '3',
            'percent' => '20',
            'created_at' => $this->now,
            'updated_at' => $this->now,
        ]);
    }
}
