<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->makeUser(['name' => 'Boss Person']);
        $this->actingAs($this->admin);
    }

    public function test_can_list_users(): void
    {
        $this->get('/users')->assertOk()->assertSee('Boss Person');
    }

    public function test_can_add_user_with_hashed_password(): void
    {
        $this->post('/users', ['name' => 'New Staff', 'email' => 'staff@test.com', 'password' => 'secret123', 'password_confirmation' => 'secret123'])
            ->assertRedirect(route('users.index'));

        $user = User::where('email', 'staff@test.com')->firstOrFail();
        $this->assertNotSame('secret123', $user->password);
        $this->assertTrue(\Hash::check('secret123', $user->password));
    }

    public function test_add_user_validation(): void
    {
        $this->post('/users', ['name' => '', 'email' => $this->admin->email, 'password' => 'short', 'password_confirmation' => 'x'])
            ->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_editing_without_password_keeps_the_old_one(): void
    {
        $user = $this->makeUser();
        $oldHash = $user->password;

        $this->put(route('users.update', $user), ['name' => 'Renamed', 'email' => $user->email, 'password' => ''])
            ->assertRedirect(route('users.index'));

        $this->assertSame('Renamed', $user->fresh()->name);
        $this->assertSame($oldHash, $user->fresh()->password);
    }

    public function test_can_change_password(): void
    {
        $user = $this->makeUser();

        $this->put(route('users.update', $user), ['name' => $user->name, 'email' => $user->email, 'password' => 'newpass123', 'password_confirmation' => 'newpass123']);
        $this->assertTrue(\Hash::check('newpass123', $user->fresh()->password));
    }

    public function test_can_delete_other_user(): void
    {
        $user = $this->makeUser();

        $this->delete(route('users.destroy', $user))->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_cannot_delete_own_account(): void
    {
        $this->delete(route('users.destroy', $this->admin));
        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);
    }
}
