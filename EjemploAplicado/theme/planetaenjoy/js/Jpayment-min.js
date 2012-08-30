function loadPayments(saleid){
    $('.paymentItems').html('<tr><td colspan="6"><center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></center></td></tr>').hide(200);
    $.post('?load=payment&action=getPayments&ajaxRequest',
    {
        saleid:""+saleid+""
    },
    function(data){
        var html = '';
        var diff = 0;
        var estado = '';
        var e = $.parseJSON(data);
        $.each(e, function(id, val){
           $('.paymentItems').html('');
           if(id!='ERROR'){
               var count = 1;
               var tipo;
               var total = 0;
                $('.paymentItems').slideUp(200, function(){
                   $.each(val, function(k, a){
                       tipo = "";
                       total = (total*1 + a.abono_pago*1)*1
                       html = '<tr>';
                       html+= '<td>'+count+'</td>';
                       count++;
                       html+= '<td>'+a.fecha_abono_pago+'</td>';
                       html+= '<td><strong>'+a.abono_pago+'</strong></td>';
                       html+= '<td><strong>'+a.saldo_pago+'</strong></td>';
                       html+= '<td>'+a.nombre_empleado+'</td>';
                       html+= '<td>'+a.nombre_usuario+'</td>';
                       if(a.pie_pago==1){
                            tipo = "PIE"
                       }else{
                            tipo = "ABONO"
                       }
                       html+= '<td>'+tipo+'</td>';
                       html+= '</tr>';
                       $('.paymentItems').append(html).show();
                   });
                });
                $('#total span').html('$'+total);
           }else{
                $('.paymentItems').attr('style','');
                $('.paymentItems').append('<tr><td colspan="6"><center>'+val.msg+'</center></td></tr>');

           }

        });
    });
}

function loadSaleSubscription(saleid,showafterrequest){
    $('.subscriptionItems').html('<tr><td colspan="6"><center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></center></td></tr>').hide(200);
    $.post('?load=sales&action=getSaleSubscription&ajaxRequest',
    {
        saleid:""+saleid+""
    },
    function(data){
        var html = '';
        var diff = 0;
        var estado = '';
        var e = $.parseJSON(data);
        $.each(e, function(id, val){
           $('.subscriptionItems').html('');
           $('.subscriptionItems').slideUp(200, function(){
                $.each(val, function(k, a){
                   html = '<tr>';
                   html+= '<td>'+a.num_vencimiento+'</td>';
                   html+= '<td>'+a.fecha_vencimiento+'</td>';
                   html+= '<td>'+a.cantidad_esti_vencimiento+'</td>';
                   html+= '<td>'+a.pago_ven_vencimiento+'</td>';
                   diff = a.cantidad_esti_vencimiento - a.pago_ven_vencimiento;
                   html+= '<td>'+diff+'</td>';
                   if(diff){
                       if(a.pago_ven_vencimiento!=0){
                           estado = "Saldo Pendiente";
                       }else{
                           estado = "Cuota Impaga";
                       }

                   }else{
                       estado = "Cancelado";
                   }
                   html+= '<td>'+estado+'</td>';
                   html+= '</tr>';
                   $('.subscriptionItems').append(html);
               });
           });
        });
	if(showafterrequest=="true"){
				$('.subscriptionItems').show(500);
	}
    });
}
