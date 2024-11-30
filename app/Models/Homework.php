<?php

namespace App\Models;

use Database\Factories\HomeworkFactory;
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
 * @property string|null $due_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 * @property-read Subject $subject
 * @property-read Collection<int, HomeworkSubmission> $submissions
 * @property-read int|null $submissions_count
 * @property-read Teacher $teacher
 * @method static HomeworkFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class Homework extends Model
{
    const STATUS_NOT_SENT = 'not_sent';
    const STATUS_GRADING = 'grading';
    const STATUS_GRADED = 'graded';

    /** @use HasFactory<HomeworkFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'lesson_id',
        'teacher_id',
        'due_date',
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
        return $this->hasMany(HomeworkSubmission::class);
    }

    /**
     * @param string|null $value
     * @return string|null
     */
    public function getDueDateAttribute(?string $value): ?string
    {

        return is_null($value) ?
            $value :
            /** @phpstan-ignore-next-line  */
            verta($value)->format('Y/m/d H:i');
    }

    /**
     * 3 possible status types:
     * - not_sent
     * - grading
     * - graded
     *
     * @return string
     */
    public function decideStatus(): string
    {
        /** @var Student $student */
        $student = request()->user();

        /** @var HomeworkSubmission $submission */
        $submission = $this->submissions()
            ->where('student_id', $student->id)
            ->latest()
            ->first();

        $status = self::STATUS_NOT_SENT;

        if ($submission) {
            $status = self::STATUS_GRADING;
            if (!is_null($submission->grade)) {
                $status = self::STATUS_GRADED;
            }
        }

        return $status;
    }
}
