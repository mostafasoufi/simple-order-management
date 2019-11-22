<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helper;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

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
