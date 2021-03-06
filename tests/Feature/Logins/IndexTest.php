<?php

namespace Tests\Feature\Logins;

use App\Models\KnowDevice;
use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public const LOGINS_ROUTE_NAME = 'logins.index';

    public function test_it_can_list_logins(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::LOGINS_ROUTE_NAME));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_logins(): void
    {
        /** @var Authenticatable */
        $user = User::factory()
            ->hasKnowDevices(1)
            ->create();

        $device = $user->knowDevices()->first();

        LoginLog::factory()->forDevice($device);

        $response = $this->actingAs($user)->get(route(self::LOGINS_ROUTE_NAME));

        $response->assertViewHas('logins');

        $this->assertInstanceOf(
            Collection::class,
            $response->getOriginalContent()['logins']
        );
    }

    public function test_collection_has_logins(): void
    {
        /** @var Authenticatable */
        $user = User::factory()->hasKnowDevices(1)->create();
        $device = $user->knowDevices()->first();

        LoginLog::factory()
            ->for($device, 'device')
            ->for($user)
            ->create();

        $response = $this->actingAs($user)->get(route(self::LOGINS_ROUTE_NAME));

        $this->assertInstanceOf(
            LoginLog::class,
            $response->getOriginalContent()['logins']->first()
        );
    }

    public function test_it_show_logins_data(): void
    {
        /** @var Authenticatable $user */
        $user = User::factory()
            ->has(KnowDevice::factory())
            ->create();

        $device = $user->knowDevices()->first();

        $login = LoginLog::factory()
            ->for($device, 'device')
            ->for($user)
            ->create(['ip_address' => '127.0.0.1']);

        $response = $this->actingAs($user)->get(route(self::LOGINS_ROUTE_NAME));

        $response->assertSee($login->created_at);
        $response->assertSee($login->ip_address);
        $response->assertSee($login->device->user_agent);
    }
}
