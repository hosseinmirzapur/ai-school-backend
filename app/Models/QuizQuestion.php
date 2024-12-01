<?php

namespace App\Models;

use Database\Factories\QuizQuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizQuestion extends Model
{
    const TYPES = [
        'multiple-choice', 'true-false', 'text'
    ];
    /** @use HasFactory<QuizQuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'text',
        'type',
        'options',
        'quiz_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
