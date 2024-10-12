<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $subject_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Flashcard> $flashcards
 * @property-read int|null $flashcards_count
 * @property-read Collection<int, Slider> $sliders
 * @property-read int|null $sliders_count
 * @property-read Subject $subject
 * @property-read Collection<int, Video> $videos
 * @property-read int|null $videos_count
 * @mixin Eloquent
 */
class Lesson extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return HasMany
     */
    public function flashcards(): HasMany
    {
        return $this->hasMany(Flashcard::class);
    }

    /**
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * @return HasMany
     */
    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class);
    }
}
