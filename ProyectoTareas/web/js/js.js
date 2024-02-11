
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
        var papelera = document.createElement('i');
        var check = document.createElement('i');
        var editar = document.createElement('i');
        var preloader = document.createElement('img');

        capaTarea.classList.add('tarea');
        capaTexto.classList.add('texto');
        capaTexto.innerHTML=tarea.texto;

        papelera.classList.add('fa-solid', 'fa-trash', 'papelera');
        papelera.setAttribute("data-idTarea",tarea.id);

        check.classList.add('fa-solid', 'fa-circle-check', 'check');
        check.setAttribute("data-idTarea",tarea.id);

        editar.classList.add('fa-solid', 'fa-pen', 'edit');
        editar.setAttribute("data-idTarea",tarea.id);

        preloader.setAttribute('src','web/images/preloader.gif');
        preloader.classList.add('preloaderBorrar');
        
        capaTarea.appendChild(capaTexto);
        capaTarea.appendChild(papelera);
        capaTarea.appendChild(check);
        capaTarea.appendChild(editar);
        capaTarea.appendChild(preloader);
        document.getElementById('tareas').appendChild(capaTarea);

        //Añadir manejador de evento Borrar a la nueva papelera
        papelera.addEventListener('click',manejadorBorrar);

        //Añadir manejador de evento Check al nuevo check IMPORTANTEEEE
        check.addEventListener('click',manejadorTareaRealizada);

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
        this.style.visibility='visible';
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

    function manejadorEditar(){
        
    }

