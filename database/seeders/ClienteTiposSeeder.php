<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * php artisan db:seed --class=ClienteTiposSeeder
     */
    public function run()
    {
        DB::transaction(function(){
            DB::table('genero')->insert([
                [
                    'id' => 1,
                    'nome' => 'Feminino',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'nome' => 'Masculino',
                    'ordem' => 1,
                    'estado' => 1
                ]
            ]);
            DB::table('estado_civil')->insert([
                [
                    'id' => 1,
                    'nome' => 'Solteiro',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'nome' => 'Casado',
                    'ordem' => 1,
                    'estado' => 1
                ],[
                    'id' => 3,
                    'nome' => 'Divorciado',
                    'ordem' => 2,
                    'estado' => 1
                ]
            ]);
            DB::table('tipo_cliente')->insert([
                [
                    'id' => 1,
                    'nome' => 'Individual',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'nome' => 'Empresa',
                    'ordem' => 1,
                    'estado' => 1
                ]
            ]);
            DB::table('tipo_documento')->insert([
                [
                    'id' => 1,
                    'civil'=>1,
                    'fiscal'=>0,
                    'nome' => 'Bilhete de Identidade',
                    'ordem' => 0,
                    'estado' => 1
                ],[
                    'id' => 2,
                    'civil'=>0,
                    'fiscal'=>1,
                    'nome' => 'Número de Identificação Fiscal',
                    'ordem' => 1,
                    'estado' => 1
                ]
            ]);
        });
    }
}
