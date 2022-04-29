function validarDatos(nombreForm) {
    //vienen los formularios comentarios, crearCuenta, ingresarCuenta
    var validar = true;
    var correo = document.getElementById('correo');
    if (/^[a-zA-Z0-9._-]+@[a-zA-Z]+(\.[a-zA-Z]{2,4})+$/.test(correo.value)) {
        //los 3 formularios con el campo en comun
        correo.style.backgroundColor = 'white';
    } else {
        validar = false;
        correo.style.backgroundColor = 'orangered';
    }
    if (nombreForm == 'experiencia' || nombreForm == 'crearCuenta') {
        //2 formularios con campo en comun
        var nombreUser = document.getElementById('nombre');
        if ((nombreUser.value != '') && (/^[a-zA-ZÑñÁáÉéÍíÓóÚú]+$/.test(nombreUser.value))) {
            nombreUser.style.backgroundColor = 'white';
        } else {
            validar = false;
            nombreUser.style.backgroundColor = 'orangered';
        }
        if (nombreForm == 'experiencia') {
            //solo sigo con formulario comentarios
            var nota = document.getElementById('nota');
            var comentario = document.getElementById('comentario');
            if (nota.value == '' || isNaN(nota.value) || nota.value < 1 || nota.value > 10) {
                nota.style.backgroundColor = 'orangered';
                validar = false;
            } else if (nota.style.backgroundColor == 'orangered') {
                nota.style.backgroundColor = 'white';
            }
            if (comentario.value == '' ) {
                comentario.style.backgroundColor = 'orangered';
                validar = false;
            } else {
                comentario.style.backgroundColor = 'white';
            }
            if (validar) {
                crearComentario();
                mostrarSaludo();
                document.getElementById(nombreForm).reset();
                return true;
            }else{
                return false;
            }
            //termina la verificacion de comentarios
        }
        //termina la comparcion de campos en comun
    }
    var pass =document.getElementById('pass');
    if(pass.value.length<8 || pass.value==''){
        pass.style.backgroundColor='orangered';
        validar=false;
    }else{
        pass.style.backgroundColor='white';
    }
    if(nombreForm=='ingresarCuenta'){
        return validar;
    }else{
        var apellido = document.getElementById('apellido');
        if ((apellido.value != '') && (/^[a-zA-ZÑñÁáÉéÍíÓóÚú]+$/.test(apellido.value))){
            apellido.style.backgroundColor='white';
        }else{
            validar = false;
            apellido.style.backgroundColor='orangered';
        }
        var tel = document.getElementById('telefono');
        if(tel.value !='' && (/^[0-9]+$/.test(tel.value)) && tel.value.length>=10){
            tel.style.backgroundColor='white';
        }else{
            validar = false;
            tel.style.backgroundColor = 'orangered';
        }
        var dia = document.getElementById('dia');
        var mes = document.getElementById('mes');
        var anio = document.getElementById('anio');
        var bisiesto = ((anio.value % 4 == 0) && (anio.value % 100 != 0 )) || (anio.value % 400 == 0);
        avisoEdad(anio.value);
        if(anio.value>=1920 && anio.value<=2002){
            anio.style.backgroundColor='white';
        }else{
            validar=false;
            anio.style.backgroundColor='orangered';
        }
        if(mes.value==1 || mes.value==3 || mes.value==5 || mes.value==7 || mes.value==8 || mes.value==10 || mes.value==12){
            mes.style.backgroundColor='white';
            if(dia.value>=1 && dia.value<=31){
                dia.style.backgroundColor='white';
            }else{
                validar=false;
                dia.style.backgroundColor='orangered';
            }
        }else if(mes.value==4 || mes.value==6 || mes.value==9 || mes.value==11){
            mes.style.backgroundColor='white';
            if(dia.value>=1 && dia.value<=30){
                dia.style.backgroundColor='white';
            }else{
                validar=false;
                dia.style.backgroundColor='orangered';
            }
        }else if(mes.value==2){
            mes.style.backgroundColor="white";
            if(dia.value>=1 && dia.value<=28){
                dia.style.backgroundColor='white';
            }else if(bisiesto && dia.value==29){
                dia.style.backgroundColor='white';
            }else{
                dia.style.backgroundColor='orangered';
            }
        }else{
            mes.style.backgroundColor='orangered';
            dia.style.backgroundColor='orangered';
        }
        return validar;
    }
}

