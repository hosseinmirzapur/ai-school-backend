<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'active' => true,
            'role_id' => Role::firstOrFail()->id
        ]);

        $this->command->getOutput()->success("Admin $admin->name created!");
    }
}
