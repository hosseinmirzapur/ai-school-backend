<?php

namespace App\Models;

use Database\Factories\SliderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
 * @method static Builder|Slider newModelQuery()
 * @method static Builder|Slider newQuery()
 * @method static Builder|Slider query()
 * @method static Builder|Slider whereCreatedAt($value)
 * @method static Builder|Slider whereId($value)
 * @method static Builder|Slider whereImage($value)
 * @method static Builder|Slider whereLessonId($value)
 * @method static Builder|Slider whereOrder($value)
 * @method static Builder|Slider whereUpdatedAt($value)
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
}
