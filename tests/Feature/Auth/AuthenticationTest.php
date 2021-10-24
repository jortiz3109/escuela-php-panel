<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_it_redirects_logged_users_to_home(): void
    {
        $user = User::factory()->enabled()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_authenticate_if_they_are_enabled(): void
    {
        $user = User::factory()->enabled()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
    }

    public function test_users_cannot_authenticate_if_they_are_disabled(): void
    {
        $user = User::factory()->disabled()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
    }

    public function test_users_are_locked_after_three_login_failed_attempts(): void
    {
        $user = User::factory()->enabled()->create();

        Config::set('auth.max_attempts', 1);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertTrue($user->isEnabled());

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $user->refresh();

        $this->assertFalse($user->isEnabled());
    }


    public function test_it_log_the_login_attempt_when_user_are_authenticated(): void
    {
        $user = User::factory()->enabled()->create();

        $this->serverVariables = [
            'REMOTE_ADDR' => '192.168.1.1',
            'HTTP_USER_AGENT' => 'Opera/8.26 (X11; Linux x86_64; sl-SI) Presto/2.12.277 Version/10.00',
        ];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('login_logs', [
            'user_id' => $user->id,
            'ip_address' => '192.168.1.1',
            'user_agent' => 'Opera/8.26 (X11; Linux x86_64; sl-SI) Presto/2.12.277 Version/10.00',
        ]);
    }
}
