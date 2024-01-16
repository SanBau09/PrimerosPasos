
let botonInsertar= document.getElementById('botonNuevaTarea');

botonInsertar.addEventListener('click',function (){

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
        papelera.classList.add('fa-solid fa-trash papelera');

        capaTarea.appendChild(capaTexto);
        capaTarea.appendChild(papelera);

        document.getElementById('tareas').appendChild(capaTarea);

    })
    .catch(function(){
        //Se ejecuta si hay error de conexión
        console.log("Error de conexion con insertar.php");
    });
    console.log("Esto está debajo del fetch");
});



