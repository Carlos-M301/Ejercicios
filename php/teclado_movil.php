<?php

    /* Teclado
    0 -> Espace
    1 -> nada
    2 -> A B C
    3 -> D E F
    4 -> G H I
    5 -> J K L
    6 -> M N O
    7 -> P Q R S
    8 -> T U V
    9 -> W X Y Z
    */

    /*
    Para introducir una secuencia de dos caracteres a partir de la misma tecla,
    el usuario debe hacer una pausa antes de pulsar el botón una segunda vez. Por ejemplo, 2 2 indica
    AA mientras que 22 indica B (se muestra un "carácter de espacio" para indicar una pausa).
    N -> Casos de prueba
        Entrada
        4
        hi
        yes
        foo bar
        hello world
        Salida
        Caso #1: 44 444
        Caso #2: 999337777
        Caso #3: 333666 6660 022 2777 ¿Por qué hay dos ceros(espacios) sí en la palabra solo hay uno?
        Caso #4: 4433555 555666096667775553

        Mis respuestas

        Caso #1: 44 444
        Caso #2: 999337777
        Caso #3: 333666 666022 2777
        Caso #4: 4433555 555666096667775553
    */

    $mensajes = $_POST['cadenas'];
    
    function main($mensajes){
        $respuestas = array();
        for($i=0;$i <= count($mensajes)-1 ; $i++){
            $combinacion = "";
            for($j=0;$j <= strlen($mensajes[$i])-1 ; $j++){
                $cadena = obtenerNumero(strtolower($mensajes[$i][$j]));
                    if(substr($combinacion,-1) == substr($cadena,-1) || substr($combinacion,-2,-1) == substr($cadena,-1)){
                        $combinacion = $combinacion." ".$cadena;
                    }
                    else{
                        $combinacion = $combinacion.$cadena;
                    }
                
            }
            $respuestas[$i] = "Caso #".($i+1).": ".$combinacion."<br>";
        }
        return $respuestas;
    }

    function obtenerNumero($msjcaracter){
        $teclado = array(
            "2" => array("a","b","c"),
            "3" => array("d","e","f"),
            "4" => array("g","h","i"),
            "5" => array("j","k","l"),
            "6" => array("m","n","o"),
            "7" => array("p","q","r","s"),
            "8" => array("t","u","v"),
            "9" => array("w","x","y","z"),
            "0" => array(" "),
        );
        foreach($teclado as $tecla => $caracteres){
            $contador = 0;
            foreach($caracteres as $caracter){
                $contador++;
                if($msjcaracter == $caracter){
                    if($contador > 1)
                        return repetirNumero($tecla,$contador);
                    else 
                        return $tecla;
                }
            }
        }

    }

    function repetirNumero($tecla, $repeticion){
        $comb = "";
        for($i=0; $i < $repeticion; $i++){
            $comb = $comb.$tecla;
        }
        return $comb;
    }
    
    echo json_encode(main($mensajes));

?>
