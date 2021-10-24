<?php

namespace Tests\Feature\Logins;

use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_logins(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/logins');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_has_a_collection_of_logins(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        LoginLog::factory()->for($user)->count(20)->create();

        $response = $this->actingAs($user)->get('/logins');

        $response->assertViewHas('logins');

        $this->assertInstanceOf(
            Collection::class,
            $response->getOriginalContent()['logins']
        );
    }

    public function test_collection_has_logins(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        LoginLog::factory()->for($user)->create();

        $response = $this->actingAs($user)->get('/logins');

        $this->assertInstanceOf(
            LoginLog::class,
            $response->getOriginalContent()['logins']->first()
        );
    }

    /**
     * @param array $data
     * @dataProvider loginsProvider
     */
    public function test_it_show_logins_data(array $data): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $login = LoginLog::factory()->for($user)->create($data);

        $response = $this->actingAs($user)->get('/logins');

        $response->assertSee($login->created_at);
        $response->assertSee($login->ip_address);
        $response->assertSee($login->user_agent);
    }

    public function loginsProvider(): array
    {
        return [
            [
                'data' => [
                    'created_at' => '2021-10-19 06:00:00',
                    'ip_address' => '192.168.0.1',
                    'user_agent' => 'Opera/8.26 (X11; Linux x86_64; sl-SI)',
                ],
            ],
        ];
    }
}
