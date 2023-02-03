<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin_role = Role::create(['name' => 'admin']);
        $admin = User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123')
        ]);

        $admin->assignRole($admin_role);

        $user_role = Role::create(['name' => 'user']);
        $user = User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('123')
        ]);

        $user->assignRole($user_role);

        // $permission = Permission::create(['name' => 'edit articles']);
    }
}
