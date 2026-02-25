<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'locale', 'value'];

    public static function get(string $key, ?string $locale = null, $default = null)
    {
        $query = self::where('key', $key);

        if ($locale) {
            $query->where('locale', $locale);
        }
        else {
            $query->whereNull('locale');
        }

        $setting = $query->first();

        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value, ?string $locale = null)
    {
        return self::updateOrCreate(
        ['key' => $key, 'locale' => $locale],
        ['value' => $value]
        );
    }
}
