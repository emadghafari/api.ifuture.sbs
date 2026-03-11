<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    /** @use HasFactory<\Database\Factories\InvestmentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'amount',
        'gateway',
        'transaction_id',
        'status',
        'shares',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
