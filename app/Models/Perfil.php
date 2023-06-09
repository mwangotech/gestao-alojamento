<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perfil extends Model
{
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'perfil';
    
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
        'ordem',
        'estado',
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

    protected $appends = [
        'can_delete'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'perfil_menu', 'idPerfil', 'idMenu');
    }

    public function utilizadores()
    {
        return $this->belongsToMany(Menu::class, 'perfil_utilizador', 'idPerfil', 'idUtilizador');
    }

    protected function getCanDeleteAttribute() 
    {
        $user = DB::table('perfil_utilizador')->where('idPerfil', $this->id)->get();
        $menus = DB::table('perfil_menu')->where('idPerfil', $this->id)->get();
        if(count($user)>0 || count($menus)>0) {
            return false;
        } 
        return true;
    }

}
