<?php

namespace App\Models;

use Database\Factories\ClassroomFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, DailySchedule> $dailySchedules
 * @property-read int|null $daily_schedules_count
 * @property-read Collection<int, Student> $students
 * @property-read int|null $students_count
 * @method static ClassroomFactory factory($count = null, $state = [])
 * @property int $grade
 * @mixin Eloquent
 */
class Classroom extends Model
{
    use HasFactory;



    /**
     * @return HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return HasMany
     */
    public function dailySchedules(): HasMany
    {
        return $this->hasMany(DailySchedule::class);
    }

    /**
     * @param array<int, int> $years
     * @return Collection
     */
    public function marksForChart(array $years): Collection
    {
        return Chat::query()
            ->whereIn('student_id', $this->students->pluck('id'))
            ->where('active', false)
            ->where('type', 'quiz')
            ->select([
                'MONTH(created_at) as month',
                'AVG(scores) as avg_mark',
                'COUNT(*) as total_chats',
            ])
            ->whereBetween('created_at', $years)
            ->groupBy('student_id', 'month')
            ->orderBy('student_id')
            ->orderBy('month')
            ->get();
    }

    /**
     * @return Collection
     */
    public function marksPerSubject(): Collection
    {
        return Chat::query()
            ->whereIn('student_id', $this->students->pluck('id'))
            ->whereNotNull('subject_id')
            ->where('active', false)
            ->where('type', 'quiz')
            ->select([
                'AVG(scores) as avg_mark',
                'COUNT(*) as total_chats',
            ])
            ->join('subjects', 'subjects.id', '=', 'chats.subject_id')
            ->groupBy('subject_id')
            ->get();
    }
}
