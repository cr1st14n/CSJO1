actEstado1();

function informe1() {
  $.get("admRecepHome/1")
    .done(function(data) {
      // console.log(typeof data);
      // console.log(data);
      var html = `
      <h3><strong>Porcentaje </strong>registro</h3>
      <br>
      <div class="progress progress-shine active progress-sm" style="height:8px;">
          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: ${data.porcentajeHombre}%; ">
          </div>
      </div>
      <label class="progress-label">Hombre ${data.porcentajeHombre}% </label>

      <!-- //progress-->
      <div class="progress progress-sm progress-shine active " style="height:8px;">
          <div class="progress-bar bg-danger " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: ${data.porcentajeMujer}%; ">
          </div>
      </div>
      <label class="progress-label">Mujeres ${data.porcentajeMujer}% </label>
      <!-- //progress-->
      <div class="progress progress-shine progress-sm" style="height:8px;">
          <div class="progress-bar  bg-warning" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: ${data.edad1P}%; ">
          </div>
      </div>
      <label class="progress-label">Edad entre 0-25 años ${data.edad1P}% ${data.edad1} pacientes</label>
      <!-- //progress-->
      <div class="progress progress-sm progress-shine active" style="height:8px;">
          <div class="progress-bar bg-gradient-blue" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: ${data.edad2P}%; ">
          </div>
      </div>
      <label class="progress-label">Edad entre 26-50 ${data.edad2P}% ${data.edad2} pacientes</label>
      <!-- //progress-->
      <div class="progress progress-sm progress-shine active" style="height:8px;">
          <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: ${data.edad3P}%; ">
          </div>
      </div>
      <label class="progress-label">Edad entre 51-adelante ${data.edad3P}% ${data.edad3} pacientes</label>
      <!-- //progress-->`;

      var html2 = `<h3><strong>Total</strong> pacientes </h3>
      <br>
      <ol class="rectangle-list">
          <li><a >Total <span class="pull-right">${data.Total}</span></a></li>
          <li><a >Hombres <span class="pull-right">${data.TotalHombre}</span></a></li>
          <li><a >Mujeres <span class="pull-right">${data.TotalMujer} </span></a></li>
          <li><a >sin registro de genero <span class="pull-right">${data.TotalSinSexo} </span></a></li>
      </ol>`;

      $("#porcentajeRegistro").html(html);
      $("#totalRegistros").html(html2);
      // animateprogress("#progres1",91);
    })
    .fail(function() {});
}

function buscarCiHCL(dato, tipo) {
  // console.log(dato,tipo);
  // console.log(dato.length);
  if (dato.length == 0) {
    var hatmVacio = `<tr>
                            Ingrese datos para buscar!
                        </tr>`;
    document.getElementById("listPacientes").innerHTML = hatmVacio;
  } else {
    var data = { dato: dato, tipo: tipo };
    $.get("admRecepHome/BuscHCL", data)
      .done(function(data) {
        if (data == "vacio") {
          // console.log("vacio");
          var hatmVacio = `<tr>
                                Informacion no encontrada!
                                </tr>`;
          document.getElementById("listPacientes").innerHTML = hatmVacio;
        } else {
          // console.log(data);
          listPacientes(data);
        }
      })
      .fail(function() {});
  }
}

function listPacientes(data) {
  var html = data
    .map(function(elem, index) {
      return `<tr>
                    <td>${elem.pa_hcl}</td>
                    <td>${elem.pa_ci}</td>
                    <td>${elem.pa_nombre}</td>
                    <td>${elem.pa_appaterno} / ${elem.pa_apmaterno}</td>
                    <td>
                        <span class="tooltip-area">
                        <button name="${elem.pa_id}" class="btn btn-default btn-sm" title="Historia" onClick="pacihistMedica(this.name)" ><i class="fa  fa-bars"></i></button>
                        </span>
                    </td>
                    
                </tr>`;
    })
    .join(" ");
  document.getElementById("listPacientes").innerHTML = html;
}

function cuadroEstadistico() {
  // console.log("hola");
  var html = "1000";
  document.getElementById("tablaEstadistica").innerText = html;
}

function InfoCajaList(param) {
  var datos = { mez: $("#infCajaMez").val(), año: $("#infoCajaAño").val() };
  $.get("admRecepHome/InfoCajaList", datos)
    .done(function(data) {
      // console.log(data);
      var html = data
        .map(function(elem, index) {
          return `
                <li><a href="#" onClick="ShowModalDetalleCajaEsp(${elem.id},'${elem.nombre}')"> ${elem.nombre} <span class="pull-right">${elem.cantidad}</span></a></li>
            `;
        })
        .join(" ");
      $("#listReporteCaja").html(html);
    })
    .fail(function(params) {});
}

