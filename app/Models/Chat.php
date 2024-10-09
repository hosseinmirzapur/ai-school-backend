<?php

namespace App\Models;

use Database\Factories\ChatFactory;
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
 * @property string $identifier
 * @property string|null $title
 * @property int $student_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read Student $student
 * @property-read Subject|null $subject
 * @method static ChatFactory factory($count = null, $state = [])
 * @property string $type
 * @property int $score
 * @property int $active
 * @property int|null $subject_id
 * @mixin Eloquent
 */
class Chat extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
