<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function test_dashboard(): void
    {
        $users = User::factory(20)->create();

        $this->browse(function (Browser $browser) use ($users) {
            $user = $users->first();

            $browser
                ->loginAs($user, 'web')
                ->visitRoute('dashboard')
                ->assertSee(__('Welcome :user', ['user' => $user->name]))
                ->click('.next-link')
                ->assertQueryStringHas('page', 2)
                ->click('.prev-link')
                ->assertQueryStringHas('page', 1)
                ->assertAuthenticatedAs($user, 'web');
        });
    }
}
