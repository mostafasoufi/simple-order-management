<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

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
