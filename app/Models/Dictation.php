<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string|null $voice
 * @property int $lesson_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 * @mixin Eloquent
 */
class Dictation extends Model
{
    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * @return HasMany
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(DictationSubmission::class);
    }

    /**
     * @param string $value
     * @return string
     */
    public function getCreatedAtAttribute(string $value): string
    {
        /** @phpstan-ignore-next-line */
        return verta($value)->format('Y-m-d H:i');
    }

    /**
     * @param string|null $value
     * @return string|null
     */
    public function getVoiceAttribute(?string $value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (str_contains($value, 'http')) {
            return $value;
        }

        return Storage::url($value);
    }
}
