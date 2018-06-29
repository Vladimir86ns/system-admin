<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Investment;
use App\Order;
use App\InvestmentsAdmin;

class Project extends Model
{
    protected $fillable = [
        'name',
        'total_amount',
        'income',
        'expense',
        'profit',
        'profit_sharing',
        'investment_collected',
        'phone_number',
        'investment_id',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the investments record associated with the project.
     */
    public function investments()
    {
        return $this->hasOne(Investment::class);
    }

    /**
     * Get the orders for the project.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the admin investments.
     */
    public function adminInvestment()
    {
        return $this->belongsTo(InvestmentsAdmin::class);
    }
}
