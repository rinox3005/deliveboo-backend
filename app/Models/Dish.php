<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'vegan',
        'gluten_free',
        'spicy',
        'lactose_free',
        'restaurant_id',
        'slug',
        'visible',
    ];

    // Imposta i valori di default per i campi booleani
    protected $attributes = [
        'vegan' => 0,
        'gluten_free' => 0,
        'spicy' => 0,
        'lactose_free' => 0,
        'visible' => 0,
    ];

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
