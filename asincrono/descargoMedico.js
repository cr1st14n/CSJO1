$("#btn-md_agregar_item").click(function (e) {
  e.preventDefault();
  $("#md-create_item_descargoMed").modal("show");
});
$("#form-createItemDesMed").submit(function (e) {
  e.preventDefault();
  console.log();
  $.ajax({
    type: "post",
    url: "descargosMedicos/desMed",
    data: $("#form-createItemDesMed").serialize(),
    // dataType: "",
    success: function (response) {
      if (response) {
        $("#md-create_item_descargoMed").modal("hide");
        $("#form-createItemDesMed").trigger("reset");
        listItemsDesMed();
      } else {
        notif("2", "Error. intentelo nuevamente");
      }
    },
  });
});
function listItemsDesMed() {
  $.ajax({
    type: "get",
    url: "descargosMedicos/desMed",
    // data: "data",
    // dataType: "dataType",
    success: function (response) {
      var html = response
        .map(function (e) {
          return (a = `
                <tr>
                    <td>${e.id}</td>
                    <td valign="middle">${e.dmi_nombre}</td>
                    <td><span class="label label-success">${e.dmi_tipo}</span></td>
                    <td><span class="label label-success">----</span></td>
                    <td>
                        <span class="tooltip-area">
                            <a href="javascript:void(0)" class="btn btn-default btn-sm" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" class="btn btn-default btn-sm" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                        </span>
                    </td>
                </tr>`);
        })
        .join(" ");
      $("#list-items1").html(html);
    },
  });
}
// *lista por tipo de descargo en mez actual
$("#listTipoDesc").submit(function (e) {
  e.preventDefault();
  $.ajax({
    type: "get",
    url: "descargosMedicos/index1",
    data: $("#listTipoDesc").serialize(),
    // dataType: "dataType",
    success: function (response) {
      console.log(response);
      var html = response.map(function (e) {
        return (a = `
          <tr>
              <td>${e.id}</td>
              <td valign="middle">${e.id_paciente}</td>
              <td valign="middle">${e.pa_appaterno}  ${e.pa_nombre} </td>
              <td>${e.dm_diagnostico}</td>
              <td>${e.dm_operacion}</td>
              <td><span class="label label-success">${e.dm_area}</span></td>
              <td>
                  <span class="tooltip-area">
                      <button onClick="f_show_descargoM1(${e.id})" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-bars"></i></button>
                  </span>
              </td>
          </tr>
          `);
      }).join(' ');
      $('#listDesMedBody').html(html);
    },
  });
});
function f_show_descargoM1(id) {
 $('#md-view_cot_descargoMed').modal('show');
 $.ajax({
   type: "get",
   url: "descargosMedicos/showDetalleDescargo1",
   data: {id:id},
  //  dataType: "dataType",
   success: function (response) {
     $('#bodyShowDescargoView1').html(response);
   }
 });
}