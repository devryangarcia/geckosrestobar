<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bartender extends Model
{
    protected $fillable = ['name'];

    // a Bartender has many outgoing products
    public function outgoing()
    {
        return $this->hasMany(OutgoingProduct::class);
    }
}
