//var frase = "Son tres mil trescientos treinta y tres con nueve";
//frase3 = frase.replace(/[ ]/gi,'.');
//alert(frase3);
$("#form_create_CitPrev").on("submit", function(event) {
  event.preventDefault();
  if ($("#id_paciente_create_citPrev").val() > 0) {
    createCitPrev();
  } else {
    notif("4", "Error Vueva a intentarlo");
  }
});
//* --------------
$(function() {
  $("#HCLpaciente").on("keyup", buscarHCLpaciente);
  $("#NOMBRESpaciente").on("keyup", buscarNOMBRESpaciente);
});
function listPacientes(data) {
  var html = data
    .map(function(elem, index) {
      var pre1 = "";
      if (elem.hclEst > 0) {
        pre1 = `<button class="btn btn-danger" onclick="showEstPres(${elem.hclEst})"><i class="fa fa-ban"></i></button>`;
      } else {
        pre1 = `<button class="btn btn-default" ><i class="fa fa-check"></i></button>`;
      }
      return `<tr>
                      <td>${elem.pa_hcl}</td>
                      <td>${elem.pa_ci}</td>
                      <td>${elem.pa_nombre}</td>
                      <td>${elem.pa_appaterno} / ${elem.pa_apmaterno}</td>
                      <td>${pre1}</td>
                     <td>
                        <span class="tooltip-area">
                        <button name="${elem.pa_id}" onclick="rutaAtender(this.name)" class="btn btn-default btn-sm" title="Atender"><i class="fa  fa-plus-square"></i></button>
                        <button onclick="rutaAsignarCitPrev(${elem.pa_id})" class="btn btn-default btn-sm" title="Asignar cita previa"><i class="fa  fa-stethoscope"></i></button>
                        <a name="${elem.pa_id}" onclick="rutaprintHCL(this.name)" class="btn btn-default btn-sm" target="_blank" title="Inprimir"><i class="glyphicon glyphicon-print"></i></a>
                        <button name="${elem.pa_id}" onclick="rutaEditPaciente(this.name)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></i></button>
                        <button name="${elem.pa_id}" onclick="rutaDestroyPaHcl(this.name)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                        <button name="${elem.pa_id}" onclick="rutaPrestarHCL(${elem.pa_id},${elem.pa_hcl})" class="btn btn-default btn-sm" title="Presatar HCl"><i class="fa fa-puzzle-piece"></i></button>
                        </span>
                    </td>  
                </tr>`;
    })
    .join(" ");
  document.getElementById("resulBusqPacientes").innerHTML = html;
}
function rutaPrestarHCL(id, hcl) {
  // ----funcion para modal presatamos de hcl
  $("#md-HCLprestamo")
    .attr("class", "modal fade")
    .addClass("md-flipHor")
    .modal("show");
  document.getElementById("codHCL").innerHTML = hcl;
  document.getElementById("presIDHCL").innerHTML = id;
  document.getElementById("areaEntrega").selectedIndex = "Contabilidad";
}
function registrarPrestamo() {
  var id = document.getElementById("presIDHCL").innerHTML;
  var usuEntrega = document.getElementById("usuEntrega").value;
  var area = document.getElementById("areaEntrega").value;
  if (
    usuEntrega == null ||
    usuEntrega.length == 0 ||
    /^\s+$/.test(usuEntrega)
  ) {
    var data = new Array();
    data.verticalEdge = "right";
    data.horizontalEdge = "top";
    data.theme = "danger";
    setTimeout(function() {
      $.notific8("Error, Complete el formulario.", data);
    });
  } else {
    var url = "/C.S.J.O.bo/Recepcion/PresHCL/create";
    var data = {
      _token: $("meta[name=csrf-token]").attr("content"),
      id: id,
      usuEntrega: usuEntrega,
      areaPrestamo: area
    };
    $.post(url, data)
      .done(function(prestamo) {
        console.log(prestamo);
        if (prestamo == "1") {
          notif("1", "Prestamo Registrado");
          $("#md-HCLprestamo").modal("hide");
          document.getElementById("usuEntrega").value = "";
          document.getElementById("presIDHCL").innerHTML = "";
          document.getElementById("resulBusqPacientes").innerHTML = "";
        } else {
          var data = new Array();
          data.verticalEdge = "right";
          data.horizontalEdge = "top";
          data.theme = "danger";
          setTimeout(function() {
            $.notific8("Error, vuelva a intentarlo.", data);
          });
        }
      })
      .fail(function() {
        var data = new Array();
        data.verticalEdge = "right";
        data.horizontalEdge = "top";
        data.theme = "danger";
        setTimeout(function() {
          $.notific8("Error en el servidor, vuelva a intentarlo.", data);
        });
      });
    /* var data = new Array();
        data.verticalEdge='right';
        data.horizontalEdge='top';
        data.theme = "success";
        setTimeout(function () { $.notific8('Exito, Prestamos registrado.',data) });*/
  }

  // $("#md-HCLprestamo").attr('class','modal fade').addClass('md-flipHor').modal('show');
}
function rutaAtender(x) {
  //window.alert(x);
  document.location.href = "/C.S.J.O.bo/Recepcion/atencion/index/" + x + "";
}
function rutaprintHCL(x) {
  //window.alert(x);
  var ventana = window.open("", "PRINT", "height=700,width=700");
  ventana.location.href = "/C.S.J.O.bo/Recepcion/paciente/PrintHCL1/" + x + "";
  //document.location.href="/C.S.J.O.bo/Recepcion/paciente/PrintHCL1/"+x+"";
}
function rutaEditPaciente(x) {
  //indow.alert(x);
  document.location.href = "/C.S.J.O.bo/Recepcion/paciente/edit/" + x + "";
}
function rutaDestroyPaHcl(x) {
  //window.alert(x);
  document.location.href = "/C.S.J.O.bo/Recepcion/paciente/delete/" + x + "";
}
function buscarHCLpaciente() {
  var hcl = $(this).val();
  if (hcl == "") {
    console.log("sin nuemro");
    $("#resulBusqPacientes").html("");
  } else {
    $.get("/C.S.J.O.bo/api/buscarPacienteHCL/" + hcl + "", function(paciente) {
      listPacientes(paciente);
      /*$('#resulBusqPacientes').html("");
            for (var i = 0; i <= paciente.length - 1; i++) {
                console.log(paciente[i]);
                var tr = `<tr>
                      <td>`+paciente[i].pa_hcl+`</td>
                      <td>`+paciente[i].pa_ci+`</td>
                      <td>`+paciente[i].pa_nombre+`</td>
                      <td>`+paciente[i].pa_appaterno+` / `+paciente[i].pa_apmaterno+`</td>
                     <td>
                        <span class="tooltip-area">
                        <button name="`+paciente[i].pa_id+`" onclick="rutaAtender(this.name)" class="btn btn-default btn-sm" title="Atender"><i class="fa  fa-plus-square"></i></button>
                        <a name="`+paciente[i].pa_id+`" onclick="rutaprintHCL(this.name)" class="btn btn-default btn-sm" target="_blank" title="Inprimir"><i class="glyphicon glyphicon-print"></i></a>
                        <button name="`+paciente[i].pa_id+`" onclick="rutaEditPaciente(this.name)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></i></button>
                        <button name="`+paciente[i].pa_id+`" onclick="rutaDestroyPaHcl(this.name)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                        <button name="`+paciente[i].pa_id+`" onclick="rutaPrestarHCL(`+paciente[i].pa_id+`,`+paciente[i].pa_hcl+`)" class="btn btn-default btn-sm" title="Presatar HCl"><i class="fa fa-puzzle-piece"></i></button>
                        </span>
                    </td>
                </tr>`;

                $("#resulBusqPacientes").append(tr)
            }*/
    });
  }
}
function buscarNOMBRESpaciente() {
  var nombres = $(this).val();
  if (nombres == "") {
    console.log("sin letras");
    $("#resulBusqPacientes").html("");
  } else {
    nombres = nombres.replace(/[ ]/gi, "-");
    $.get("/C.S.J.O.bo/api/buscarPacienteNombre/" + nombres + "", function(
      paciente
    ) {
      listPacientes(paciente);
      /*$('#resulBusqPacientes').html("");
            for (var i = paciente.length - 1; i >= 0; i--) {
                console.log(paciente[i]);
                var tr = `<tr>
                      <td>`+paciente[i].pa_hcl+`</td>
                      <td>`+paciente[i].pa_ci+`</td>
                      <td>`+paciente[i].pa_nombre+`</td>
                      <td>`+paciente[i].pa_appaterno+` / `+paciente[i].pa_apmaterno+`</td>
                     <td>
                        <span class="tooltip-area">
                        <button name="`+paciente[i].pa_id+`" onclick="rutaAtender(this.name)" class="btn btn-default btn-sm" title="Atender"><i class="fa  fa-plus-square"></i></button>
                        <a name="`+paciente[i].pa_id+`" onclick="rutaprintHCL(this.name)" class="btn btn-default btn-sm" target="_blank" title="Inprimir"><i class="glyphicon glyphicon-print"></i></a>
                        <button name="`+paciente[i].pa_id+`" onclick="rutaEditPaciente(this.name)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></i></button>
                        <button name="`+paciente[i].pa_id+`" onclick="rutaDestroyPaHcl(this.name)" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                        <button name="`+paciente[i].pa_id+`" onclick="rutaPrestarHCL(`+paciente[i].pa_id+`)" class="btn btn-default btn-sm" title="Prestar HCL"><i class="fa fa-puzzle-piece"></i></button>
                        </span>
                    </td>
                </tr>`;

                $("#resulBusqPacientes").append(tr)
            }*/
    });
  }
}
function showEstPres(prest) {
  console.log(prest);
  $.get("/C.S.J.O.bo/Recepcion/PresHCL/show/" + prest + "", function(prest) {
    var usu = prest.prest_area;
    $("#area_pres_update").val(usu);
    document.getElementById("personal_pres_update").value =
      prest.prest_usuEntrega;
    document.getElementById("idPresCerrar").innerHTML = prest.id;
    document.getElementById("fechaPrestamo").innerText = moment(
      prest.created_at,
      "YYYY/MM/DD HH:mm:ss"
    ).format("DD/MM/YYYY HH:mm");
    $("#md-editPres")
      .attr("class", "modal fade")
      .addClass("md-stickTop")
      .modal("show");
  }).fail(function() {
    notif("2", "ERROR SERVER BUSCAR PREST");
  });
}
function updatePrestamo() {
  var id = document.getElementById("idPresCerrar").innerHTML;
  var area = document.getElementById("area_pres_update").value;
  var usuentrega = document.getElementById("personal_pres_update").value;
  var url = "/C.S.J.O.bo/Recepcion/PresHCL/update";
  var data = {
    _token: $("meta[name=csrf-token]").attr("content"),
    id: id,
    area: area,
    usuentrega: usuentrega
  };
  $.post(url, data)
    .done(function(prest) {
      if (prest == 1) {
        document.getElementById("resulBusqPacientes").innerHTML = "";
        $("#md-editPres").modal("hide");
        notif("1", "Prestamo actualizado");
      } else {
        notif("3", "Error !. Vuelva a interntarlo");
      }
    })
    .fail();
}
function cerrarPrestamo() {
  var id = document.getElementById("idPresCerrar").innerText;
  $.get("/C.S.J.O.bo/Recepcion/PresHCL/cerrarPrestamo/" + id + "", function(
    result
  ) {
    console.log(result);
    if (result == 1) {
      $("#md-editPres").modal("hide");
      notif("1", "Prestamo concluido");
      document.getElementById("resulBusqPacientes").innerHTML = "";
    } else {
      notif("3", "Error!. velva a intentarlo");
    }
  }).fail(function() {
    notif("2", "Error SERVER");
  });
}

