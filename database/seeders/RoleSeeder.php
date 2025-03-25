<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $Operator = Role::firstOrCreate(['name' => 'Operator']);
        $user = Role::firstOrCreate(['name' => 'User']);
        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-book',
            'edit-book',
            'delete-book'
        ]);
        $Operator->givePermissionTo([
            'create-book',
            'edit-book',
            'delete-book'
        ]);

        $user->givePermissionTo([
            'view-book',
            'borrow-book'
        ]);

        
    }
}
