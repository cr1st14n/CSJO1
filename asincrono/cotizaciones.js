function listCotizacines1(data) {
  $.ajax({
    type: "get",
    data: data,
    url: "../adm/cotizaciones/list1",
    success: function (response) {
      console.log(response);

      var html = response
        .map(function (e) {
          return (html = ` 
                <tr>
                    <td>${e.cod_cot}</td>
                    <td valign="middle"> ${veriNull(e.pa_nombre)} ${veriNull(
            e.pa_appaterno
          )} </td>
                    <td><span class="label label-success">${
                      e.cot_EspecialidadCirugia
                    } - ${e.cot_tipoCirugia}</span></td>
                    <td>${veriNull(e.usu_nombre)} ${veriNull(
            e.usu_appaterno
          )}</td>
                    <td>---</td>
                    <td>
                        <span class="tooltip-area">
                            <button onClick="show_option_otizacion(${
                              e.id
                            })"  class="btn btn-default btn-sm" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                        </span>
                    </td>
                </tr>
                `);
        })
        .join(" ");
      $("#table-list_precotizaciones").html(html);
    },
  });
}
function listCotizacines2(data) {
  $.ajax({
    type: "get",
    data: data,
    url: "../adm/cotizaciones/list2",
    success: function (response) {
      console.log(response);
      var html = response
        .map(function (e) {
          return (html = ` 
                <tr>
                    <td>${e.cod_cot}</td>
                    <td valign="middle">${veriNull(e.pa_nombre)} ${veriNull(
            e.pa_appaterno
          )} </td>
                    <td><span class="label label-success">${
                      e.cot_EspecialidadCirugia
                    } - ${e.cot_tipoCirugia}</span></td>
                    <td>${veriNull(e.usu_nombre)} ${veriNull(
            e.usu_appaterno
          )}</td>
                    <td>${e.cot_costoProcedimiento} Bs.-</td>
                    <td>
                        <span class="tooltip-area">
                            <button onClick="show_option_otizacion_edit(${
                              e.id
                            })"  class="btn btn-default btn-sm" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                        </span>
                    </td>
                </tr>
                `);
        })
        .join(" ");
      $("#table-list_precotizaciones").html(html);
    },
  });
}

function show_option_otizacion(id) {
  $("#form_registerCotizacion1").trigger("reset");
  $.ajax({
    type: "get",
    url: "../adm/cotizaciones/store1",
    data: { id: id },
    success: function (html) {
      // $("#md-optionCotizacion").html("");
      $("#md-optionCotizacion").html(html);
    },
  });
  $("#md-optionCotizacion").modal("show");
}
function show_option_otizacion_edit(id) {
  $("#form_registerCotizacion1").trigger("reset");
  $.ajax({
    type: "get",
    url: "../adm/cotizaciones/store1",
    data: { id: id },
    success: function (html) {
      // $("#md-optionCotizacion").html("");
      $("#md-optionCotizacion").html(html);
    },
  });
  $("#md-optionCotizacion").modal("show");
}

$("#form_registerCotizacion1").submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: "post",
    url: "../adm/cotizaciones/create",
    data: $("#form_registerCotizacion1").serialize(),
    //  dataType: "bolean",
    success: function (response) {
      if (response == 1) {
        listCotizacines1($("#form_list_cotizaciones").serialize());
        $("#md-optionCotizacion").modal("hide");
      } else {
        $("#md-optionCotizacion").modal("hide");
        notif("2", "Error! Vuelva a intentarlo.");
      }
    },
  });
});
$("#form_registerCotizacion2").submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: "post",
    url: "../adm/cotizaciones/update",
    data: $("#form_registerCotizacion2").serialize(),
    //  dataType: "bolean",
    success: function (response) {
      console.log(response);
      if (response == 1) {
        listCotizacines2($("#form_list_cotizaciones").serialize());
        $("#md-optionCotizacion").modal("hide");
        notif("1", "Actualizado.");
      } else {
        $("#md-optionCotizacion").modal("hide");
        notif("2", "Error! Vuelva a intentarlo.");
      }
    },
  });
});

$("#form_list_cotizaciones").submit(function (e) {
  e.preventDefault();
  var data = $("#form_list_cotizaciones").serialize();
  if ($("#estado_cotizacion").val() == 0) {
    listCotizacines1(data);
  } else {
    listCotizacines2(data);
  }
});

$("#btn_showMdSearchPaciente").click(function (e) {
  e.preventDefault();
  $("#md-searchPacientePrecoti").modal("show");
});
$("#HCLpaciente_preCot").keyup(function (e) {
    var hcl = $(this).val();
    if (hcl == "") {
      console.log("sin nuemro");
      $("#resulBusqPacientes").html("");
    } else {
      $.get("/C.S.J.O.bo/api/buscarPacienteHCL/" + hcl + "", function (
        paciente
      ) {
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
  
});
$("#NOMBRESpaciente_preCot").keyup(function (e) {
  
    var nombres = $(this).val();
    if (nombres == "") {
      console.log("sin letras");
      $("#resulBusqPacientes").html("");
    } else {
      nombres = nombres.replace(/[ ]/gi, "-");
      $.get("/C.S.J.O.bo/api/buscarPacienteNombre/" + nombres + "", function (
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
  
});

function listPacientes(data) {
  var html = data
    .map(function (elem, index) {
      return `<tr>
                      <td>${elem.pa_hcl}</td>
                      <td>${elem.pa_ci}</td>
                      <td>${elem.pa_nombre}</td>
                      <td>${elem.pa_appaterno} / ${elem.pa_apmaterno}</td>
                      <td><button class="btn btn-theme-inverse" id="${elem.pa_id}"><i class="fa fa-share"></i></button></td>
                     
                </tr>`;
    })
    .join(" ");
  document.getElementById("resulBusqPacientes_proCot").innerHTML = html;
}

$('#btn_pdf').click(function (e) { 
  e.preventDefault();
  $('#md-showPDF').modal('show');
});

