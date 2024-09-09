<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * Relazione Many-to-Many con Restaurant.
     * Un tipo può essere associato a molti ristoranti.
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_type');
    }
}
