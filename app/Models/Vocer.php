<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocer extends Model
{
    use HasFactory;
    protected $table = 'vocer_code';
    public $timestamps = false;

    public function hadiahs(){
        return $this->belongsTo(hadiah::class, 'id_hadiah');
    }
}
