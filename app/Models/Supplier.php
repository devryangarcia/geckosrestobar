<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'email', 'contact'];

    // a supplier provides many incoming products
    public function incoming()
    {
        return $this->hasMany(IncomingProduct::class);
    }
}
