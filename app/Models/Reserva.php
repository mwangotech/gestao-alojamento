<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'reserva';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'idCliente', 
        'idQuarto', 
        'idEstadoReserva',
        'totalHospedes',
        'totalAdulto',
        'totalCrianca',
        'dataInicio',
        'dataFim',
        'checkin',
        'checkout',
        'idUtilizador',
        'qtdDias',
        'preco',
        'valor',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       
    ];

    protected $appends = [
        'nomeCliente',
        'numeroQuarto',
        'nomeEstadoEstadoReserva',
        'nomeUtilizador'
    ];

    protected function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    protected function getNomeClienteAttribute()
    {
        return $this->cliente->nome;
    }
    

    protected function quarto()
    {
        return $this->belongsTo(Quarto::class, 'idQuarto');
    }

    protected function getNumeroQuartoAttribute()
    {
        return $this->quarto->numero;
    }
    

    protected function estadoEstadoReserva()
    {
        return $this->belongsTo(EstadoEstadoReserva::class, 'idEstadoEstadoReserva');
    }

    protected function getNomeEstadoEstadoReservaAttribute()
    {
        return $this->estadoEstadoReserva->nome;
    }
    

    protected function utilizador()
    {
        return $this->belongsTo(Utilizador::class, 'idUtilizador');
    }

    protected function getNomeUtilizadorAttribute()
    {
        return $this->utilizador->nome;
    }
    

    public function quartos()
    {
        //return $this->belongsToMany(Quarto::class, 'reserva_quarto', 'idReserva', 'idQuarto');
    }


}
