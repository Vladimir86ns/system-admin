<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'employee_id',
        'list_of_orders_ids',
        'to_deliver',
        'time_to_finish',
        'city',
        'address',
        'flat_number',
        'delivery_boy_id',
        'time_delivered',
    ];

    protected $casts = [
        'to_deliver' => 'boolean',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
