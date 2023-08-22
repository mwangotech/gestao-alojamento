<?php

namespace App\Models;

use App\Models\EstadoPagamento;
use App\Models\MetodoPagamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagamento extends Model
{
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'pagamento';
    
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
        'idCliente', 
        'idUtilizador',
        'idEstadoPagamento',
        'idMetodoPagamento',
        'montante',
        'dataPagamento',
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
        'utilizador',
        'estadoPagamento',
        'metodoPagamento',
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
        'nomeEstadoPagamento',
        'nomeMetodoPagamento',
    ];
    
    protected function getNumeroQuartoAttribute()
    {
        return $this->quarto->numero;
    }
    

    protected function estadoPagamento()
    {
        return $this->belongsTo(EstadoPagamento::class, 'idEstadoPagamento');
    }


    protected function getNomeEstadoPagamentoAttribute()
    {
        return $this->estadoPagamento->nome;
    }
    
    protected function metodoPagamento()
    {
        return $this->belongsTo(MetodoPagamento::class, 'idMetodoPagamento');
    }

    protected function getNomeMetodoPagamentoAttribute()
    {
        return $this->metodoPagamento->nome;
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
