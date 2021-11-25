<?php

namespace Tests\Feature\Register;

use Tests\Feature\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;


class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $user=User::factory()->create();
        $response = $this->actingAs($user)->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $user=User::factory()->create();
        $data = $this->userData();
        $response = $this->actingAs($user)->post('register',$data);

        $response->assertRedirect('dashboard');

    }

    public function test_required_name_user_register(): void
    {
        $user=User::factory()->create();
        $response = $this->actingAs($user)->post('/register', [
            'name' => '',
            'email' => 'jeante08@gmail.com',
            'password' => 'jeante08',
            'password_confirmation' => 'jeante08',
        ]
        );

        $response->assertInvalid(['name']);

    }

    public function test_required_email_user_register(): void
    {
        $user=User::factory()->create();
        $response = $this->actingAs($user)->post('/register', [
            'name' => 'jennifer',
            'email' => '',
            'password' => 'jeante08',
            'password_confirmation' => 'jeante08',
        ]
        );

        $response->assertInvalid(['email']);

    }

    public function test_uniqued_email_user_register(): void
    {
        $user=User::factory()->create(['email' => 'jeante08@gmail.com']);
        $data = $this->userData();
        $response = $this->actingAs($user)->post('/register',$data);

        $response->assertInvalid(['email']);

    }

    public function test_valid_name_user_register(): void
    {
        $user=User::factory()->create();
        $response = $this->actingAs($user)->post('/register', [
            'name' => 'jennifer09',
            'email' => 'jeante09@gmail.com',
            'password' =>'jeante08',
            'password_confirmation' => 'jeante08',
        ]
        );

        $response->assertInvalid(['name']);

    }

    public function test_disabled_user_register(): void
    {
        $user=User::factory()->create();
        $data = $this->userData();
        $response = $this->actingAs($user)->post('/register',$data);

        $response->assertRedirect('dashboard');
        $this->assertDatabaseHas('users',[
            "enabled_at"=> null,
        ]);
        
    }

    public function test_create_date_user_register(): void
    {
        $user=User::factory()->create();
        $data = $this->userData();
        $response = $this->actingAs($user)->post('/register',$data);

        $response->assertRedirect('dashboard');
        $this->assertDatabaseHas('users',[
            "created_at"=> now(),
        ]);
        
    }

    public function test_create_id_user_register(): void
    {
        $user=User::factory()->create();
        $data = $this->userData();
        $response = $this->actingAs($user)->post('/register',$data);

        $response->assertRedirect('dashboard');
        $this->assertDatabaseHas('users',[
            "created_by"=> $user->id,
        ]);        
    }

    public function userData(): array
    {
        return [
            'name' => 'Andrea',
            'email' => 'jeante08@gmail.com',
            'password' =>'jeante08',
            'password_confirmation' => 'jeante08',
        ];
    }
}
