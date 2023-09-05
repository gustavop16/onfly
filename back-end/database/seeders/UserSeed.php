<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name'     => 'Usuário 1',
                    'email'    => 'usuario1@teste.com',
                    'password' => \Hash::make('abcd1234')
                ],
                [
                    'name'     => 'Usuário 2',
                    'email'    => 'usuario2@teste.com',
                    'password' => \Hash::make('abcd1234')
                ],
                [
                    'name'     => 'Usuário 3',
                    'email'    => 'usuario3@teste.com',
                    'password' => \Hash::make('abcd1234')
                ]
            ]
        );
    }
}
