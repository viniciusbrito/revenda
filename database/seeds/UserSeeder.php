<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = [
            'nome' => 'Test User',
            'email' => 'testuser@sandbox.pagseguro.com.br',
            'telefone' => '11 111223300',
            'cpf' => '022.181.461-26',
            'password' => bcrypt('senha123'),
            'remember_token' => str_random(10),
        ];
        DB::table('users')->insert($usr);
    }
}