function rutaAsignarCitPrev(id) {
  $("#form_create_CitPrev").trigger("reset");
  $('#listCitPrev').html('');
  $.get("../citaPrevia/infoPaci", { id: id }, function(data) {
    console.log(data);
    $("#id_paciente_create_citPrev").val("");
    $("#id_paciente_create_citPrev").val(data.pac.pa_id);
    var espcia = data.esp
      .map(function(e) {
        return `<option value="${e.id}">${e.nombre}</option>`;
      })
      .join(" ");
    var med = data.med
      .map(function(e) {
        return ` <option value="${e.id}">${e.ps_appaterno}</option>`;
      })
      .join(" ");
    $("#ate_especialidad_citPrev").html(espcia);
    $("#ate_med_citPrev").html(med);
    $("#fecha_citPrev").val(data.date);
    var horario = "Tarde";
    $("#ate_turno_citPrev option[value=" + horario + "]").attr(
      "selected",
      true
    );
    $("#md-form_create_sitaPrev").modal("show");
    var dt = new Date();
    var h = dt.getHours(),
      m = dt.getMinutes();
    h > 12
      ? $("#ate_turno_citPrev option[value=Tarde]").attr("selected", true)
      : $("#ate_turno_citPrev option[value=Mañana]").attr("selected", true);
  });
}
function createCitPrev() {
  var data = {
    _token: $("meta[name=csrf-token]").attr("content"),
    ip_Pa: $("#id_paciente_create_citPrev").val(),
    especialidad: $("#ate_especialidad_citPrev").val(),
    procedimiento: document.querySelector(
      'input[name="ateProcedimiento"]:checked'
    ).value,
    medico: $("#ate_med_citPrev").val(),
    nroTicked: $("#ticked_citPrev").val(),
    turno: $("#ate_turno_citPrev").val(),
    fecha: $("#fecha_citPrev").val(),
    hora: $("#time_citPrev").val(),
    observacion: $("#observacion_citPrev").val()
  };
  $.post("../citaPrevia/create", data, function(data) {
    if (data == 1) {
      notif("1", "Cita previa Registrada");
      $("#md-form_create_sitaPrev").modal("hide");
    } else {
      notif("3", "Error de registro vuelva a intentarlo!");
      $("#md-form_create_sitaPrev").modal("hide");
    }
  });
}

function listCitasPreviasEspecialidad() {
  var e = document.getElementById("ate_especialidad_citPrev").checkValidity();
  var i = document.getElementById("fecha_citPrev").checkValidity();
  if (e && i) {
    $.get(
      "../citaPrevia/listagenda1",
      {
        id: $("#ate_especialidad_citPrev").val(),
        date: $("#fecha_citPrev").val()
      },
      function(data) {
        var html = data
          .map(function(e) {
            return `
          <tr id="${e.id}">
              <td align="right">${e.pa_hcl}</td>
              <td align="left">${e.pa_nombre} ${e.pa_appaterno}</td>
              <td align="right">${e.cp_num_ticked}</td>
              <td align="right">${e.cp_time}</td>
          </tr>
          `;
          })
          .join(" ");
          $('#listCitPrev').html(html);
      }
    );
  }
}