function ShowModalDetalleCajaEsp(id, nombre) {
  $("#IdDeEspecialidadDC").val(id);
  $("#nombreDeEspecialidadDC").text(nombre);
  $("#estadoAnualEst").html("");
  var año = $("#infoCajaAño").val();
  if (año.length == 0) {
    año = 2019;
  }
  $("#infoCajaAñoDetalle").val(año);
  setTimeout(showDataEstEsp, 200);
  // showDataEstEsp();
  $("#md-DetalleCajaEsp").modal("show");
}

function showDataEstEsp() {
  $("#estadoAnualEst").html("");
  var año = $("#infoCajaAñoDetalle").val();
  var id = $("#IdDeEspecialidadDC").val();
  if (id == null) {
    id = $("#IdDeEspecialidadDC").val();
  }
  if (año.length == 0) {
    notif("2", "Verificar año!");
  } else if (id.length == 0) {
    $("#md-DetalleCajaEsp").modal("hide");
  } else {
    var dat = { id: id, año: año };
    $.get("admRecepHome/detalleCajaEspecialidad/", dat)
      .done(function(data) {
        // console.log(data);
        new Morris.Line({
          element: "estadoAnualEst",
          data: data,
          xkey: "elapsed",
          ykeys: ["value"],
          labels: ["value"],
          parseTime: false
        });
      })
      .fail(function() {
        console.log("error de server resgrese");
      });
  }
}

function pacihistMedica(id) {
  var dateString = "2017-01-10";
  // console.log(moment(dateString).format("DD/MM/YYYY"));
  $.get("admRecepHome/historiaHCLAte/" + id + "")
    .done(function(param) {
      // console.log(param);
      var nombre = `${param["apellido1"]} ${param["apellido2"]}, ${
        param["nombre"]
      }, #HCL: ${param["hcl"]}`;
      $("#nombreDelPaciente").text(nombre);
      var html = param["datos"]
        .map(function(elem) {
          return `
        <tr>
            <td>${moment(elem.created_at).format("DD-MM-YYYY h:mm ")}</td>
            <td valign="middle">${elem.ate_procedimiento}</td>
            <td>${elem.nombre}</td>
            <td>${
              elem.ps_nombre
            } ${elem.ps_appaterno} ${elem.ps_apmaterno} </td>
        </tr>
          `;
        })
        .join(" ");
      $("#tabPaciHistMed").html(html);
      $("#md-HclHistorial").modal("show");
    })
    .fail(function() {});
}

function actEstado1(param) {
  $.get("admRecepHome/actRegistroPaci")
    .done(function(data) {
      new Morris.Donut({
        element: "estado1",
        data: [
          { label: "Mañana", value: data["regPacMañana"] },
          { label: "Tarde", value: data["regPacTarde"] }
        ],
        colors: ["#06AAF1", "#20CF42"]
      });
    })
    .fail();
}

function showDetMed(param) {
  $("#md-infoCaja2").modal("show");
}
function actEstado2(param) {
  document.getElementById("listReporteCaja2").innerHTML = "";
  aniCarga('listReporteCaja2');
  var date = $("#IdDetMedCajaAño").val();
  var gestion = $("#IdDetMedCajaDate").val();
  $.get(
    "admRecepHome/actRegistroMed",
    { gestion: gestion, año: date },
    function(data) {
      // console.log(data);
      var html = data
        .map(function(elem, index) {
          return `
        <li><a href="#" onClick="ShowModalDetalleCajaMed(${elem.id},'${elem.apellido}','${elem.especialidad}')"> ${elem.apellido} / ${elem.especialidad}<span class="pull-right">${elem.cantidad}</span></a></li>
        `;
        })
        .join(" ");
      document.getElementById("listReporteCaja2").innerHTML = html;
    }
  ).fail();
}
function ShowModalDetalleCajaMed(id, nombre, especlialidad) {
  $("#md-DetalleCajaMed").modal("show");
  // console.log(id + nombre + especlialidad);
  document.getElementById("nombreDeMedicoDC").innerText =
    nombre + "-" + especlialidad;
  document.getElementById("idNombreDeMedicoDC").value = id;
  $('#infoCajaAñoDetalleMed').val($('#IdDetMedCajaAño').val());
  ShowModalDetalleCajaMed2();
}
function ShowModalDetalleCajaMed2() {
  aniCarga('estadoAnualEst11');
  var año = document.getElementById("infoCajaAñoDetalleMed").value;
  var id = document.getElementById("idNombreDeMedicoDC").value;
  $.get("admRecepHome/DatosEstAnualesMedico", { id: id, año: año }, function(
    data
  ) {
    // console.log(data);
    $('#estadoAnualEst11').html("");
    new Morris.Line({
      element: "estadoAnualEst11",
      data: data,
      xkey: "elapsed",
      ykeys: ["value"],
      labels: ["value"],
      parseTime: false
    });
  });
}
