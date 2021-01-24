<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test failed login.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function test_failed_login(): void
    {
        $this->browse(function (Browser $first, Browser $second, Browser $third) {
            $first
                ->visitRoute('login')
                ->assertSee('Form Login')
                ->type('email', 'dummy')
                ->type('password', 'password')
                ->press('Login')
                ->assertSee(__('validation.email', ['attribute' => 'email']))
                ->assertRouteIs('login');

            $second
                ->visitRoute('login')
                ->assertSee('Form Login')
                ->press('Login')
                ->assertSee(__('validation.required', ['attribute' => 'email']))
                ->assertSee(__('validation.required', ['attribute' => 'password']))
                ->assertRouteIs('login');

            $third
                ->visitRoute('login')
                ->assertSee('Form Login')
                ->type('email', 'lorem@mail.org')
                ->press('Login')
                ->assertSee(__('validation.required', ['attribute' => 'password']))
                ->assertRouteIs('login');
        });
    }

    /**
     * Test success login
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function test_success_login(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->visitRoute('login')
                ->assertSee('Form Login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Login')
                ->back()
                ->assertRouteIs('dashboard')
                ->assertAuthenticatedAs($user, 'web');
        });
    }

    /**
     * Test success logout
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function test_success_logout(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user, 'web')
                ->visitRoute('dashboard')
                ->assertRouteIs('dashboard')
                ->waitForText(__('Welcome :user', ['user' => $user->name]))
                ->press('Logout')
                ->back()
                ->assertRouteIs('login');
        });
    }
}
