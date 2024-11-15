<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


/**
 *
 *
 * @property int $id
 * @property int $dictation_id
 * @property int $student_id
 * @property float|null $score
 * @property string|null $image
 * @property string|null $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Dictation $dictation
 * @property-read Student $student
 * @mixin Eloquent
 */
class DictationSubmission extends Model
{
    use HasFactory;
    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * @return BelongsTo
     */
    public function dictation(): BelongsTo
    {
        return $this->belongsTo(Dictation::class, 'dictation_id');
    }

    /**
     * @param string|null $value
     * @return string|null
     */
    public function getImageAttribute(?string $value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (str_contains($value, 'http')) {
            return $value;
        }

        return Storage::url($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function getCreatedAtAttribute(string $value): string
    {
        /** @phpstan-ignore-next-line */
        return verta($value)->format('Y/m/d H:i');
    }
}
