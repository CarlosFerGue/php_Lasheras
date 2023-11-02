
function cargarUnScript(url){
    let script= document.createElement('script'); //creamos un script
    script.src = url;  //le pasamos el sript con la otra funcion
    document.head.appendChild(script); //y ponemos ese script en el <header>
}


//Construimos la url de la pagina que vamos a  cargar con esta funcion
function getVistaMenuSeleccionado(controlador, metodo){
    let opciones={method: "GET"};
    let parametros= "controlador="+controlador+"&metodo="+metodo;
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('respuesta ok');
                return res.text();
            }
        })
        .then(vista=>{
            document.getElementById("secContenidoPagina").innerHTML=vista;
            cargarUnScript('js/'+controlador+'.js');
        })
        .catch(err=>{
            console.log("Error al realizar la petición", err.message);
        });

}