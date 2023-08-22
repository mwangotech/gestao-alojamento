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
    public $timestamps = true;
   
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
        'nomeEstadoReserva',
        'corEstadoReserva',
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
    

    protected function estadoReserva()
    {
        return $this->belongsTo(EstadoReserva::class, 'idEstadoReserva');
    }

    protected function getNomeEstadoReservaAttribute()
    {
        return $this->estadoReserva->nome;
    }
    
    protected function getCorEstadoReservaAttribute()
    {
        return $this->estadoReserva->cor;
    }
    

    protected function utilizador()
    {
        return $this->belongsTo(User::class, 'idUtilizador');
    }

    protected function getNomeUtilizadorAttribute()
    {
        return $this->utilizador->name;
    }
    

    public function comodities()
    {
        //return $this->belongsToMany(Quarto::class, 'reserva_quarto', 'idReserva', 'idQuarto');
    }


}
