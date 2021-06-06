const biologo = document.querySelector('#biologo');
const movil = document.querySelector('#movil');
const inputsM = document.getElementById('inputsExc1');
const inputsB = document.getElementById('inputsExc2');
const buttonM = document.getElementById('btnM');
const buttonB = document.getElementById('btnB');
const buttonMR = document.getElementById('btnMR');
const buttonBR = document.getElementById('btnBR');
const showinputM = document.getElementById('inputsM');
const showinputB = document.getElementById('inputsB');

//Events

biologo.addEventListener('keypress',function(e){
    if(e.keyCode == 13){
        var abs = Math.abs(biologo.value);
        if( abs <= 10){
            var b = [abs,1];
            generateInputs(b);
        }
        else
            alert("Solo piede ingresar 10 conjuntos")
    }
});

movil.addEventListener('keypress',function(e){
    if(e.keyCode == 13){
        var abs = Math.abs(movil.value);
        if( abs <= 10){
            var m = [abs,0];
            generateInputs(m);
        }
        else
            alert("Solo piede ingresar 10 cadenas de texto");
    }
});

//Functions

function generateInputs(array){
    const iM = document.getElementById('movil0');
    const iB = document.getElementById('biologo0');
    if(array[1] == 0){
        id = "movil";
        container = showinputM;
        btn = buttonM;
        btnr = buttonMR;
    }
    else{
        id = "biologo";
        container = showinputB;
        btn = buttonB;
        btnr = buttonBR;
    }
    console.log('aqui');
    if(iM == null && iB == null){
        for(i = 0 ; i < array[0]; i++){
            var label = document.createElement('label');
            label.innerHTML = "Caso "+(i+1);
            label.setAttribute("class", "case");
            container.appendChild(label);
            container.appendChild(document.createElement('br'));
            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("id", id+i);
            input.setAttribute("class", "case");
            input.required = true;
            container.appendChild(input);
            container.appendChild(document.createElement('br'));
        }
        btn.style.display = 'block';
        btnr.style.display = 'block';
        container.appendChild(document.createElement('hr'));
    }
    else{
        alert('Ya tienes creado unas entradas, clic en el botón limpiar en el respectivo ejercicio para poder realizar esta acción');
    }
    
}

buttonMR.addEventListener("click",()=>{
    btnLimpiar(1);
});
buttonBR.addEventListener("click",()=>{
    btnLimpiar(2);
});

function btnLimpiar(problema){
    if(problema === 1){
        i = showinputM;
        btn = buttonM;
        btnr = buttonMR;
    }
    else{
        i = showinputB;
        btn = buttonB;
        btnr = buttonBR;
    }
    i.innerHTML = '';
    btn.style.display = 'none';
    btnr.style.display = 'none';
    limpiarCasos(problema);

}


function limpiarCasos(problema){
    if(problema === 1){
        document.getElementById('respuestasM').innerHTML = '';
    }
    else{
        document.getElementById('respuestasB').innerHTML = '';
    }
} 
// Ajax 
//Problema 1
$('#inputsExc1').submit(function(e){
    e.preventDefault();
    var arreglo = [];
    for(i = 0; i <  movil.value; i++){
        arreglo[i] = $('#movil'+i).val();
    }
    $.ajax({
        type: "POST",
        url: "../php/teclado_movil.php",
        data: {cadenas : arreglo},
        success: function (response) {
            var casos = JSON.parse(response);
            limpiarCasos(1);
            for(i = 0; i < casos.length; i++){
                $('#respuestasM').append(
                    '<p>'+ casos[i] +'</p>'
                );
            }
        }
    });
});

//Problema 2
$('#inputsExc2').submit(function(e){
    e.preventDefault();
    var arreglo = [];
    for(i = 0; i <  biologo.value; i++){
        arreglo[i] = $('#biologo'+i).val();
    }
    $.ajax({
        type: "POST",
        url: "../php/el_biologo.php",
        data: {conjuntos : arreglo},
        success: function (response) {
            var casos = JSON.parse(response);
            limpiarCasos(2);
            for(i = 0; i < casos.length; i++){
                $('#respuestasB').append(
                    '<p>'+ casos[i] +'</p>'
                );
            }
        }
    });
});

