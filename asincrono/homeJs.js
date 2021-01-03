function notif(tipo, texto) {
  var data = new Array();
  switch (tipo) {
    case "1":
      // data.verticalEdge='right';
      // data.horizontalEdge='top';
      data.life = 3000;
      data.theme = "theme-inverse";
      $.notific8(texto, data);
      break;
    case "2":
      data.life = 3000;
      data.theme = "danger";
      $.notific8(texto, data);
      break;
    case "3":
      data.life = 3000;
      data.theme = "primary";
      $.notific8(texto, data);
      break;
    case "4":
      data.life = 5000;
      data.theme = "inverse";
      $.notific8(texto, data);
      break;
    case "5":
      data.life = 3000;
      $.notific8(texto, data);
      break;
  }
}
function veriNull(texto) {
  if (texto == null || texto.length == 0) {
    return "";
  } else {
    return texto;
  }
}
function validar(id) {
  var elemento = document.getElementById(id);
  if (elemento.length != 0) {
    if (elemento.checkValidity()) {
      elemento.style.borderColor = "";
      elemento.style.backgroundColor = "";
    } else if (elemento.value == "") {
      elemento.style.borderColor = "";
      elemento.style.backgroundColor = "";
    } else {
      elemento.style.borderColor = "red";
      elemento.style.backgroundColor = "#ffd3d3";
    }
  }
}
function colorRandom() {
  var res = "#" + Math.floor(Math.random() * 16777215).toString(16);
  return res;
}
function aniCarga(divId) {
  var html = `<div id="preloader_3"></div>`;
  var html = ` 
 <br>
 <br>
 <br>
 <div id="preloader_1">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<br>
<br>
`;
  $(`#${divId}`).html(html);
}

$('#btn_index_pre_cotizaciones').on('click', function () {
  $.ajax({
    type: "get",
    url: "../adm/cotizaciones/home",
    // data: "data",
    // dataType: "dataType",
    success: function (response) {
      $('#content').html(response);
    }
  });
});
$('#btn_index_descargosQuiEndo').on('click', function () {
  $.ajax({
    type: "get",
    url: "../adm/descargosMedicos/home",
    // data: "data",
    // dataType: "dataType",
    success: function (response) {
      $('#content').html(response);
    }
  });
});

