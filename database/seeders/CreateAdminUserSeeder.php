<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
/**
 * Run the database seeds.
 *
 * @return void
 */
    public function run()
    {
        $user = User::create([
            'name' => 'Yazan Mohsen',
            'email' => 'yazan@gmail.com',
            'password' => bcrypt('123456'),
            'roles_name' => ['owner'],
            'Status' => 'مفعل',
        ]);
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}