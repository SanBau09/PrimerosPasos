
let botonInsertar= document.getElementById('botonNuevaTarea');

//document.querySelector('.papelera')

botonInsertar.addEventListener('click',function (){
    //Muestro el preloader
    document.getElementById('preloaderInsertar').style.visibility='visible';

    //Envío datos mediante POST a insertar.php construyendo un FormData
    const datos = new FormData();
    datos.append('texto',document.getElementById('nuevaTarea').value);
    
    const options = {
        method: "POST",
        body: datos
      };
    
    fetch('index.php?accion=insertar_tarea', options)
    .then( respuesta => {
        return respuesta.json();
    })
    .then(tarea => {
        //Añado la la tarea al div "tareas" modificando el DOM
        var capaTarea = document.createElement('div');
        var capaTexto = document.createElement('div');
        var imagen = document.createElement('img');
        var papelera = document.createElement('i');
        var check = document.createElement('i');
        var mostrarEditar = document.createElement('i');
        var preloader = document.createElement('img');

        capaTarea.classList.add('tarea');
        capaTexto.classList.add('texto');
        capaTexto.id="cajaTexto";
        capaTexto.innerHTML=tarea.texto;

        imagen.id="imagenTarea"; 
        imagen.classList.add('imagenTarea');
        imagen.style.display = "none";

        papelera.classList.add('fa-solid', 'fa-trash', 'papelera');
        papelera.setAttribute("data-idTarea",tarea.id);

        check.classList.add('fa-solid', 'fa-circle-check', 'check');
        check.setAttribute("data-idTarea",tarea.id);

        mostrarEditar.classList.add('fa-solid', 'fa-pen', 'elemEdit');
        mostrarEditar.setAttribute("data-idTarea",tarea.id);
        mostrarEditar.setAttribute("data-texto",tarea.texto);
        mostrarEditar.id="btnElemEdit";

        preloader.setAttribute('src','web/images/preloader.gif');
        preloader.classList.add('preloaderBorrar');
        
        capaTarea.appendChild(capaTexto);
        capaTarea.appendChild(imagen);
        capaTarea.appendChild(papelera);
        capaTarea.appendChild(check);
        capaTarea.appendChild(mostrarEditar);
        capaTarea.appendChild(preloader);
        document.getElementById('tareas').appendChild(capaTarea);

        //Añadir manejador de evento Borrar a la nueva papelera
        papelera.addEventListener('click',manejadorBorrar);

        //Añadir manejador de evento Check al nuevo check IMPORTANTEEEE
        check.addEventListener('click',manejadorTareaRealizada);

        //Añadir manejador de evento Editar al nuevo editar IMPORTANTEEEE
        mostrarEditar.addEventListener('click',manejadorElementosEditar);

        //Borro el contenido del input
        document.getElementById('nuevaTarea').value='';
    })
    .finally(function(){
        //Ocultamos el preloader
        document.getElementById('preloaderInsertar').style.visibility='hidden';
    });
    
});

let papeleras = document.querySelectorAll('.papelera');
papeleras.forEach(papelera => {
    papelera.addEventListener('click',manejadorBorrar);
});

let checks = document.querySelectorAll('.check');
checks.forEach(check => {
    check.addEventListener('click',manejadorTareaRealizada);
});

let elementosEditar = document.querySelectorAll('.elemEdit');
elementosEditar.forEach(elemEdit => {
    elemEdit.addEventListener('click',manejadorElementosEditar);
});

let cancelarEditar = document.getElementById('botonCancelarEditar');
cancelarEditar.addEventListener('click',manejadorCancelarEditar);

let aceptarEditar = document.getElementById('botonAceptarEditar');
aceptarEditar.addEventListener('click',manejadorAceptarEditar);

    
function manejadorBorrar(){
    //this referencia al elementos del DOM sobre el que hemos hecho click
    let idTarea = this.getAttribute('data-idTarea');
    //Mostramos preloader
    let preloader = this.parentElement.querySelector('img');
    preloader.style.visibility="visible";
    this.style.visibility='hidden';
    //Llamamos al script del servidor que borra la tarea, pasándole la accion borrar_tarea del index y el idTarea como parámetro con &
    fetch('index.php?accion=borrar_tarea&idTarea='+idTarea)
    .then(datos => datos.json())
    .then(respuesta =>{
        if(respuesta.respuesta=='ok'){
            this.parentElement.remove();
        }
        else{
            alert(respuesta.mensaje);
            this.style.visibility='visible';
        }
    })
    .finally(function(){
        //Ocultamos preloader
        preloader.style.visibility="hidden";        
    });
}

