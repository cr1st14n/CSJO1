<!DOCTYPE html>
<html>
<head>
	<title></title>

<font size=3 color=black>


	

</head>
<body>
	45465
	<table border=0 cellpadding=0 cellspacing=0>

<tr>
<td id="Fecha_Reloj"></td>

</tr>
</table>
</font>

<script language="JavaScript">
/* Coeminza el script del Reloj */
function actualizaReloj(){ 

/* Capturamos la Hora, los minutos y los segundos */
marcacion = new Date() 
/* Capturamos la Hora */
Hora = marcacion.getHours() 
/* Capturamos los Minutos */
Minutos = marcacion.getMinutes() 
/* Capturamos los Segundos */
Segundos = marcacion.getSeconds() 
/* Si la Hora, los Minutos o los Segundos son Menores o igual a 9, le añadimos un 0 */
if (Hora<=9)
Hora = "0" + Hora
if (Minutos<=9)
Minutos = "0" + Minutos
if (Segundos<=9)
Segundos = "0" + Segundos
/* Termina el Script del Reloj */

/* Creamos 4 variables para darle formato a nuestro Script */
var Inicio, Script, Final, Total

/*En Inicio le indicamos un color de fuente  y un tamaño */
Inicio = "<font size=3 color=black>"

/* En Reloj le indicamos la Hora, los Minutos y los Segundos */
Script = Hora + ":" + Minutos + ":" + Segundos

/* En final cerramos el tag de la fuente */
Final = "</font>"

/* En total Finalizamos el Reloj uniendo las variables */
Total = Inicio + Script + Final

/* Capturamos una celda para mostrar el Reloj */
document.getElementById('Fecha_Reloj').innerHTML = Total

/* Indicamos que nos refresque el Reloj cada 1 segundo */
setTimeout("actualizaReloj()",1000) 
}
</script>
</body>

</html>