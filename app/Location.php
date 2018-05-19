<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Location extends Model
{
    protected $fillable = [
        'lat',
        'long',
        'country',
        'address',
        'zip_code',
        'project_id',    
    ];

    /**
     * Get the project record associated with the location.
     */
    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
