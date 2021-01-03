setTimeout("cargarNotas()",100);
$(function () {
    // --- activadores en los buttons ----//
    $('#btnNota').on('click', registrarNota);
    $('#btnNotaFiltrar').on('click', showModalFiltroNotas);
    $('#btnNotaActualizar').on('click',notaActualizar);
    //---- ejecucion al cargar la pagina ---//
    cargarPrestamos();
});
    function formDate(fecha) {
        var fecha=moment(fecha, "YYYY/MM/DD HH:mm:ss").format('DD/MM/YYYY HH:mm');
        return fecha;
    }
    function listPrestamos(data) {
        var html=data.map(function (elem,index) {
            return(`<tr>
			          <td>${elem.pa_hcl}</td>
			          <td>${elem.pa_nombre} ${elem.pa_apmaterno} ${elem.pa_appaterno}</td>
			          <td>${elem.prest_usuEntrega} ${elem.prest_area}</td>
			          <td>${formDate(elem.created_at)}</td>
			          <td>
                                <span class="tooltip-area">
                                <button onclick="prestEdit(${elem.id})" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                <button onclick="prestEliminar(${elem.id})" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                </span>
                            </td>
		   	        </tr>`);
        }).join(" ");
        document.getElementById('tablaPrestamos').innerHTML=html;
    }
    function cargarPrestamos() {
        $.get('/C.S.J.O.bo/Recepcion/PresHCL/list/', function (prest) {
            listPrestamos(prest);
        }).fail(function () {
            alert("Error recargue la pagina");
        });
    }
    function cargarNotas(){
         var User = document.getElementById('UsuarioCI').value;
        $.get('/C.S.J.O.bo/api/listNotasDelDia/'+User+'', function (listNotas) {
            $('#tableNotas').html("");
            for (var i = 0; i < listNotas.length; i++) {
                var tr = `<tr>
                          <td> N-` + listNotas[i].id + `</td>
                          <td>` + listNotas[i].rn_nota + `</td>
                          <td>` + listNotas[i].rn_fecha + `</td>
                          <td>
                                    <span class="tooltip-area">
                                    <button onclick="notaEdit(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                    <button onclick="notaEliminar(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                    </span>
                                </td>
                        </tr>`;
                $("#tableNotas").append(tr);
            }
        });
    }
    function registrarNota() {
        var nota = document.getElementById('notaText').value;
        if (nota == null || nota.length == 0 || /^\s+$/.test(nota)){
            var data = new Array();
            data.verticalEdge='right';
            data.horizontalEdge='top';
            data.theme = "primary";
            setTimeout(function () { $.notific8('Error, Texto en blanco.',data) });
        } else{
            var url = "/C.S.J.O.bo/Recepcion/Notas/create";
            var data= {'_token': $('meta[name=csrf-token]').attr('content'),
                        'nota':nota ,
                        'last name':"tiene control"};
            $.post(url,data).done(function (listNotas) {
                if (listNotas != "error"){
                    var data = new Array();
                    data.verticalEdge='right';
                    data.horizontalEdge='top';
                    data.theme = "success";
                    setTimeout(function () { $.notific8('Nota creada exitosamente.',data) });
                    //setTimeout(function () { $.notific8('jeje esta seria la notificaion.') }, 2000);
                    document.getElementById('notaText').value = "";

                    $("#tableNotas").html("");
                    for (var i = 0; i < listNotas.length; i++) {
                        var tr = `<tr>
                          <td> N-`+listNotas[i].id+`</td>
                          <td>`+listNotas[i].rn_nota+`</td>
                          <td>`+listNotas[i].rn_fecha+`</td>
                          <td>
                                    <span class="tooltip-area">
                                    <button onclick="notaEdit(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                    <button onclick="notaEliminar(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                    </span>
                                </td>
                        </tr>`;
                        $("#tableNotas").append(tr);

                    }
                }else{
                    var data = new Array();
                    data.verticalEdge='right';
                    data.horizontalEdge='top';
                    data.theme = "danger";
                    setTimeout(function () { $.notific8('Error, vuelva a intentarlo.',data) });
                }
            }).fail(function () {
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "danger";
                setTimeout(function () { $.notific8('Error, vuelva a intentarlo.',data) });
            });
        }
    }
