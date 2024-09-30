<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static Builder|Chat newModelQuery()
 * @method static Builder|Chat newQuery()
 * @method static Builder|Chat query()
 * @method static Builder|Chat whereCreatedAt($value)
 * @method static Builder|Chat whereId($value)
 * @method static Builder|Chat whereIdentifier($value)
 * @method static Builder|Chat whereStudentId($value)
 * @method static Builder|Chat whereTitle($value)
 * @method static Builder|Chat whereUpdatedAt($value)
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
}
