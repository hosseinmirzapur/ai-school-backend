<?php

namespace App\Models;

use Database\Factories\QuizFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lesson $lesson
 * @property-read \App\Models\Subject $subject
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizSubmission> $submissions
 * @property-read int|null $submissions_count
 * @property-read \App\Models\Teacher $teacher
 * @method static \Database\Factories\QuizFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereTotalMarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereUpdatedAt($value)
 * @mixin \Eloquent
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
    public function submissions(): HasMany
    {
        return $this->hasMany(QuizSubmission::class);
    }
}
