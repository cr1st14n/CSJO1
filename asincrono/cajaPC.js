function listPaciCola(data) {
    var html=data.map(function (PC,inex) {
        if (PC.ate_paog=='pendiente'){var pago = `<span class="label label-warning">${PC.ate_pago}</span>`;}
        else {var pago=`<span class="label label-success">${PC.ate_pago }</span>`}
       return(`<tr>
                    <th>${ PC.pa_hcl } </th>
                    <th>${ PC.pa_ci} </th>
                    <th>${ PC.pa_nombre } ${ PC.pa_appaterno } ${ PC.pa_apmaterno } </td>
                    <TH>${ PC.nombre} </TH>
                    <th>${ PC.ps_nombre} ${ PC.ps_appaterno} ${ PC.ps_apmaterno}</th>
                    <th>${ PC.ate_procedimiento }</th>
                    <TH>${ PC.ate_num_ticked } </TH>
                    <TH>${ PC.time_at } </TH>
                    <th>${ PC.ate_turno }</th>
                    <th>${pago}</th>
                    <td>
                        <span class="tooltip-area">
                        <a href="{{route('ate_pago',$PC->id)}} " class="btn btn-default btn-sm" title="ON/OFF"><i class="fa  fa-thumb-tack"></i></a>
                        </span>
                    </td>
                </tr>`);
    });
}
function actListPaciCola() {
    console.log("actualizar lista");
}