<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $salesRole = config('roles.models.role')::where('name', '=', 'Sales')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@admin.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Admin',
                'last_name'     => 'Master',
                'email'    => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'user@user.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'User',
                'last_name'     => 'Master',
                'email'    => 'user@user.com',
                'password' => Hash::make('password'),
            ]);

            $newUser->attachRole($userRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'sales@sales.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Sales',
                'last_name'     => 'Master',
                'email'    => 'sales@sales.com',
                'password' => Hash::make('password'),
            ]);

            $newUser->attachRole($salesRole);
        }
    }
}
