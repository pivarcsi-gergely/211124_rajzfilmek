<?php
namespace Petrik\Rajzfilmek;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Rajzfilm extends Model {
    protected $table = 'rajzfilm';
    public $timestamps = false;

    //Vagy az egyik, vagy a masik
    protected $fillable = ['cim', 'hossz', 'kiadasi_ev']; //Mit lehet; összetebb szituációkban hasznos
    protected $guarded = ['id']; // Mit nem lehet; egyszerűbb -||-
}