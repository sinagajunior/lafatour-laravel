<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $staff = Role::firstOrCreate(['name' => 'Staff']);

        // Create or update admin user
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@lafatour.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('MVa8jK9Fp2puI2aB8turfs'),
            ]
        );

        // Assign Super Admin role
        $adminUser->assignRole($superAdmin);

        $this->command->info('Admin user created successfully.');
        $this->command->info('Email: admin@lafatour.com');
        $this->command->info('Password: MVa8jK9Fp2puI2aB8turfs');
    }
}
