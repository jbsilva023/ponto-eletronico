<?php


namespace App\Models;

use JbSilva\ORM\Model;

class Usuarios extends Model
{
    public function registros()
    {
        return $this->hasMany(Registros::class);
    }
}