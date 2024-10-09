<?php

namespace App\Models;
use Database\Factories\StudentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $mobile
 * @property string|null $email
 * @property string $username
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
 * @property-read Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read School $school
 * @property-read Collection<int, PersonalAccessToken> $tokens
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
 * @method static Builder|Student whereUsername($value)
 * @mixin Eloquent
 */
class Student extends Authenticatable
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

    public function newQuiz()
    {
        return $this->chats()->create([
            'type' => 'quiz',
        ]);
    }

    public function newCasual()
    {
        return $this->chats()->create([
            'type' => 'casual',
        ]);
    }
}
