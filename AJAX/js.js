
let botonInsertar= document.getElementById('botonNuevaTarea');

botonInsertar.addEventListener('click',function (){

    //Muestro el preloader
    document.getElementById('preloaderInsertar').style.visibility='visible';

    //Envío datos mediante POST a insertar.php construyendo un FormData 
    const datos = new FormData();
    datos.append('texto', document.getElementById('nuevaTarea').value);

    const options ={
        method: "POST",
        body: datos
    };

    fetch('insertar.php', options)
    .then( respuesta =>{
        return respuesta.json(); //la conexión ha finalizado con éxito
    })
    .then(tarea => {
        console.log(tarea);

        let capaTarea = document.createElement('div');
        capaTarea.classList.add('tarea');

        let capaTexto = document.createElement('div');
        capaTexto.classList.add('texto');
        capaTexto.innerHTML= tarea.texto;

        let papelera = document.createElement('i');
        papelera.classList.add('fa-solid','fa-trash','papelera');
        papelera.setAttribute("data-idTarea",tarea.id);

        var preloader = document.createElement('img');
        preloader.setAttribute('src','preload.gif');
        preloader.classList.add('preloaderBorrar');


        capaTarea.appendChild(capaTexto);
        capaTarea.appendChild(papelera);
        capaTarea.appendChild(preloader);


        document.getElementById('tareas').appendChild(capaTarea);

        //Añadir manejador de evento Borrar a la nueva papelera
        papelera.addEventListener('click',manejadorBorrar)

    })
    .finally(function(){
        //ocultar el preloader
        document.getElementById('preloaderInsertar').style.visibility='hidden';
    })
});

   
let papeleras = document.querySelectorAll('.papelera');
papeleras.forEach(papelera => {
    papelera.addEventListener('click', manejadorBorrar);
});

console.log(papeleras);

function manejadorBorrar(){
    //this referencia al elemento del DOM sobre el que hemos hecho click
    let idTarea = this.getAttribute('data-idTarea');

    // Mostrar el preloader
    let preloader = this.parentElement.querySelector('img');
    preloader.style.visibility="visible"; //muestra el gift
    this.style.visibility='hidden'; //oculta la papelera

    //Llamamos al script del servidor que borra la tarea pasándole el idTarea como parámetro
    fetch('borrar.php?id=' +idTarea)
    .then(datos => datos.json())
    .then(respuesta => {
       if(respuesta.respuesta=='ok'){
        this.parentElement.remove();
       }else{
            alert('No se ha encontrado la tarea en el  servidor');
        this.style.visibility='visible';
       }
    })
    .finally(function(){
            // Ocultar el preloader
            preloader.style.visibility = 'hidden';
            this.style.visibility = 'visible';
    })
}



