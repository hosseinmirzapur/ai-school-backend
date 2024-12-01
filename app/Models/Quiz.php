<?php

namespace App\Models;

use Database\Factories\QuizFactory;
use Eloquent;
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
 * @property string $title
 * @property string|null $description
 * @property int $subject_id
 * @property int $lesson_id
 * @property int $teacher_id
 * @property int $total_marks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 * @property-read Subject $subject
 * @property-read Collection<int, QuizSubmission> $submissions
 * @property-read int|null $submissions_count
 * @property-read Teacher $teacher
 * @method static QuizFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class Quiz extends Model
{
    /** @use HasFactory<QuizFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'lesson_id',
        'teacher_id',
        'total_marks',
    ];

    /**
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    /**
     * @return HasMany
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(QuizSubmission::class);
    }
}
