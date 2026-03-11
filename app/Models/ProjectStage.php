<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectStageFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'order_index',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
