<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * @var string
     */
    protected const PASSWORD = 'password';

    /**
     * A basic feature test failed login.
     *
     * @return void
     */
    public function test_failed_login(): void
    {
        $response = $this
            ->from(route('login'))
            ->post(route('do.login'), []);

        $response->assertSessionHasErrors(['email', 'password']);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * A basic feature test invalid credentials.
     *
     * @return void
     */
    public function test_invalid_credentials(): void
    {
        $credentials = ['email' => $email = $this->faker->email, 'password' => self::PASSWORD];

        $response = $this
            ->from(route('login'))
            ->post(route('do.login'), $credentials);

        $this->assertInvalidCredentials($credentials, 'web');

        $response->assertSessionHasInput('email', $email);
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * A basic feature test invalid email.
     *
     * @return void
     */
    public function test_invalid_email(): void
    {
        $response = $this
            ->from(route('login'))
            ->post(route('do.login'), ['email' => $email = $this->faker->name]);

        $response->assertSessionHasInput('email', $email);
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * A basic feature test required password.
     *
     * @return void
     */
    public function test_required_password(): void
    {
        $response = $this
            ->from(route('login'))
            ->post(route('do.login'), ['email' => $email = $this->faker->email]);

        $response->assertSessionHasInput('email', $email);
        $response->assertSessionHasErrors(['password']);
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * A basic feature test valid credentials.
     *
     * @return void
     */
    public function test_valid_credentials(): void
    {
        $user = User::factory()->create();
        $credentials = ['email' => $email = $user->email, 'password' => self::PASSWORD];


        $response = $this
            ->from(route('login'))
            ->post(route('do.login'), $credentials);

        $this
            ->assertCredentials($credentials)
            ->assertAuthenticatedAs($user, 'web');

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
    }

    /**
     * A basic feature test success logout.
     *
     * @return void
     */
    public function test_success_logout(): void
    {
        $response = $this
            ->actingAs($user = User::factory()->create())
            ->delete(route('logout'));

        $this->assertGuest('web');

        $response->assertRedirect(route('login'));
    }
}
