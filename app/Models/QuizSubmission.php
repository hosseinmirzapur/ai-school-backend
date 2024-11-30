<?php

namespace App\Models;

use Database\Factories\QuizSubmissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Quiz $quiz
 * @property-read \App\Models\Student $student
 * @method static \Database\Factories\QuizSubmissionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereGradedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizSubmission whereUpdatedAt($value)
 * @mixin \Eloquent
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
