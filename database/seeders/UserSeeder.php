<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Mehdi',
            'email' => '96rajabi@gmail.com',
            'password' => Hash::make('Ab123456'),
            'birthday' => '1996-09-05',
            'email_verified_at' => Carbon::now(),
            'type' => 'superuser'
        ]);
    }
}
