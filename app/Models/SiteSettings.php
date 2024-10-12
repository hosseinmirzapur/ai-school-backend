<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 *
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @mixin Eloquent
 */
class SiteSettings extends Model
{
    /**
     * @return string|null
     */
    public static function aboutUs(): string | null
    {
        return self::where('key', 'about_us')->first()?->value;
    }

    /**
     * @return string|null
     */
    public static function contactUs(): string | null
    {
        return self::where('key', 'contact_us')->first()?->value;
    }
}
