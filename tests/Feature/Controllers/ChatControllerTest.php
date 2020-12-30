<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Chat;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_chats()
    {
        $chats = Chat::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('chats.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.chats.index')
            ->assertViewHas('chats');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_chat()
    {
        $response = $this->get(route('chats.create'));

        $response->assertOk()->assertViewIs('app.chats.create');
    }

    /**
     * @test
     */
    public function it_stores_the_chat()
    {
        $data = Chat::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('chats.store'), $data);

        $this->assertDatabaseHas('chats', $data);

        $chat = Chat::latest('id')->first();

        $response->assertRedirect(route('chats.edit', $chat));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_chat()
    {
        $chat = Chat::factory()->create();

        $response = $this->get(route('chats.show', $chat));

        $response
            ->assertOk()
            ->assertViewIs('app.chats.show')
            ->assertViewHas('chat');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_chat()
    {
        $chat = Chat::factory()->create();

        $response = $this->get(route('chats.edit', $chat));

        $response
            ->assertOk()
            ->assertViewIs('app.chats.edit')
            ->assertViewHas('chat');
    }

    /**
     * @test
     */
    public function it_updates_the_chat()
    {
        $chat = Chat::factory()->create();

        $user = User::factory()->create();

        $data = [
            'message' => $this->faker->text,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('chats.update', $chat), $data);

        $data['id'] = $chat->id;

        $this->assertDatabaseHas('chats', $data);

        $response->assertRedirect(route('chats.edit', $chat));
    }

    /**
     * @test
     */
    public function it_deletes_the_chat()
    {
        $chat = Chat::factory()->create();

        $response = $this->delete(route('chats.destroy', $chat));

        $response->assertRedirect(route('chats.index'));

        $this->assertDeleted($chat);
    }
}
