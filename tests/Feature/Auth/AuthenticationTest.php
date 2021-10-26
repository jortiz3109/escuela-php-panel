<?php

namespace Tests\Feature\Auth;

use App\Models\KnowDevice;
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

    public const IP_ADDRESS = '127.0.0.1';
    public const USER_AGENT = 'Opera/8.26 (X11; Linux x86_64; sl-SI)';

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

    public function test_it_log_the_login_attempt_when_user_is_authenticated(): void
    {
        $user = User::factory()->enabled()->create();

        $this->serverVariables = [
            'REMOTE_ADDR' => self::IP_ADDRESS,
            'HTTP_USER_AGENT' => self::USER_AGENT,
        ];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('login_logs', [
            'user_id' => $user->id,
            'ip_address' => self::IP_ADDRESS,
        ]);
    }

    public function test_it_store_the_device_when_user_is_authenticated(): void
    {
        $user = User::factory()->enabled()->create();

        $this->serverVariables = [
            'REMOTE_ADDR' => self::IP_ADDRESS,
            'HTTP_USER_AGENT' => self::USER_AGENT,
        ];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('know_devices', [
            'user_id' => $user->id,
            'user_agent' => self::USER_AGENT,
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

    public function test_it_notify_when_login_from_a_know_ancient_device(): void
    {
        Notification::fake();

        $user = User::factory()
            ->has(KnowDevice::factory([
                'user_agent' => self::USER_AGENT,
            ])->ancient())
            ->enabled()
            ->create();

        $this->serverVariables = [
            'REMOTE_ADDR' => self::IP_ADDRESS,
            'HTTP_USER_AGENT' => self::USER_AGENT,
        ];

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        Notification::assertSentTo(
            [$user],
            LoggedFromUnknownDevice::class
        );
    }

    public function test_it_does_not_notify_when_logging_in_from_a_known_and_recent_device(): void
    {
        Notification::fake();

        $user = User::factory()
            ->has(KnowDevice::factory([
                'user_agent' => self::USER_AGENT,
            ])->recent())
            ->enabled()
            ->create();

        $device = $user->knowDevices()->first();

        LoginLog::factory()->create([
            'user_id' => $user->id,
            'device_id' =>$device->id,
            'ip_address' => self::IP_ADDRESS,
            'created_at' => '2021-10-19 06:00:00',
        ]);

        $this->serverVariables = [
            'REMOTE_ADDR' => self::IP_ADDRESS,
            'HTTP_USER_AGENT' => self::USER_AGENT,
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
}
