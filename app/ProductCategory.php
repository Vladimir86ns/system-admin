<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'project_id',
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * The projects that belong to the product category.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
