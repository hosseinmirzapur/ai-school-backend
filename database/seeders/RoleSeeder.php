<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate([
            'name' => 'superadmin',
            'permissions' => ['*']
        ]);

        $this->command->getOutput()->success("Role $role->name created!");
    }
}
