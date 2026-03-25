<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'musteri@test.com'],
            [
                'name' => 'Test Müşteri',
                'password' => bcrypt('Test123!'),
                'phone' => '0532 111 22 33',
                'is_admin' => false,
            ]
        );
    }
}
