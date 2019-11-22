<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
        DB::table('products')->insertOrIgnore([
            [
                'name' => 'Coca Cola',
                'price' => '1.80',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'name' => 'Pepsi Cola',
                'price' => '1.60',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'name' => 'Red Bull Cola',
                'price' => '1.99',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'name' => 'Zevia Cola',
                'price' => '1.18',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'name' => 'Jolt Cola',
                'price' => '1.90',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ]
        ]);
    }
}
