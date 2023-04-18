<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\PermissionRegistrar;

    class PermissionsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions
            $permission1 = Permission::create(['name' => 'role']);
            $permission2 = Permission::create(['name' => 'users']);
            $permission3 = Permission::create(['name' => 'category']);
            $permission4 = Permission::create(['name' => 'post']);
            $permission5 = Permission::create(['name' => 'game']);
            $permission6 = Permission::create(['name' => 'comment']);
            $permission7 = Permission::create(['name' => 'ads']);
            $permission8 = Permission::create(['name' => 'banner']);
            $permission9 = Permission::create(['name' => 'setting']);
            $superAdmin = Role::create(['name' => 'Quản trị']);
            $superAdmin->givePermissionTo([$permission1, $permission2, $permission3, $permission4, $permission5, $permission6, $permission7, $permission8, $permission9]);
            $user = \App\Models\User::factory()->create([
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'email' => 'toantran26099@gmail.com'
            ]);
            // $user->assignRole($superAdmin);

            // $user = \App\Models\User::find(1);
            $user->assignRole($superAdmin);
            



        }
    }
