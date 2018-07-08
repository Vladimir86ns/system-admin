<?php

namespace App;

use App\User;
use App\Order;
use App\Investment;
use App\ProjectPosition;
use App\InvestmentsAdmin;
use Illuminate\Database\Eloquent\Model;

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
        'owner_id',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the owner of projects.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
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

    /**
     * Get all project positions.
     */
    public function positions()
    {
        return $this->hasMany(ProjectPosition::class);
    }
}