function manejadorTareaRealizada(){
    //this referencia al elementos del DOM sobre el que hemos hecho click
    // Obtener el ID de la tarea
    let idTarea = this.getAttribute('data-idTarea');

    fetch('index.php?accion=tarea_realizada&idTarea=' + idTarea)
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Error al marcar la tarea como realizada');
        })
        .then(data => {
            console.log('Tarea marcada como realizada:', data.respuesta); //data lleva el print

            let tareaElement = document.querySelector(`[data-idTarea="${idTarea}"]`);
            if (tareaElement) {
                // Cambiar clase para indicar tarea realizada
                //tareaElement.classList.remove('tarea-pendiente');
                //tareaElement.parentNode.classList.add('tarea-realizada'); //parentNode para que coja el padre Tarea
                tareaElement.parentNode.classList.toggle('tarea-realizada'); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function manejadorElementosEditar(){

        // Primero oculto el contenedor de tareas
        var tareas = document.getElementById('contenedorTareas');
        tareas.style.display="none";

        //cargar los datos de la tarea y del texto
        //por motivos de seguridad las fotos no sse pueden precargar desde el cliente
        let idTarea = this.getAttribute('data-idTarea');
        let texto = this.getAttribute('data-texto');

        //obtengo los campos para asignar los valores
        let textoNuevo = document.getElementById('editarTexto');
        let idTareaOculta = document.getElementById('campoIdTarea');
        // Se guarda el valor del id Tarea en un campo oculto para después poder ser utilizado al pulsar el botón de Aceptar
        idTareaOculta.innerHTML = idTarea;

        //se le asignan los valores que vienen de las tarea creada
        textoNuevo.value = texto;       

        //mostrar el div para editar
        var editarTarea = document.getElementById('contenedorEditar');
        editarTarea.style.visibility="visible";
        editarTarea.style.display="block";

    }

    function manejadorCancelarEditar(){
        
        // Primero oculto el div para editar
        var editarTarea = document.getElementById('contenedorEditar');
        editarTarea.style.display="none";
        
        //mostrar el contenedor de tareas
        var tareas = document.getElementById('contenedorTareas');
        tareas.style.display="block";
    }

    function manejadorAceptarEditar(){
        //obtener id de la tarea a editar
        let idTarea = document.getElementById('campoIdTarea').innerHTML;
        //obtener el valor del texto nuevo
        let valorNuevoTexto = document.getElementById('editarTexto').value;
        //obtener el valor de la foto 
        let arrayFotos = document.getElementById('editarFoto').files;
        let formData = new FormData();

        if (arrayFotos != null && arrayFotos.length > 0){
            formData.append('fotoTarea',arrayFotos[0]);
        }

        // Ahora se llama al manejador para que haga el update de los nuevos valores en la base de datos
        fetch('index.php?accion=editar_tarea&idTarea=' + idTarea + '&textoTarea=' + valorNuevoTexto, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Error editar la tarea');
        })
        .then(data => {
            console.log('Tarea marcada editada:', data.respuesta); //data lleva el print

            // Se resetea el selector de imágenes
            document.getElementById('editarFoto').value = '';

            let tareaElement = document.querySelector(`[data-idTarea="${idTarea}"]`);
            if (tareaElement) {
                // Se actualizan los datos de la lista con los datos editados
                tareaElement.parentNode.children["cajaTexto"].innerHTML = data.texto;
                tareaElement.parentNode.children["imagenTarea"].src = "web/fotoTarea/" + data.foto;
                tareaElement.parentNode.children["imagenTarea"].style = "block";
                tareaElement.parentNode.children["btnElemEdit"].setAttribute("data-texto",data.texto);
                // Se vuelve a mostrar la lista
                manejadorCancelarEditar();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

