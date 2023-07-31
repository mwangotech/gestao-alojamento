<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstadoQuartoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * php artisan db:seed --class=EstadoQuartoSeeder
     */
    public function run()
    {
        DB::table('estado_quarto')->insert([[
            'id' => 1,
            'nome' => 'Ativo',
            'cor' => 'success',
            'icon' => 'fa fa-bed',
            'ordem' => 0,
            'estado' => 1
        ],[
            'id' => 2,
            'nome' => 'Inativo',
            'cor' => 'danger',
            'icon' => 'fa fa-minus-circle',
            'ordem' => 1,
            'estado' => 1
        ],[
            'id' => 3,
            'nome' => 'Em Manutenção',
            'cor' => 'warning',
            'icon' => 'fa fa-cogs',
            'ordem' => 2,
            'estado' => 1
        ]]);
    }
}
