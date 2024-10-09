<?php

namespace App\Models;

use Database\Factories\FlashcardFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string|null $image
 * @property int $lesson_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 * @method static FlashcardFactory factory($count = null, $state = [])
 * @method static Builder|Flashcard newModelQuery()
 * @method static Builder|Flashcard newQuery()
 * @method static Builder|Flashcard query()
 * @method static Builder|Flashcard whereAnswer($value)
 * @method static Builder|Flashcard whereCreatedAt($value)
 * @method static Builder|Flashcard whereId($value)
 * @method static Builder|Flashcard whereImage($value)
 * @method static Builder|Flashcard whereLessonId($value)
 * @method static Builder|Flashcard whereQuestion($value)
 * @method static Builder|Flashcard whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Flashcard extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
