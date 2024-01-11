<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = new User();
        $adminUser->name = "Administrador";
        $adminUser->email = 'admin@mail.com';
        $adminUser->password = Hash::make('admin');
        $adminUser->save();

        $defaultUser = new User();
        $defaultUser->name = "Paulo Roberto Torres";
        $defaultUser->email = "paulo.torres.apps@gmail.com";
        $defaultUser->password = Hash::make('default');
        $defaultUser->save();

        $adminUser->assignRole('admin');
        $defaultUser->assignRole('default');
    }
}
