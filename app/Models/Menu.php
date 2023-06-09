<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menu';
    
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
        'idMenu', 
        'nome', 
        'icone',
        'link',
        'route',
        'codigo',
        'tipo',
        'ordem',
        'visivel',
        'estado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at', 
        'updated_at',
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       
    ];

    public function setIdMenuAttribute($value)
    {
        if($value <= 0){
            $this->attributes['idMenu'] = null;
        } else {
            $this->attributes['idMenu'] = $value;
        }
    }

    public function setLinkAttribute($value)
    {
        if(empty($value)){
            $this->attributes['link'] = "#";
        } else {
            $this->attributes['link'] = $value;
        }
    }


    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_menu', 'idMenu', 'idPerfil');
    }


}
