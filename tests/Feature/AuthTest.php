<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    public function test_guests_are_redirected_to_login(): void
    {
        foreach (['/dashboard', '/students', '/subjects', '/enrollments', '/users'] as $url) {
            $this->get($url)->assertRedirect('/login');
        }
    }

    public function test_user_can_register(): void
    {
        $this->post('/register', [
            'name' => 'Jane Admin', 'email' => 'jane@test.com',
            'password' => 'secret123', 'password_confirmation' => 'secret123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'jane@test.com']);
    }

    public function test_registration_validates_input(): void
    {
        $this->makeUser(['email' => 'taken@test.com']);

        $this->post('/register', ['name' => '', 'email' => 'taken@test.com', 'password' => 'short', 'password_confirmation' => 'nope'])
            ->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = $this->makeUser(['email' => 'a@test.com', 'password' => 'password']);

        $this->post('/login', ['email' => 'a@test.com', 'password' => 'password'])
            ->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->makeUser(['email' => 'a@test.com']);

        $this->post('/login', ['email' => 'a@test.com', 'password' => 'wrong'])->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_user_can_logout(): void
    {
        $this->actingAs($this->makeUser())->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_logged_in_users_cannot_see_login_page(): void
    {
        $this->actingAs($this->makeUser())->get('/login')->assertRedirect();
    }
}
