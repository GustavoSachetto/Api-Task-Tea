<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Conta Teste Responsável',
            'email'             => 'admin@teste.com',
            'nickname'          => 'admin123',
            'status'            => true,
            'birthdate'         => '2002-01-22',
            'image'             => Storage::url('sistem/images/users/userSistem.png'),
            'password'          => Hash::make('admin'),
            'email_verified_at' => '2024-09-19 09:11:41'
        ])->assignRole('responsible');

        User::create([
            'name'              => 'Conta Teste Criança',
            'email'             => 'child@teste.com',
            'nickname'          => 'child123',
            'status'            => true,
            'birthdate'         => '2014-07-29',
            'image'             => Storage::url('sistem/images/users/userSistem.png'),
            'password'          => Hash::make('child'),
            'email_verified_at' => '2024-09-19 09:11:41'
        ])->assignRole('child');

        User::create([
            'name'              => 'Conta Teste Criança',
            'email'             => 'child2@teste.com',
            'nickname'          => 'child1234',
            'status'            => true,
            'birthdate'         => '2014-07-29',
            'image'             => Storage::url('sistem/images/users/userSistem.png'),
            'password'          => Hash::make('child'),
            'email_verified_at' => '2024-09-19 09:11:41'
        ])->assignRole('child');
    }
}
