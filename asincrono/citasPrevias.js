$('#form_create_CitPrev').submit(function (e) { 
    e.preventDefault();
    citPrevCreateAtencion()
});
function listCitasPrevias() {
    var data={
        date:$('#citPrevDate_list').val(),
        turno:$('#turno_list').val(),
    }
    $.get("listCitasPrevias", data,
        function (data) {
         var html=data.map(function (e) { 
             return`
             <tr>
                <td>${e.pa_hcl}</td>
                <td valign="middle">${e.pa_nombre} ${e.pa_appaterno}</td>
                <td>${e.nombre}</td>
                <td>${e.cp_turno}</td>
                <td>${e.cp_num_ticked}</td>
                <td><span class="label label-success">${e.cp_time}</span></td>
                <td>
                    <span class="tooltip-area">
                        <a onclick="agendarCitPrev(${e.id})" class="btn btn-default btn-sm" title="Agendar"><i class="fa fa-exclamation"></i></a>
                        <a onclick="deleteCitPrev(${e.id})" class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></a>
                    </span>
                </td>
            </tr>   
             `;
            }).join(' '); 
            $('#listCitPrev').html(html);
        }
    );
  }

  function agendarCitPrev(id) {
      $.get("agendarCitPrev", {id:id},
          function (data) {
              console.log(data);
              $('#id_form_citPrevAgendar_ag').val(data.id);
              $('#ate_especialidad_citPrev_ag').val(data.cp_especialidad);
              $('#ate_med_citPrev_ag').val(data.cp_med);
              $('#ticked_citPrev_ag').val(data.cp_num_ticked);
              $('#ate_turno_citPrev_ag').val(data.cp_turno);
              $('#fecha_citPrev_ag').val(data.cp_fecha);
              $('#time_citPrev_ag').val(data.cp_time);
              $('#observacion_citPrev_ag').val(data.cp_observacion);
              $('#ateProcedimiento_ag').val(data.cp_procedimiento);
              $('#md-form_citPrevAgendar').modal('show');
            }
            );
    }

    function citPrevCreateAtencion() { 
        if ($('#R_P_ag').prop('checked') == true) {
            var Rpago='on';
        }else{
            var Rpago='off';
        }
        var data={
    		_token: $('meta[name=csrf-token]').attr('content'),
            id:$('#id_form_citPrevAgendar_ag').val(),
            especialidad:$('#ate_especialidad_citPrev_ag').val(),
            procedimiento:$('#ateProcedimiento_ag').val(),
            medico:$('#ate_med_citPrev_ag').val(),
            ticked:$('#ticked_citPrev_ag').val(),
            turno:$('#ate_turno_citPrev_ag').val(),
            fecha:$('#fecha_citPrev_ag').val(),
            hora:$('#time_citPrev_ag').val(),
            observacion:$('#observacion_citPrev_ag').val(),
            pago:Rpago,
        }
        console.log(data);
        $.post("createCitPrevAgendar", data,
            function (data) {
              console.log(data);
                if (data==1) {
                    notif('1','Cita medica Agendada Correctamente');
                    $('#md-form_citPrevAgendar').modal('hide');
                    $('#form_create_CitPrev').trigger('reset');
                    listCitasPrevias();
                } else {
                    notif('3','Error, Vuevla a intentarlo');
                }
            }
        );
     }

    function deleteCitPrev(id) {
         if (id>0) {
             var btn=`<button type="button" data-dismiss="modal" class="btn btn-theme">Cancelar</button>
             <button type="button" class="btn btn-theme-inverse" onClick="DestroyCitaPrevia(${id})">Aceptar</button>`;
             $('#btn-citaPrevia-delete').html(btn);
             $('#md-citasPrevias_delete').modal('show');
         } else {
             notif('2','Erro.');
         }
       }
    function DestroyCitaPrevia (id) {
        if (id>0) {
            $.post("destroy",{
    		_token: $('meta[name=csrf-token]').attr('content'),
            id:id
            } ,
                function (data) {
                    if (data==1) {
                        $('#md-citasPrevias_delete').modal('hide');
                        notif('3','Cita previa Eliminada!'); 
                        listCitasPrevias();  
                    } else {
                        $('#md-citasPrevias_delete').modal('hide');
                        notif('2','Error!. Vuela a intentarlo')            
                    }
                }
            );
        } else {
            $('#md-citasPrevias_delete').modal('hide');
            notif('2','Error!. Vuela a intentarlo')
        }
      }