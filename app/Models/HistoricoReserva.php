<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoricoReserva extends Model
{
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'historico_reserva';
    
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
        'idReserva', 
        'idUtilizador',
        'idEstadoReserva',
        'notas',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pivot',
        'utilizador'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       
    ];

    protected $appends = [
        'nomeUtilizador',
        'nomeEstadoReserva',
        'corEstadoReserva'
    ];
    
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
    

}
