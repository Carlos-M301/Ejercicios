<?php
    /* 
    Eres un biólogo que examina secuencias de ADN de formas de vida diferentes.
    Se te darán dos secuencias de ADN, y el objetivo es encontrar el conjunto ordenado de
    bases adyacentes de mayor tamaño que es común en ambos ADNs.
    Las secuencias de ADN se darán como conjuntos ordenados de bases de
    nucleótidos: adenina (abreviado A), citosina (C), guanina (G) y timina (T):
    ATGTCTTCCTCGA TGCTTCCTATGAC
    Para el ejemplo anterior, el resultado es CTTCCT porque que es el conjunto
    ordenado de bases adyacentes de mayor tamaño que se encuentra en ambas formas de
    vida.

    Ejemplos.

    ATGTCTTCCTCGA TGCTTCCTATGAC
    ctgactga actgagc
    cgtaattgcgat cgtacagtagc
    ctgggccttgaggaaaactg gtaccagtactgatagt
    
    
    Salida de la muestra
    CTTCCT
    actga
    cgta
    actg
    

    ------------------------------------------------------------------------
    
    Mis respuestas
    
    Casi #0: cttcct
    Casi #1: actga
    Casi #2: cgta
    Casi #3: actg

    */

    $secuenciasADN = $_POST['conjuntos'];
    //$secuenciasADN[0] = "ATGTCTTCCTCGA TGCTTCCTATGAC";  
    //$secuenciasADN[1] = "ctgactga actgagc";
    //$secuenciasADN[2] = "cgtaattgcgat cgtacagtagc";
    //$secuenciasADN[3] = "ctgggccttgaggaaaactg gtaccagtactgatagt";


    function getConjuntoOrdenado($arreglo){
        $respuesta = array();
        for($i = 0; $i < count($arreglo); $i++){
           $respuesta[$i] = "Caso #".($i+1).": ".mayorLongitudConjunto($arreglo[$i])."<br>";
            
        }
        return $respuesta;
    }

    function mayorLongitudConjunto($arreglo){
        $cadenaMayor = "";
        $cadenaActual = "";
        $cadenas = separarCadenas($arreglo);
        for ($i=0; $i < strlen($cadenas[0]); $i++) {
            $valorI = $i;
            for ($j=0; $j < strlen($cadenas[1]); $j++) { 
                if($cadenas[0][$valorI] === $cadenas[1][$j]){
                    $cadenaActual = $cadenaActual.$cadenas[0][$valorI];
                    $valorI++;
                }
                else{
                    $valorI = $i;
                    if(strlen($cadenaActual) > strlen($cadenaMayor))
                        $cadenaMayor = $cadenaActual;
                    $cadenaActual = "";
                }
            }
            
        }
        return $cadenaMayor;
    }

    function separarCadenas($cadena){
        $j=0;
        $nuevo = "";
        $arreglo = array("","");
        for ($i=0; $i <= strlen($cadena); $i++)  { 
            if($cadena[$i][0] === " " || $i === strlen($cadena)){
                $arreglo[$j] = strtolower($nuevo);
                $j++;
                $nuevo = "";
            }
            else{
                $nuevo = $nuevo.$cadena[$i][0];
            }
        }
        return $arreglo;
    }

    //Se ejecuta la función.
        echo json_encode(getConjuntoOrdenado($secuenciasADN));
?>