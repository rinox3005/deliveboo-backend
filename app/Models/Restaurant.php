<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'city',
        'phone_number',
        'piva',
    ];
    /**
     * Relazione One-to-Many con Order.
     * Un ristorante può avere molti ordini.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relazione One-to-Many con Dish.
     * Un ristorante può avere molti piatti.
     */
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    /**
     * Relazione Many-to-Many con Type.
     * Un ristorante può appartenere a molti tipi.
     */
    public function types()
    {
        return $this->belongsToMany(Type::class, 'restaurant_type');
    }

    /**
     * Relazione One-to-One con User.
     * Un ristorante appartiene a un utente.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
