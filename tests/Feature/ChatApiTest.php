<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ChatApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->withHeaders([
            'Accept' => 'application/json',
        ]);
    }

    /**
     * @return void
     */
    public function test_new_casual_chat(): void
    {
        $this->actingAs(Student::all()->random())
            ->post('/api/chat/casual')
            ->assertStatus(200)
            ->assertJsonStructure(['identifier']);
    }

    /**
     * @return void
     */
    public function test_new_quiz_chat(): void
    {
        $this->actingAs(Student::all()->random())
            ->post('/api/chat/quiz')
            ->assertStatus(200)
            ->assertJsonStructure(['identifier']);
    }

    /**
     * @return void
     */
    public function test_new_chat_with_wrong_type_should_fail(): void
    {
        $randomString = Str::random(10);
        $this->actingAs(Student::all()->random())
            ->post("/api/chat/$randomString")
            ->assertNotFound();
    }

    /**
     * @return void
     */
    public function test_send_message_to_chat(): void
    {
        $message = Message::factory()->create();
        $chat = Chat::all()->random();

        $this->actingAs(Student::all()->random())
            ->post("/api/chat/$chat->identifier/message", [
                'content' => $message->content,
            ])
            ->assertStatus(200)
            ->assertJsonFragment([
                'status' => 400
            ]);
            // use this after AI service was prepared
//            ->assertJsonStructure([
//                'result'
//            ]);
    }
}
