<?php

use Illuminate\Database\Seeder;

class ContaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $st = [
            ['idStatus' => 1, 'status' => 'Aguardando Pagamento'],
            ['idStatus' => 2, 'status' => 'Ativo'],
            ['idStatus' => 3, 'status' => 'Inativo'],
            ['idStatus' => 4, 'status' => 'Pagamento Atrasado'],
        ];
        DB::table('conta_status')->insert($st);
    }
}