function limpiar() {
    var formulario = document.forms[0];
    for (var i = 0; i < (formulario.length - 2); i++) {
        if (formulario[i].style.backgroundColor != 'white') {
            formulario[i].style.backgroundColor = 'white';
        }
        else if (formulario[i].style.backgroundColor != 'white') {
            formulario[i].style.backgroundColor = 'white';
        }
    }
}


function insertAfter(bajarNodo, nuevoPadre) {
    if (bajarNodo.nextSibling) {
        bajarNodo.parentNode.insertBefore(nuevoPadre, bajarNodo.nextSibling);
    } else {
        bajarNodo.parentNode.appendChild(nuevoPadre);
    }
}


function crearComentario() {
    var newComentario = document.createElement("div");
    var hora = new Date();
    newComentario.innerText = "Nombre: " + document.getElementById('nombre').value + "\n" +
        "Correo: " + document.getElementById('correo').value + "\n" +
        "Calificacion: " + document.getElementById('nota').value + "\n" +
        "Comentario: " + document.getElementById('comentario').value + "\n" +
        "Conectado por: " + navigator.userAgent + "\nA las " + hora.getHours() + ":" + hora.getMinutes() + " Hs\n";
    newComentario.style.fontSize = 20 + "px";
    newComentario.style.fontStyle = 'Times new Roman';
    newComentario.style.border = "2px solid black";
    if ((parseInt(document.getElementById('nota').value)) < 4) {
        newComentario.style.backgroundColor = '#c02020';
    } else if ((parseInt(document.getElementById('nota').value)) < 7) {
        newComentario.style.backgroundColor = '#ffff60';
    } else if ((parseInt(document.getElementById('nota').value)) <= 10) {
        newComentario.style.backgroundColor = '#008000';
    }
    var acumComentarios = document.getElementById('experiencia');
    insertAfter(acumComentarios, newComentario);
}

function avisoEdad(anio){
    if(anio>2002){
        document.getElementById('edad').style.fontStyle='red';
        document.getElementById('edad').style.display="block";
    }else if(anio==null || anio<=2002){
        document.getElementById('edad').style.display='none';
    }
}

function ocultarSaludo() {
    document.getElementById('despedida').style.display = "none";
}

function mostrarSaludo() {
    document.getElementById('despedida').style.display = "block";
}