// ---------------funcion para modificar nota
    function notaEdit(x) {
        $("#md-editNota").attr('class','modal fade').addClass('md-flipHor').modal('show');
        $.get('/C.S.J.O.bo/api/buscNota/'+x+'',function (nota){
            document.getElementById('notaTextEdit').value=nota;
            document.getElementById('nota_id').value=x;
        });
    }
    function notaActualizar() {
        $("#md-editNota").modal('hide');
        var nota = document.getElementById('notaTextEdit').value;
        var notaID = document.getElementById('nota_id').value;
        var url = "/C.S.J.O.bo/Recepcion/Notas/update";
        var data= {'_token': $('meta[name=csrf-token]').attr('content'),
            'nota':nota, 'id' :notaID };

        $.post(url,data).done(function (listNotas) {

            if (listNotas != "error"){
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "success";
                setTimeout(function () { $.notific8('Nota actualizada exitosamente.',data) });
                //setTimeout(function () { $.notific8('jeje esta seria la notificaion.') }, 2000);
                document.getElementById('notaTextEdit').value = "";

                $('#tableNotas').html("");
                for (var i = 0; i < listNotas.length; i++) {
                    var tr = `<tr>
			          <td> N-` + listNotas[i].id + `</td>
			          <td>` + listNotas[i].rn_nota + `</td>
			          <td>` + listNotas[i].rn_fecha + `</td>
			          <td>
                                <span class="tooltip-area">
                                <button onclick="notaEdit(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                <button onclick="notaEliminar(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                </span>
                            </td>
		   	        </tr>`;
                    $("#tableNotas").append(tr);
                }

            }});

    }
    // --------------funcion para eliminar nota
    function notaEliminar(x) {
        $.get('/C.S.J.O.bo/Recepcion/Notas/destroy/'+x+'', function (listNotas) {
            if (listNotas == "error" ){
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "danger";
                setTimeout(function () { $.notific8('Error, vuelva a intentarlo.',data) });
            }else{
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "success";
                setTimeout(function () { $.notific8('Nota eliminada exitosamente.',data) });
                $('#tableNotas').html("");
                for (var i = 0; i < listNotas.length; i++) {
                    var tr = `<tr>
                          <td> N-` + listNotas[i].id + `</td>
                          <td>` + listNotas[i].rn_nota + `</td>
                          <td>` + listNotas[i].rn_fecha + `</td>
                          <td>
                                    <span class="tooltip-area">
                                    <button onclick="notaEdit(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                    <button onclick="notaEliminar(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                    </span>
                                </td>
                        </tr>`;
                    $("#tableNotas").append(tr);
                }
            }
        });

    }
