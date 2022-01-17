<?php

namespace Tests\Feature\Merchants;

use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(Merchant::urlPresenter()->create());
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_create_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->create());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_shows_fields_to_create_merchants(): void
    {
        $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->create())
            ->assertSee(trans('merchants.placeholders.name'))
            ->assertSee(trans('merchants.placeholders.brand'))
            ->assertSee(trans('merchants.placeholders.document'))
            ->assertSee(trans('merchants.placeholders.url'))
            ->assertSee(trans('merchants.placeholders.country'))
            ->assertSee(trans('merchants.placeholders.currency'));
    }
}
