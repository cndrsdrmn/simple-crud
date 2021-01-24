<?php

namespace Tests\Feature\API;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_empty_detail(): void
    {
        $this
            ->actingAs($user = User::factory()->create(),'api')
            ->json('GET', route('api.user.index'))
            ->assertOk()
            ->assertJsonStructure(['data', 'pagination', 'message'])
            ->assertJson(['data' => []]);
    }

    public function test_create_detail(): void
    {
        $users = User::factory(10)->create();

        $payload = array_merge(UserDetail::factory()->make()->toArray(), [
            'user_id' => $users->random()->id
        ]);

        $this->assertDatabaseMissing('user_details', $payload);

        $this
            ->actingAs($users->random(), 'api')
            ->json('PUT', route('api.user.upsert'), $payload)
            ->assertOk()
            ->assertJsonStructure(['data', 'message'])
            ->assertJson(['data' => null]);

        $this->assertDatabaseHas('user_details', $payload);
    }

    public function test_show_detail(): void
    {
        $users = User::factory(10)->create();

        $detail = UserDetail::factory()->create([
            'user_id' => $users->random()->id
        ]);

        $this
            ->actingAs($users->random(), 'api')
            ->json('GET', route('api.user.show', ['id' => $detail->id]))
            ->assertOk()
            ->assertJsonStructure(['data', 'message'])
            ->assertJson(['data' => $detail->toArray(), 'message' => __('crud.show')]);
    }

    public function test_update_detail(): void
    {
        $users = User::factory(10)->create();

        $userId = ['user_id' => $users->random()->id];
        $detail = UserDetail::factory()->create($userId);

        $payload = array_merge($detail->toArray(), $userId, ['position' => $this->faker->jobTitle]);

        $this
            ->actingAs($users->random(), 'api')
            ->json('PUT', route('api.user.upsert', ['id' => $detail->id]), $payload)
            ->assertOk()
            ->assertJsonStructure(['data', 'message'])
            ->assertJson(['data' => null]);

        $this->assertDatabaseHas('user_details', $payload);
        $this->assertDatabaseMissing('user_details', $detail->toArray());
    }

    public function test_delete_detail(): void
    {
        $users = User::factory(10)->create();

        $detail = UserDetail::factory()->create([
            'user_id' => $users->random()->id
        ]);

        $this->assertDatabaseHas('user_details', $detail->toArray());

        $this
            ->actingAs($users->random(), 'api')
            ->json('DELETE', route('api.user.destroy', ['id' => $detail->id]))
            ->assertOk()
            ->assertJsonStructure(['data', 'message'])
            ->assertJson(['data' => null, 'message' => __('crud.delete')]);

        $this->assertDatabaseMissing('user_details', $detail->toArray());
    }
}
