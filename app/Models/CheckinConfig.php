<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinConfig extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'checkin_config';
    
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
     * @var array
     */
    protected $fillable = [
        'id',
        'horaCheckin',
        'minuteCheckin',
        'horaCheckout',
        'minuteCheckout'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
       
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       
    ];

    

}
