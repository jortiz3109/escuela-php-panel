<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{

    public function test_new_users_can_register()
    {
        $user=User::factory()->create();
        
        $response = $this->actingAs($user)->post('/register', 
                [
                        'name' => 'Jennifer',
                        'email' => 'jennifer@gmail.com',
                        'password' => Hash::make('jennifer'),
                        'created_by' => $user->id,
                        'updated_by' => $user->id,
                    ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

    }
}
