<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class InvestmentsAdmin extends Model
{
    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';
    const REJECTED = 'REJECTED';

    protected $fillable = [
        'name',
        'total_investition',
        'city',
        'country',
        'address',
        'status',
        'closed',
    ];

    protected $casts = [
        'closed' => 'boolean',
        'on_production' => 'boolean',
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
