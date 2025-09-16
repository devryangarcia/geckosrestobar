<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingProduct extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'qty', 'tanggal'];

    // belongs to product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // belongs to supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