function validarPedido(nombreForm) {
    switch (nombreForm) {
        case 'sushi':
            var formulario = document.getElementById('sushi');
            var i = 0;
            while (i < (formulario.length - 2)) {
                //longitud-2 xq tambien leeria los botones
                if (formulario[i].checked && formulario[1].value != '0') {
                    var cantidad = parseInt(formulario[1].value);
                    var nombreSushi = formulario[i].value;
                    if (nombreSushi == 'maki') {
                        var precio = ((cantidad) / 8) * 230;
                    } else if (nombreSushi == 'chirashi') {
                        var precio = ((cantidad) / 8) * 250;
                    } else if (nombreSushi == 'temaki') {
                        var precio = ((cantidad) / 8) * 270;
                    } else if (nombreSushi == 'nirigi') {
                        var precio = ((cantidad) / 8) * 300;
                    }
                    return cargarPedido(nombreForm, nombreSushi, cantidad, precio);
                }
                i++;
            }
            break;
        case 'completo':
            var formulario = document.getElementById('completo');
            var i = 0;
            while (i < (formulario.length - 2)) {
                if (formulario[i].checked && formulario[1].value != '0') {
                    var nombreDelCompleto = formulario[i].value;
                    var cantidad = parseInt(formulario[1].value);
                    if (nombreDelCompleto == 'mediano') {
                        var precio = cantidad * 200;
                        nombreDelCompleto = 'Completo ' + nombreDelCompleto
                    } else if (nombreDelCompleto == 'grande') {
                        var precio = cantidad * 250;
                        nombreDelCompleto = 'Completo ' + nombreDelCompleto
                    } else if (nombreDelCompleto == 'chucrut') {
                        var precio = cantidad * 280;
                        nombreDelCompleto = 'Completo de ' + nombreDelCompleto
                    } else if (nombreDelCompleto == 'completisimo') {
                        var precio = cantidad * 300;
                        nombreDelCompleto = 'Completo ' + nombreDelCompleto
                    }
                    return cargarPedido(nombreForm, nombreDelCompleto, cantidad, precio);
                } else if (formulario[1].value == '0') {
                }
                i++;
            }
            break;
        case 'empanadas':
            var formulario = document.getElementById('empanadas');
            var i = 0;
            while (i < (formulario.length - 2)) {
                if (formulario[i].checked && formulario[1].value != '0') {
                    var nombreEmpanada = formulario[i].value;
                    var cantidad = parseFloat(formulario[1].value);
                    if (nombreEmpanada == 'arabes') {
                        var precio = cantidad * 300;
                    } else if (nombreEmpanada == 'picada a cuchillo') {
                        var precio = cantidad * 350;
                    } else if (nombreEmpanada == 'jamon y queso') {
                        var precio = cantidad * 280;
                    } else if (nombreEmpanada == 'humitas') {
                        var precio = cantidad * 280;
                    }
                    return cargarPedido(nombreForm, nombreEmpanada, cantidad, precio);
                }
                i++;
            }
            break;
        case 'tablaCompartir':
            var formulario = document.getElementById('tablaCompartir');
            var i = 0;
            if (formulario[0].checked) {
                return cargarPedido(nombreForm, '', '2', '350');
            } else if (formulario[1].checked) {
                return cargarPedido(nombreForm, '', '4', '600');
            }
            break;
        case 'fideosVerduras':
            var formulario = document.getElementById('fideosVerduras');
            return cargarPedido(nombreForm, '', '', '250');
        case 'sorrentinos':
            var formulario = document.getElementById('sorrentinos');
            var i = 0;
            var masa = '';
            var relleno = '';
            var precio = 0;
            while (i < (formulario.length - 2)) {
                if (formulario[i].checked) {
                    if (formulario[i].value == 'comun' || formulario[i].value == 'zanahoria' || formulario[i].value == 'remolacha') {
                        masa = formulario[i].value;
                    } else {
                        relleno = formulario[i].value;
                        if (relleno == 'pollo y verduras') {
                            precio = 230;
                        } else if (relleno == 'jamon y queso') {
                            precio = 250;
                        } else {
                            precio = 300;
                        }
                    }
                } if (masa != '' && relleno != '') {
                    return cargarPedido('sorrentinos',  relleno + ' masa: ' + masa, '', precio);
                }
                i++;
            }
            break;
        case 'peruana':
            var formulario = document.getElementById('peruana');
            return cargarPedido(nombreForm, '', '', '350');
        case 'milanesa':
            var formulario = document.getElementById('milanesa');
            return cargarPedido(nombreForm, '', '', '400');
    }
    return false;
}

function cargarPedido(nameForm, variedad, cantidad, costo) {
    var tabla = document.getElementById('anotador');
    var filas = tabla.insertRow(tabla.rows.length);
    var borra = filas.insertCell(0);
    var desc = filas.insertCell(1);
    var cost = filas.insertCell(2);
    
    switch (nameForm) {
        case 'sushi':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = variedad + " " + cantidad + " de piezas $";
            cost.innerHTML = costo;
            break;
        case 'completo':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = cantidad + " " + variedad + " $";
            cost.innerHTML = costo;
            break;
        case 'empanadas':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = cantidad + " Docenas de " + variedad + " $";
            cost.innerHTML = costo;
            break;
        case 'tablaCompartir':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = "Tabla para " + cantidad + " personas $";
            cost.innerHTML = costo;
            break;
        case 'fideosVerduras':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = "Fideos con masa de verduras $ ";
            cost.innerHTML = costo;
            break;
        case 'sorrentinos':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = "Sorrentinos " + variedad + " $";
            cost.innerHTML = costo;
            break;
        case 'peruana':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = "Plato de comida peruana $";
            cost.innerHTML = costo;
            break;
        case 'milanesa':
            borra.innerHTML = "<a href='#' onclick='borrarFila(this.parentNode.parentNode.rowIndex)'>X</a>";
            desc.innerHTML = "Plato de milanesa $";
            cost.innerHTML = costo;
            break;
    }
    var total = document.getElementById('saldoTotal');
    total.value = parseInt(total.value) + parseInt(costo) ;
    document.getElementById(nameForm).reset();
    return true;
}

function borrarFila(numFilas) {
    var tabla = document.getElementById('anotador');
    tabla.deleteRow(numFilas);
}

function pagar() {
    window.location = "ingresarCuenta.html";
}
