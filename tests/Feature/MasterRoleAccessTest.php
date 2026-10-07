<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasterRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_master_role_is_available_without_changing_existing_roles(): void
    {
        $migration = require database_path('migrations/2026_10_07_000000_add_master_role_to_users_table.php');
        $migration->down();

        $admin = $this->createUser('admin', '100000000000000001');
        $operator = $this->createUser('operator', '100000000000000002');

        $migration->up();

        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'admin']);
        $this->assertDatabaseHas('users', ['id' => $operator->id, 'role' => 'operator']);

        $master = $this->createUser('master', '100000000000000003');
        $this->assertDatabaseHas('users', ['id' => $master->id, 'role' => 'master']);
    }

    public function test_existing_admin_can_be_promoted_explicitly_to_the_first_master(): void
    {
        $admin = $this->createUser('admin', '100000000000000012');

        $this->artisan('users:promote-master', ['nip' => $admin->nip])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'master']);
    }

    public function test_admin_can_create_pengawas_but_cannot_manage_master_users_or_api_clients(): void
    {
        $admin = $this->createUser('admin', '100000000000000004');

        $this->actingAs($admin)
            ->get(route('user.create'))
            ->assertOk()
            ->assertSee('<option value="pengawas"', false)
            ->assertDontSee('<option value="admin"', false)
            ->assertDontSee('<option value="master"', false);

        $this->actingAs($admin)
            ->post(route('user.store'), [
                'nama' => 'Pengawas Test',
                'nip' => '100000000000000005',
                'role' => 'pengawas',
                'wa' => '08123456789',
            ])
            ->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('users', [
            'nip' => '100000000000000005',
            'role' => 'pengawas',
        ]);

        $this->actingAs($admin)
            ->post(route('user.store'), [
                'nama' => 'Master Test',
                'nip' => '100000000000000006',
                'role' => 'master',
                'wa' => '08123456789',
            ])
            ->assertSessionHasErrors('role');

        $this->actingAs($admin)->get(route('api-clients.index'))->assertForbidden();

        $masterAccount = $this->createUser('master', '100000000000000011');
        $this->actingAs($admin)
            ->put(route('user.update', $masterAccount), [
                'nama' => 'Changed by admin',
                'nip' => '100000000000000011',
                'role' => 'operator',
                'wa' => '08123456789',
            ])
            ->assertNotFound();
        $this->assertDatabaseHas('users', ['id' => $masterAccount->id, 'role' => 'master']);
    }

    public function test_master_can_manage_api_clients_and_only_sees_admin_and_master_users(): void
    {
        $master = $this->createUser('master', '100000000000000007');
        $admin = $this->createUser('admin', '100000000000000008');
        $this->createUser('operator', '100000000000000009');

        $this->actingAs($master)
            ->get(route('api-clients.index'))
            ->assertOk();

        $this->actingAs($master)
            ->get(route('master.user.index'))
            ->assertOk()
            ->assertSee($master->name)
            ->assertSee($admin->name)
            ->assertDontSee('User operator');

        $this->actingAs($master)
            ->get(route('master.user.create'))
            ->assertOk()
            ->assertSee('<option value="admin"', false)
            ->assertSee('<option value="master"', false)
            ->assertDontSee('<option value="operator"', false)
            ->assertDontSee('<option value="pengawas"', false);

        $this->actingAs($master)
            ->post(route('master.user.store'), [
                'nama' => 'Admin Created By Master',
                'nip' => '100000000000000010',
                'role' => 'admin',
                'wa' => '08123456789',
            ])
            ->assertRedirect(route('master.user.index'));

        $this->assertDatabaseHas('users', [
            'nip' => '100000000000000010',
            'role' => 'admin',
        ]);
    }

    private function createUser(string $role, string $nip): User
    {
        return User::create([
            'name' => "User {$role}",
            'wa' => '08123456789',
            'nip' => $nip,
            'password' => 'password',
            'role' => $role,
        ]);
    }
}