//----------FUNCIONES PARA REGISTRO DE PRESTAMOS
    function showModalFiltrarPresatamos() {
        $("#md-filtrarPrest").attr('class','modal fade').addClass('md-stickTop').modal('show');

    }
    function filtrarPrestamos() {

        var area = document.getElementById('area_pres').value;
       var personal = document.getElementById('personal_pres').value;
       var fecha = document.getElementById('fecha_pres').value;
       //var estado = document.getElementsByName('name-radio');
       var estado = $('input[name="name-radio"]:checked').val();

       var data= {'_token': $('meta[name=csrf-token]').attr('content'),
           'area':area ,
           'personal':personal ,
           'fecha':fecha ,
           'estado':estado };
       var url = "/C.S.J.O.bo/Recepcion/PresHCL/listFiltrado";
        $("#md-filtrarPrest").modal('hide');
       $.post(url,data).done(function (prest) {
           console.log(prest);
           $('#tablaPrestamos').html("");
           for (var i = 0; i < prest.length; i++) {
               var tr = `<tr>
			          
			          <td>` + prest[i].pa_hcl + `</td>
			          <td>` + prest[i].pa_nombre + prest[i].pa_apmaterno+prest[i].pa_appaterno+`</td>
			          <td>` + prest[i].prest_usuEntrega +`/`+ prest[i].prest_area + `</td>
			          <td>` + prest[i].created_at + `</td>
			          <td>
                                <span class="tooltip-area">
                                <button onclick="notaEdit(` + prest[i].id + `)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                <button onclick="notaEliminar(` + prest[i].id + `)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                </span>
                            </td>
		   	        </tr>`;
               $("#tablaPrestamos").append(tr);
           }
       }).fail(function () {
           console.log("falla en js");
       });
    }
    function prestEdit(x) {
        $.get('/C.S.J.O.bo/Recepcion/PresHCL/show/'+x+'',function (prest) {
            var usu =prest.prest_area;
            $("#area_pres_update").val(usu);
            document.getElementById('personal_pres_update').value=(prest.prest_usuEntrega);
            document.getElementById('idPresCerrar').innerHTML=x;
            $("#md-editPres").attr('class','modal fade').addClass('md-stickTop').modal('show');
        }).fail();
    }
    function prestEliminar(x) {
        alert(x);
    }
    function updatePrestamo() {
        var id  = document.getElementById('idPresCerrar').innerHTML;
        var area =  document.getElementById('area_pres_update').value;
        var usuentrega = document.getElementById('personal_pres_update').value;
        var url = "/C.S.J.O.bo/Recepcion/PresHCL/update";
        var data= {'_token': $('meta[name=csrf-token]').attr('content'),
            'id':id,
            'area':area,
            'usuentrega':usuentrega};
        $.post(url,data).done(function (prest) {
            if (prest == 1){
                cargarPrestamos();
                $("#md-editPres").modal('hide');
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "success";
                setTimeout(function () { $.notific8('Exito, Se Actualizo correctamente.',data) });
            }else{
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "danger";
                setTimeout(function () { $.notific8('Error, Vuela a intentarlo.',data) });
            }
        }).fail();
    }
    function cerrarPrestamo() {
        var id  = document.getElementById('idPresCerrar').innerText;
        $.get('/C.S.J.O.bo/Recepcion/PresHCL/cerrarPrestamo/'+id+'',function (result) {
            console.log(result);
            if (result == 1){
                cargarPrestamos();
                $("#md-editPres").modal('hide');
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "success";
                setTimeout(function () { $.notific8('Exito, Prestamo concluiado.',data) });
            }else{
                var data = new Array();
                data.verticalEdge='right';
                data.horizontalEdge='top';
                data.theme = "danger";
                setTimeout(function () { $.notific8('Error, Vuela a intentarlo.',data) });
            }

        }).fail(function () {
            alert("error de servidor");
        });
    }
    function showModalFiltroNotas() {
        $("#md-filtrarNotas").attr('class','modal fade').addClass('md-scale').modal('show');
    }
    function filtrarNotas() {
        var fechaAFiltrar = document.getElementById('nota_fecha_filtro').value;
        if (fechaAFiltrar == null || fechaAFiltrar.length == 0 || /^\s+$/.test(fechaAFiltrar)){
            var data = new Array();
            data.verticalEdge='right';
            data.horizontalEdge='top';
            data.theme = "primary";
            setTimeout(function () { $.notific8('Error, Complete el formulario.',data) });
        }else{
            $("#md-filtrarNotas").modal('hide');
            console.log(fechaAFiltrar);
            var data= {'_token': $('meta[name=csrf-token]').attr('content'),
                'fechaFiltro':fechaAFiltrar};
            var url = "/C.S.J.O.bo/Recepcion/Notas/filtrarPrestamos";
            $.post(url,data).done(function (listNotas) {
                console.log(listNotas);
                $('#tableNotas').html("");
                for (var i = 0; i < listNotas.length; i++) {
                    var tr = `<tr>
                          <td> N-` + listNotas[i].id + `</td>
                          <td>` + listNotas[i].rn_nota + `</td>
                          <td>` + listNotas[i].rn_fecha + `</td>
                          <td>
                                    <span class="tooltip-area">
                                    <button onclick="notaEdit(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></button>
                                    <button onclick="notaEliminar(` + listNotas[i].id + `)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                    </span>
                                </td>
                        </tr>`;
                    $("#tableNotas").append(tr);
                }
            }).fail(function () {
                alert("Error de servidor repita funcion");
            });

        }
    }