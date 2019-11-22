<?php


namespace App\Helpers;


class Helper
{
    static function mask($type, $value)
    {
        if ($value) {
            switch ($type) {
                case 'CNPJ':
                    return substr($value, 0, 2) . '.' . substr($value, 2, 3) .
                        '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4)
                        . '-' . substr($value, 12);
                    break;
                case 'CPF':
                    return substr($value, 0, 3) . '.' . substr($value, 3, 3) .
                        '.' . substr($value, 6, 2) . '-' . substr($value, 8);
                    break;
                case 'TELEFONE':
                    break;
                case 'CEP':
                    return substr($value, 0, 5) . '-' . substr($value, 5);
                    break;
                default:
                    return $value;
                    break;
            }
        }

        return $value;
    }

    static function unmask($value)
    {
        if (!empty($value)){
            $value =  preg_replace('/\D+/', '', $value);
        }

        return $value;
    }

    static function remove_characters($text)
    {
        $utf8 = [
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   '', // Literally a single quote
            '/[“”«»„]/u'    =>   '', // Double quote
            '/ /'           =>   '_', // nonbreaking space (equiv. to 0x160)
        ];
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

    static function replaceUrl($value)
    {
        $url = explode('?', $value);
        return $url[0];
    }

    static function dataSql($data)
    {
        if (!empty($data)) {
            $data = explode('/', $data);
            return $data[2] . '-' . $data[1] . '-' . $data[0];
        }
    }

    static function formatarData($data)
    {
        if (!empty($data)) {
            $data = explode('-', $data);
            return $data[2] . '/' . $data[1] . '/' . $data[0];
        }
    }

    static function tipoSaldo($saldo)
    {
        list($hora, $minuto, $segundo) = explode(':', $saldo);
        return strstr($hora, '-') ? 'text-danger' : 'text-success';
    }

    static function calcularHorasDia($entrada, $entrada_intervalo, $saida_intervalo, $saida)
    {
        $horas = strtotime($saida) - strtotime($entrada);
        $intervalo = strtotime($saida_intervalo) - strtotime($entrada_intervalo);
        $total_segundos = $horas - $intervalo;

        return self::converterHoras($total_segundos);
    }

    static function calcularHorasExtras($saldo, $horas_cumprir)
    {
        $total_segundos = strtotime($saldo) - strtotime($horas_cumprir);
        list($hora, $minuto, $segundo) = explode(':', self::converterHoras($total_segundos));
        return  ($hora > 0 or $minuto>0) ? '<span class="text-success">+'.self::converterHoras($total_segundos).'</span>' : '00:00:00' ;
    }

    static function calcularHorasDevidas($saldo, $horas_cumprir)
    {
        $total_segundos = strtotime($horas_cumprir) - strtotime($saldo) ;
        list($hora, $minuto, $segundo) = explode(':', self::converterHoras($total_segundos));
        return  ($hora > 0 or $minuto>0) ? '<span class="text-danger">-' . self::converterHoras($total_segundos).'</span>' : '00:00:00' ;
    }

    static function calcularSaldoDia($saldo, $horas_cumprir)
    {
        $total_segundos = strtotime($saldo) - strtotime($horas_cumprir);
        list($hora, $minuto, $segundo) = explode(':', self::converterHoras($total_segundos));
        if ($hora > 0 or $minuto>0) {
            return '<span class="text-success">+'.self::converterHoras($total_segundos).'</span>';
        } else {
            $total_segundos = strtotime($horas_cumprir) - strtotime($saldo) ;
            return '<span class="text-danger">-' . self::converterHoras($total_segundos).'</span>';
        }
    }

    static function calcularSaldoTotal($saldo_dia, $saldo_anterior)
    {
        $total_segundos = strtotime($saldo_dia) - strtotime($saldo_anterior);
        list($hora, $minuto, $segundo) = explode(':', self::converterHoras($total_segundos));
        if ($hora > 0 or $minuto>0) {
            return '<span class="text-success">+'.self::converterHoras($total_segundos).'</span>';
        } else {
            $total_segundos = strtotime($horas_cumprir) - strtotime($saldo) ;
            return '<span class="text-danger">-' . self::converterHoras($total_segundos).'</span>';
        }
    }

    static function calcularTotalHoras(array $horas)
    {
        $total_segundos = 0;

        foreach ($horas as $hora) {
            $total_segundos += strtotime($hora);
        }

        return self::converterHoras($total_segundos);
    }

    static function converterHoras($total_segundos)
    {
        $hora = sprintf("%02s",floor($total_segundos / (60*60)));
        $total_segundos = ($total_segundos % (60*60));

        $minuto = sprintf("%02s",floor ($total_segundos / 60 ));
        $total_segundos = ($total_segundos % 60);

        $hora_minuto = $hora.":".$minuto.":00";
        return $hora_minuto;
    }
}