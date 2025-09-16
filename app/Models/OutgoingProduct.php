<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingProduct extends Model
{
    protected $fillable = ['product_id', 'customer_id', 'qty', 'date'];

    // belongs to product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // belongs to bartender
    public function bartender()
    {
        return $this->belongsTo(Bartender::class);
    }
}
