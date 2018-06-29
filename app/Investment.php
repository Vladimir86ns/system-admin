<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\User;

class Investment extends Model
{
    const SERBIA = 'Serbia';
    
    protected $fillable = [
        'users_id',
        'total_investment',
        'percent_of_income',
        'investment_collected_total',
        'monthly_collected',
        'investment_collected',
        'project_id',        
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the projects for the investments.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the user that owns the investment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
