<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestmentsAdmin extends Model
{
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
    ];
}
