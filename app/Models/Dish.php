<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    /**
     * Relazione Many-to-One con Restaurant.
     * Un piatto appartiene a un ristorante.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Relazione Many-to-Many con Order.
     * Un piatto può essere presente in molti ordini.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'dish_order')->withPivot('quantity');
    }
}
