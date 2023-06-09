<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'quarto';
    
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
        'nome', 
        'descricao', 
        'numero',
        'idFotoPrincipal',
        'idEstadoQuarto',
        'limit_adulto',
        'limit_crianca',
        'preco',
        'created_at',
        'updated_at'
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
        'nomeEstadoQuarto',
        'corEstadoQuarto'
    ];

    protected function estadoQuarto()
    {
        return $this->belongsTo(EstadoQuarto::class, 'idEstadoQuarto');
    }

    protected function getNomeEstadoQuartoAttribute()
    {
        return $this->estadoQuarto->nome;
    }
    
    protected function getCorEstadoQuartoAttribute()
    {
        return $this->estadoQuarto->cor;
    }
    

    public function comodidades()
    {
        return $this->belongsToMany(Comodidade::class, 'comodidade_quarto', 'idQuarto', 'idComodidade');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'servico_quarto', 'idQuarto', 'idServico');
    }


}
