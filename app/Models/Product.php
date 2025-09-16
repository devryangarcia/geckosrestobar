<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'qty', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function incoming()
    {
        return $this->hasMany(IncomingProduct::class);
    }

    public function outgoing()
    {
        return $this->hasMany(OutgoingProduct::class);
    }
}
