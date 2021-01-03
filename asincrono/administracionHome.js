setTimeout(() => {
    datosIniciales();
}, 300);
function datosIniciales() { 
    $.get("datosAdmHome",
        function (data) {
         console.log(data);
         $('#pacientesRegistrados').html(data[0]+'<span>Pancientes registrados</span> ');   
         $('#usuariosRegistrados').html(data[1]+'<span>Usuarios registrados</span>');   
        }
    );
 }