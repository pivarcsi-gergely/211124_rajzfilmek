<?php
namespace Petrik\Rajzfilmek;

use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model {
    protected $table = 'kategoria';
    public $timestamps = false;

    //Vagy az egyik, vagy a masik
    protected $fillable = ['kategoria_nev']; //Mit lehet; összetebb szituációkban hasznos
    protected $guarded = ['id']; // Mit nem lehet; egyszerűbb -||-
}