<?php

namespace App\Models;

use Database\Factories\QuizSubmissionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $student_id
 * @property array $answers
 * @property string|null $score
 * @property string|null $feedback
 * @property string|null $submitted_at
 * @property string|null $graded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Quiz $quiz
 * @property-read Student $student
 * @method static QuizSubmissionFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class QuizSubmission extends Model
{
    /** @use HasFactory<QuizSubmissionFactory> */
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'answers',
        'score',
        'feedback',
        'submitted_at',
        'graded_at',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
