<?php


namespace App\Models;

use JbSilva\ORM\Model;

class Registros extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class);
    }

    public function registersForMoth()
    {
        return $this->query("SELECT r.id, r.data, r.entrada, r.entrada_intervalo, r.saida_intervalo, r.saida,
        (SELECT TIMEDIFF(verificar_valor(r1.saida, r1.entrada),verificar_valor(r1.saida_intervalo, r1.entrada_intervalo))
                FROM registros as r1 WHERE r1.id = r.id) as saldo,
       (SELECT TIMEDIFF(verificar_valor(r3.saida, r3.entrada),verificar_valor(r3.saida_intervalo, r3.entrada_intervalo)) FROM registros as r3
           WHERE r3.id = (SELECT max(id)-1 as id_anterior FROM registros ra WHERE ra.id = r.id ORDER BY ra.id DESC LIMIT 1)) as saldo_anterior,
        (SELECT TIMEDIFF(saldo, TIME('08:00:00')) FROM registros as r2 WHERE r2.id = r.id) as saldo_dia,
        (SELECT TIMEDIFF(saldo_anterior, TIME('08:00:00')) FROM registros as r3 WHERE r3.id = r.id) as saldo_diff,
        (SELECT ADDTIME(saldo_dia, saldo_diff) FROM registros AS r4 WHERE r4.id = r.id) as saldo_total
        FROM registros as r /*WHERE YEAR(r.data) = YEAR(now()) AND MONTH(r.data) = MONTH(now()) ORDER BY r.id DESC*/;");
    }

    public function calcularTotalHoras(array $horas)
    {
        $time = 0;

        foreach ($horas as $hora) {
            $objTime = $this->query("SELECT ADDTIME('{$time}','{$hora}') as total");
            $time = end($objTime['data'])->total;
        }

        return $time;
    }
}