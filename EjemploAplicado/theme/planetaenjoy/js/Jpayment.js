$('#document').ready(function(){
   $("#chargeman").keyup(function(key){
        $(".searchResult").html('<center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></center>').fadeIn(500, function(){
            $.post('?load=search&action=sellerByName&ajaxRequest',{
                sellerName: ""+ $("#chargeman").val() +""
            },
            function(data){
                var obj = $.parseJSON(data);
                $(".searchResult").html('');
                $("#chargemanId").removeAttr('value','');
                if(obj=='empty'){
                    $(".searchResult").html('');
                    $(".searchResult").slideUp(500);
                    return false;
                }
                var html = "";
                var error = false;
                html+='<ul class="listResult">';
                $.each(obj, function(key, val){
                    if(key!="error"){
                        html+='<li class="dropdown"><span>'+val.run_empleado+'&nbsp;</span><p>'+ val.nombre_empleado.toUpperCase()+'</p></li>';
                    }else{
                        html=val;
                        error = true;
                    }
                });
                if(!error){
                    html+="</ul>";
                }
                $(".searchResult").html(html);
                $(".searchResult").slideDown(500);
                return true;
            });
        });
    });
     $(".searchResult").click(function(){
        $("#chargeman").val('');
        $("#chargeman").blur();
        $("#chargemanId").attr('value',$(".dropdown:hover span").html().replace("&nbsp;",""));
            $(".selectedchargeman").fadeOut(500, function(){
               var html = $(".dropdown:hover").html();
               $(".searchResult").slideUp(500, function(){
                    $(".selectedchargeman").html(html).fadeIn(600);
                });
            });
    });

    $('.subscriptions #showhide').click(function(){
        $('.subscriptionItems').toggle();
    });
    $('.payments #showhide').click(function(){
        $('.paymentItems').toggle();
    });

    $('#save').click(function(){
        $('.downbuttons').append('<div class="loading" style="float: left;"><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></div>');
        $.post('?load=payment&action=savePayment&ajaxRequest',
            {
                saleid:""+$('#saleid').val()+"",
                chargemanid:""+$('#chargemanId').val()+"",
                paymentAmount:""+$('#paymentAmount').val()+"",
                paymentDate:""+$('#paymentDate').val()+"",
                observations:""+$("#observations").html()+""
            },
            function(data){
                var obj = $.parseJSON(data);
                var html = "";
                $('.loading').remove();
                $.each(obj, function(key, val){
                   if(key=="errmsg"){

                       html = "<ul>";
                       $.each(val, function(num, msg){
                            html+= "<li>"+msg+"</li>";
                       });
                       html+="</ul>";

                       $(".simpledialogtext").html(html);
                       $("#showmessage").click();
                   }

                   if(key=="successful"){
                       html = "";
                       html+="<h4>"+val.msg+"</h4>";
                       $(".simpledialogtext").html(html);
                       $("#showmessage").click();
                        $('#paymentAmount').val('');
                        loadSaleSubscription($('#saleid').val());
                        loadPayments($('#saleid').val());
                   }

                });
            });
    });
});
function loadSaleInfo(saleid){
    $.post('?load=sales&action=getSaleInfo&ajaxRequest',{
        saleid:""+saleid+""
    },
    function(data){
        var obj = $.parseJSON(data);
        $.each(obj, function(row, array){
            if(row!='ERROR'){
                $.each(array, function(key, response){
                    $('#saleid').val(saleid);
                    $("#form-sale #name").html(response.nombre_cliente);
                    $("#form-sale #lastnames").html(response.apellido_cliente + ' ' + response.apellido1_cliente);
                    $("#form-sale #address").html(response.direccion_cliente);
                    $("#form-sale #phone").html(response.fono_cliente);
                    $("#form-sale #workplace").html(response.lugar_trabajo_cliente);
                    $("#form-sale #city").html(response.nombre_ciudad);
                    $("#form-sale #zone").html(response.nombre_zona);
                    $("#form-sale #evaluation").html(response.tipo_evaluacion);
                    $("#form-sale .clientInfo").fadeIn(500, function(){
                        getChargeMenInfo(response.id_zona_cliente);
                        loadSaleSubscription(saleid);
                        loadPayments(saleid);
                    });
                });
            }else{
                $(".simpledialogtext").html('<p>'+array.msg+'</p>');
                $("#showmessage").click();
            }
        });
    });
}

function getChargeMenInfo(zoneid){
    $.post('?load=search&action=chargeMenInfoByZone&ajaxRequest',
            {
                zoneid:""+zoneid+""
            },
            function(data){
                var e = $.parseJSON(data);
                var html = "";
                $.each(e, function(id, val){
                    $.each(val, function(row, fields){
                        html+= '<span>'+fields.idempleado+'&nbsp;</span><p>'+ fields.nombre.toUpperCase()+'</p>'
                        $("#chargemanId").attr('value',fields.idempleado.replace("&nbsp;",""));
                    });
                });
                $('.selectedchargeman').html(html).fadeIn(200);
            }
          );
}

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
    $('.subscriptionItems').html('<tr><td colspan="6"><center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></center></td></tr>').hide(500);
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

