<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'target_amount',
        'current_amount',
        'image',
        'status',
        'url',
        'total_shares',
    ];

    public function stages()
    {
        return $this->hasMany(ProjectStage::class)->orderBy('order_index');
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function revenues()
    {
        return $this->hasMany(ProjectRevenue::class);
    }
}
