<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'idTipoQuarto',
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
        'nomeTipoQuarto',
        'nomeEstadoQuarto',
        'corEstadoQuarto',
        'iconEstadoQuarto',
        'can_delete'
    ];

    protected function estadoQuarto()
    {
        return $this->belongsTo(EstadoQuarto::class, 'idEstadoQuarto');
    }

    protected function tipoQuarto()
    {
        return $this->belongsTo(TipoQuarto::class, 'idTipoQuarto');
    }

    protected function getNomeEstadoQuartoAttribute()
    {
        return $this->estadoQuarto->nome;
    }
    
    protected function getCorEstadoQuartoAttribute()
    {
        return $this->estadoQuarto->cor;
    }
    protected function getIconEstadoQuartoAttribute()
    {
        return $this->estadoQuarto->icon;
    }
    
    protected function getNomeTipoQuartoAttribute()
    {
        return $this->tipoQuarto->nome;
    }
    

    public function comodidades()
    {
        return $this->belongsToMany(Comodidade::class, 'comodidade_quarto', 'idQuarto', 'idComodidade');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'servico_quarto', 'idQuarto', 'idServico');
    }


    protected function getCanDeleteAttribute() 
    {
        $reservas = DB::table('reserva')->where('idQuarto', $this->id)->get();
        if(count($reservas)>0) {
            return false;
        } 
        return true;
    }

}
