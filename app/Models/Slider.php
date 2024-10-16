<?php

namespace App\Models;

use Database\Factories\SliderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 *
 *
 * @property int $id
 * @property string $image
 * @property int $order
 * @property int $lesson_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 * @method static SliderFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class Slider extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * @param string|null $value
     * @return string
     */
    public function getCreatedAtAttribute(string|null $value): string
    {
        /* @phpstan-ignore-next-line */
        return verta($value)->format('Y/m/d');
    }
}
