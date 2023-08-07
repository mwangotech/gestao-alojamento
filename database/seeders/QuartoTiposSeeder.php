<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuartoTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * php artisan db:seed --class=QuartoTiposSeeder
     */
    public function run()
    {
        DB::transaction(function(){
            DB::table('tipo_quarto')->insert([
                [
                    'id' => 1,
                    'nome' => 'Padrão (1 à 2 pessoas)',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'nome' => 'Familiar (1 à 4 pessoas)',
                    'ordem' => 1,
                    'estado' => 1
                ],[
                    'id' => 3,
                    'nome' => 'Pivado (1 à 3 pessoas)',
                    'ordem' => 2,
                    'estado' => 1
                ],[
                    'id' => 4,
                    'nome' => 'Dormitório Misto (6 pessoas)',
                    'ordem' => 3,
                    'estado' => 1
                ],[
                    'id' => 5,
                    'nome' => 'Dormitório Feminino (6 pessoas)',
                    'ordem' => 4,
                    'estado' => 1
                ],[
                    'id' => 6,
                    'nome' => 'Dormitório Masculino (6 pessoas)',
                    'ordem' => 5,
                    'estado' => 1
                ]
            ]);
        });
    }
}
