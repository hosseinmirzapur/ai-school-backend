<?php

namespace App\Models;

use Database\Factories\HomeworkSubmissionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $homework_id
 * @property int $student_id
 * @property string|null $submission_file
 * @property string|null $grade
 * @property string|null $feedback
 * @property string|null $submitted_at
 * @property string|null $graded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Homework $homework
 * @property-read Student $student
 * @method static HomeworkSubmissionFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class HomeworkSubmission extends Model
{
    /** @use HasFactory<HomeworkSubmissionFactory> */
    use HasFactory;

    protected $fillable = [
        'homework_id',
        'student_id',
        'submission_file',
        'grade',
        'feedback',
        'submitted_at',
        'graded_at',
    ];

    /**
     * @return BelongsTo
     */
    public function homework(): BelongsTo
    {
        return $this->belongsTo(Homework::class);
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function getSubmittedAtAttribute(?string $value): ?string
    {
        return is_null($value) ?
            $value :
            /** @phpstan-ignore-nextline */
            verta($value)->format('Y/m/d H:i');
    }

    public function getGradedAtAttribute(?string $value): ?string
    {
        return is_null($value) ?
            $value :
            /** @phpstan-ignore-nextline */
            verta($value)->format('Y/m/d H:i');
    }
}
