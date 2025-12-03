<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super admin', 'Owner', 'Manager', 'Cashier', 'Chef'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role
            ]);
        }

        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@mailinator.com',
        ]);

        $superadmin->assignRole('Super admin');

        $owner = User::factory()->create([
            'name' => 'Owner',
            'username' => 'owner',
            'email' => 'owner@mailinator.com',
        ]);

        $owner->assignRole('Owner');

        $manager = User::factory()->create([
            'name' => 'Manager',
            'username' => 'manager',
            'email' => 'manager@mailinator.com',
        ]);

        $manager->assignRole('Manager');

        $cashier = User::factory()->create([
            'name' => 'Cashier',
            'username' => 'cashier',
            'email' => 'cashier@mailinator.com',
        ]);

        $cashier->assignRole('Cashier');

        $chef = User::factory()->create([
            'name' => 'Chef',
            'username' => 'chef',
            'email' => 'chef@mailinator.com',
        ]);

        $chef->assignRole('Chef');
    }
}
