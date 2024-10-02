<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property string $mobile
 * @property string $email
 * @property string $password
 * @property string|null $gender
 * @property string|null $dob
 * @property int $school_id
 * @property int $classroom_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Chat> $chats
 * @property-read int|null $chats_count
 * @property-read Classroom $classroom
 * @property-read Collection<int, Client> $clients
 * @property-read int|null $clients_count
 * @property-read Collection<int, DailySchedule> $dailySchedules
 * @property-read int|null $daily_schedules_count
 * @property-read Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read School $school
 * @property-read Collection<int, Token> $tokens
 * @property-read int|null $tokens_count
 * @method static StudentFactory factory($count = null, $state = [])
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static Builder|Student query()
 * @method static Builder|Student whereClassroomId($value)
 * @method static Builder|Student whereCreatedAt($value)
 * @method static Builder|Student whereDob($value)
 * @method static Builder|Student whereEmail($value)
 * @method static Builder|Student whereGender($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereMobile($value)
 * @method static Builder|Student whereName($value)
 * @method static Builder|Student wherePassword($value)
 * @method static Builder|Student whereSchoolId($value)
 * @method static Builder|Student whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Student extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return BelongsTo
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * @return HasMany
     */
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
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
        return $this->chats()
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
        return $this->chats()
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
