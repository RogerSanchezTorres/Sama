<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getValue($key, $default = null)
    {
        return optional(
            static::where('key', $key)->first()
        )->value ?? $default;
    }

    public static function shopEnabled(): bool
    {
        return (bool) static::getValue('shop_enabled', false);
    }

    public static function bannerEnabled(): bool
    {
        return (bool) static::getValue('banner_enabled', false);
    }

    public static function bannerTitle()
    {
        return static::getValue('banner_title', '');
    }

    public static function bannerText(): string
    {
        return static::getValue('banner_text', '');
    }

    public static function bannerColor(): string
    {
        return static::getValue('banner_color', 'warning');
    }

    public static function bannerStart()
    {
        return static::getValue('banner_start');
    }

    public static function bannerEnd()
    {
        return static::getValue('banner_end');
    }
}
