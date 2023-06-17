<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'cliente';
    
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
        'idTipo', 
        'nome', 
        'email',
        'telefone',
        'idNacionalidade',
        'idProvincia',
        'idGenero',
        'idEstadoCivil',
        'dataNascimento',
        'profissao',
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
        'nomeTipo',
        'nomeNacionalidade',
        'nomeProvincia',
        'nomeGenero',
        'nomeEstadoCivil',
        'can_delete',
    ];

    protected function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'idTipo');
    }

    protected function getNomeTipoAttribute()
    {
        return $this->tipoCliente->nome;
    }
    
    protected function nacionalidade()
    {
        return $this->belongsTo(Pais::class, 'idNacionalidade');
    }

    protected function getNomeNacionalidadeAttribute()
    {
        return $this->nacionalidade->nome;
    }
    
    protected function provincia()
    {
        return $this->belongsTo(Provincia::class, 'idProvincia');
    }

    protected function getNomeProvinciaAttribute()
    {
        return $this->provincia->nome;
    }
    
    protected function genero()
    {
        return $this->belongsTo(Genero::class, 'idGenero');
    }

    protected function getNomeGeneroAttribute()
    {
        return $this->genero->nome;
    }
    
    protected function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'idEstadoCivil');
    }

    protected function getNomeEstadoCivilAttribute()
    {
        return $this->estadoCivil->nome;
    }
    

    public function reservas()
    {
        //return $this->belongsToMany(Comodidade::class, 'comodidade_cliente', 'idCliente', 'idComodidade');
    }

    public function pagamentos()
    {
        //return $this->belongsToMany(Servico::class, 'servico_cliente', 'idCliente', 'idServico');
    }


    protected function getCanDeleteAttribute() 
    {
        $reservas = DB::table('reserva')->where('idCliente', $this->id)->get();
        $pagamentos = DB::table('pagamento')->where('idCliente', $this->id)->get();
        if(count($reservas)>0 || count($pagamentos)>0) {
            return false;
        } 
        return true;
    }


}
