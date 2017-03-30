<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adm = [
            'nome' => 'Vinícius Brito',
            'email' => 'vinicius.fernandes.brito@gmail.com',
            'password' => bcrypt('senha123'),
            'remember_token' => str_random(10),
        ];
        DB::table('admins')->insert($adm);
    }
}
