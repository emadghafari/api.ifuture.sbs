<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamMember extends Model
{
    protected $fillable = [
        'type', 'photo_path', 'facebook_url', 'twitter_url', 'linkedin_url', 'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(TeamTranslation::class);
    }

    public function getTranslation(string $locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
