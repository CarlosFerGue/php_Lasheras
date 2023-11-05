
function buscarUsuarios(){
    let opciones={method: "GET"};
    let parametros= "controlador=Usuarios&metodo=buscarUsuarios";
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();
    
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('respuesta ok User');
                return res.text();
            }
        })
        .then(vista=>{
            document.getElementById("CapaResultadoBusqueda").innerHTML=vista;
        })
        .catch(err=>{
            console.log("Error al realizar la petición", err.message);
        });
}

function buscarTelefono(){
    let opciones={method: "GET"};
    let parametros= "controlador=Usuarios&metodo=buscarTelefono";
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('respuesta ok Telefono');
                return res.text();
            }
        })
        .then(vista=>{
            document.getElementById("CapaResultadoBusqueda").innerHTML=vista;
        })
        .catch(err=>{
            console.log("Error al realizar la petición", err.message);
        });
}