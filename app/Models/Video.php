<?php

namespace App\Models;

use Database\Factories\VideoFactory;
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
 * @property string $title
 * @property string|null $description
 * @property string|null $thumbnail
 * @property string|null $file
 * @property int $lesson_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 * @method static VideoFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class Video extends Model
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
     * @return string|null
     */
    public function getFileAttribute(?string $value): ?string
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
