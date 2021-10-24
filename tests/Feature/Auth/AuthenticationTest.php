<?php

namespace Tests\Feature\Auth;

use App\Models\LoginLog;
use App\Models\User;
use App\Notifications\LoggedFromUnknownDevice;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
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
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_USER_AGENT' => 'Opera/8.26 (X11; Linux x86_64; sl-SI) Presto/2.12.277 Version/10.00',
        ];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('login_logs', [
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Opera/8.26 (X11; Linux x86_64; sl-SI) Presto/2.12.277 Version/10.00',
        ]);
    }

    public function test_it_notify_when_login_from_a_unknow_device(): void
    {
        Notification::fake();

        $user = User::factory()
            ->enabled()
            ->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        Notification::assertSentTo(
            [$user],
            LoggedFromUnknownDevice::class
        );
    }

    /**
     * @param array $loginLog
     * @dataProvider loginsProvider
     */
    public function test_it_does_not_notify_when_logging_in_from_a_known_device(array $loginLog): void
    {
        Notification::fake();

        $user = User::factory()
            ->enabled()
            ->create();

        LoginLog::factory()->for($user)->create($loginLog);

        $this->serverVariables = [
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_USER_AGENT' => 'Opera/8.26 (X11; Linux x86_64; sl-SI)',
        ];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        Notification::assertNotSentTo(
            [$user],
            LoggedFromUnknownDevice::class
        );
    }

    public function loginsProvider(): array
    {
        return [
            [
                'data' => [
                    'created_at' => '2021-10-19 06:00:00',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Opera/8.26 (X11; Linux x86_64; sl-SI)',
                ],
            ],
        ];
    }
}
