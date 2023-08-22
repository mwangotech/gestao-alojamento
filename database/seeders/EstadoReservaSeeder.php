<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstadoReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * php artisan db:seed --class=EstadoReservaSeeder
     */
    public function run()
    {
        DB::table('estado_reserva')->insert([[
            'id' => 1,
            'nome' => 'Reservado',
            'cor' => 'warning',
            'icon' => 'fa fa-calendar-plus-o',
            'ordem' => 0,
            'estado' => 1
        ],[
            'id' => 2,
            'nome' => 'Em Checkin',
            'cor' => 'success',
            'icon' => 'fa fa-bed',
            'ordem' => 1,
            'estado' => 1
        ],[
            'id' => 3,
            'nome' => 'Checkout',
            'cor' => 'info',
            'icon' => 'fa fa-calendar-check-o',
            'ordem' => 2,
            'estado' => 1
        ],[
            'id' => 4,
            'nome' => 'Cancelado',
            'cor' => 'danger',
            'icon' => 'fa-calendar-times-o',
            'ordem' => 2,
            'estado' => 1
        ]]);
    }
}
