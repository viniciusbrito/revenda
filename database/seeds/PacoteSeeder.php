<?php

use Illuminate\Database\Seeder;

class PacoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pk1 = ['nome' => 'Basico - Mensal', 'periodo' => 'MONTHLY', 'valor' => '6.40'];
        DB::table('pacotes')->insert($pk1);

        $pk2 = ['nome' => 'Basico - Trimestral', 'periodo' => 'TRIMONTHLY', 'valor' => '19.00'];
        DB::table('pacotes')->insert($pk2);

        $pk3 = ['nome' => 'Basico - Anual', 'periodo' => 'YEARLY', 'valor' => '36.00'];
        DB::table('pacotes')->insert($pk3);
    }
}
