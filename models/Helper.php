<?php

/**
 * Esta clase contiene métodos genéricos
 *
 * @author blonder413
 */

namespace app\models;

class Helper {

    /**
     * Obtengo los textos limpios para usarlos como url
     * @param String $entra texto
     * @return String texto en formato slug
     */
    public static function limpiaUrl($entra) {
        $traduce = array(
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'n', 'Ñ' => 'N',
            'ä' => 'a', 'ë' => 'e', 'ï' => 'i', 'ö' => 'o', 'ü' => 'u',
            'Ä' => 'A', 'Ë' => 'E', 'Ï' => 'I', 'Ö' => 'O', 'Ü' => 'U'
        );
        $sale = strtr($entra, $traduce);

        $texto = str_replace(" ", "-", $sale);

        $texto = strtolower($texto);

        return $texto;
    }

}
