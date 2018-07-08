<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectPosition extends Model
{
    protected $fillable = [
        'name',
        'project_id',
    ];

    /**
     * Get the user that owns the ordesr.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
