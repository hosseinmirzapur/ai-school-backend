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
 * @property string $dow
 * @property string $start_time
 * @property string $end_time
 * @property int $classroom_id
 * @property int $subject_id
 * @property int $teacher_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Classroom $classroom
 * @property-read Subject $subject
 * @property-read Teacher $teacher
 * @property-read int $duration
 * @mixin Eloquent
 */
class DailySchedule extends Model
{
    use HasFactory;

    public $appends = ['duration'];

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

    public function getDurationAttribute(): int
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);
        $durationInMinutes = $endTime->diffInMinutes($startTime, absolute: true);

        return (int)$durationInMinutes;
    }

}
