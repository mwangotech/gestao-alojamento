<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PagamentosTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * php artisan db:seed --class=PagamentosTiposSeeder
     */
    public function run()
    {
        DB::transaction(function(){
            DB::table('metodo_pagamento')->insert([
                [
                    'id' => 1,
                    'nome' => 'Transferência Bancária',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'nome' => 'TPA',
                    'ordem' => 1,
                    'estado' => 1
                ],[
                    'id' => 3,
                    'nome' => 'Dinheiro',
                    'ordem' => 2,
                    'estado' => 1
                ]
            ]);
            DB::table('estado_pagamento')->insert([
                [
                    'id' => 1,
                    'nome' => 'Novo',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'nome' => 'Em Processamento',
                    'ordem' => 1,
                    'estado' => 1
                ],[
                    'id' => 3,
                    'nome' => 'Pago',
                    'ordem' => 2,
                    'estado' => 1
                ]
            ]);
        });
    }
}
