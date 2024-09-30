<?php

namespace App\Models;

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
 * @property string $role
 * @property string $content
 * @property int $has_file
 * @property int $has_voice
 * @property int $chat_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Chat $chat
 * @property-read Student|null $student
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @method static Builder|Message whereChatId($value)
 * @method static Builder|Message whereContent($value)
 * @method static Builder|Message whereCreatedAt($value)
 * @method static Builder|Message whereHasFile($value)
 * @method static Builder|Message whereHasVoice($value)
 * @method static Builder|Message whereId($value)
 * @method static Builder|Message whereRole($value)
 * @method static Builder|Message whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Message extends Model
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
     * @return BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
