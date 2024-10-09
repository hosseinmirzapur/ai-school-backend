<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

    }

    public function test_home_page()
    {
        $response = $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/home');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'profile', 'notifications', 'monthlyMarks'
        ]);
    }

    public function test_sources_page()
    {
        $response = $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )->get('/api/pages/sources');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'sources' => [
                '*' => ['name', 'slug', 'image']
            ]
        ]);
    }

    public function test_lessons_page()
    {
        /** @var Subject $subject */
        $subject = Subject::all()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/$subject->slug")
            ->assertStatus(200)
            ->assertJsonStructure([
                'lessons' => [
                    '*' => ['name', 'slug']
                ]
            ]);

    }

    public function test_sliders_page()
    {
        /** @var Lesson $lesson */
        $lesson = Lesson::whereHas('sliders')->get()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/lessons/$lesson->slug/sliders")
            ->assertStatus(200)
            ->assertJsonStructure([
                'sliders' => [
                    '*' => ['image', 'order']
                ]
            ]);


    }

    public function test_videos_page()
    {
        /** @var lesson $lesson */
        $lesson = Lesson::whereHas('videos')->get()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/lessons/$lesson->slug/videos")
            ->assertStatus(200)
            ->assertJsonStructure([
                'videos' => [
                    '*' => ['title', 'description', 'thumbnail', 'file']
                ]
            ]);
    }

    public function test_flashcards_page()
    {
        /** @var Lesson $lesson */
        $lesson = Lesson::whereHas('flashcards')->get()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/lessons/$lesson->slug/flashcards")
            ->assertStatus(200)
            ->assertJsonStructure([
                'flashcards' => [
                    '*' => ['question', 'answer', 'image']
                ]
            ]);
    }

    public function test_weekly_schedule_page()
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/weekly-schedule')
            ->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'schedule' => [
                    '*' => [
                        'sat', 'sun', 'mon', 'tue', 'wed', 'thu'
                    ]
                ]
            ]);
    }

    public function test_notifications_page()
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/notifications')
            ->assertStatus(200)
            ->assertJsonStructure([
                'notifications' // only check if the key exists
            ]);
    }

    public function test_settings_page()
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/settings')
            ->assertStatus(200)
            ->assertJsonStructure([
                'settings' // only check if the key exists
            ]);
    }

    public function test_chat_page()
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/chat/history')
            ->assertStatus(200)
            ->assertJsonStructure([
                'chats' => [
                    '*' => [
                        'identifier', 'type', 'score', 'active'
                    ]
                ]
            ]);
    }

    public function test_chat_messages_are_loaded()
    {
        /** @var Chat $chat */
        $chat = Chat::all()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/chat/$chat->identifier")
            ->assertStatus(200)
            ->assertJsonStructure([
                'messages' => [
                    '*' => [
                        'role', 'content', 'has_file', 'has_voice', 'chat_id'
                    ]
                ]
            ]);
    }

    public function test_about_us_page()
    {
        $this->get('/api/pages/about-us')
            ->assertStatus(200)
            ->assertJsonStructure([
                'aboutUs'
            ]);
    }

    public function test_contact_us_page()
    {
        $this->get('/api/pages/contact-us')
            ->assertStatus(200)
            ->assertJsonStructure([
                'contactUs'
            ]);
    }
}
