<?php

namespace Tests\Feature\Register;

use Tests\Feature\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
  

    public function test_new_users_can_register()
    {
        $user=User::factory()->create();
        //Auth::login($user);
        
        $response = $this->actingAs($user)->post('/register', 
                [
                        'name' => 'Jennifer',
                        'email' => 'jennifer@gmail.com',
                        'password' => 'jennifer'
                    ]);

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);

    }
}
