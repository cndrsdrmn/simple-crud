<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard()
    {
        User::factory(10)->create();

        $response = $this
            ->actingAs($user = User::factory()->create())
            ->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSeeText(__('Welcome :user', ['user' => $user->name]));
        $response->assertViewHas('users', $users = User::withoutSelf()->paginate());
        $response->assertViewHas('no', $users->firstItem() - 1);
        $response->assertViewHasAll(['users', 'no']);
    }
}
