<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waitress extends Model
{
    protected $fillable = ['name'];
    public function outgoingProducts()
    {
        return $this->hasMany(OutgoingProduct::class);
    }
}
