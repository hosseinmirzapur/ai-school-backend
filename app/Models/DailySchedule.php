<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $classroom_id
 * @property string $start_time
 * @property string $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Classroom $classroom
 * @property-read Collection<int, Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static Builder|DailySchedule newModelQuery()
 * @method static Builder|DailySchedule newQuery()
 * @method static Builder|DailySchedule query()
 * @method static Builder|DailySchedule whereClassroomId($value)
 * @method static Builder|DailySchedule whereCreatedAt($value)
 * @method static Builder|DailySchedule whereEndTime($value)
 * @method static Builder|DailySchedule whereId($value)
 * @method static Builder|DailySchedule whereStartTime($value)
 * @method static Builder|DailySchedule whereUpdatedAt($value)
 * @mixin Eloquent
 */
class DailySchedule extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

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
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

}
