<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\User\UserUnitDataProvider;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use UserUnitDataProvider;

    /**
     * @dataProvider userStatusDataProvider
     * @param string $status
     * @param bool $value
     * @test
     */
    public function a_user_has_the_a_status(string $status, bool $value)
    {
        $user = User::factory()->{$status}()->make();

        $this->assertEquals($value, $user->isEnabled());
    }

    /**
     * @dataProvider userEmailVerifyDataProvider
     * @param string $verifyStatus
     * @param bool $value
     * @test
     */
    public function a_user_has_verify_email(string $verifyStatus, bool $value)
    {
        $user = User::factory()->{$verifyStatus}()->create();
        $this->assertEquals($value, $user->isEmailVerified($user));
    }
}
