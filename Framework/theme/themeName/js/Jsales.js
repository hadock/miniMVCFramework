var showClientInfo = function callback(response, error){
    if(!error){
        if(response.id_evaluacion_cliente!=6){
            $("#form-client #name").html(response.nombre_cliente);
            $("#form-client #lastnames").html(response.apellido_cliente + ' ' + response.apellido1_cliente);
            $("#form-client #address").html(response.direccion_cliente);
            $("#form-client #phone").html(response.fono_cliente);
            $("#form-client #workplace").html(response.lugar_trabajo_cliente);
            $("#form-client #city").html(response.nombre_ciudad);
            $("#form-client #zone").html(response.nombre_zona);
            $("#form-client #evaluation").html(response.tipo_evaluacion);
            $("#form-client .clientInfo").fadeIn(500);
            $("#searchSeller").focus();
        }else{
            $(".simpledialogtext").html('<p>El cliente registra un historial de pago moroso</p>');
            $("#showmessage").click();
        }
    }else{
        $(".modaldialogtext").html(response.msg);
        $("#showmessage_yesno").click();
        $(".yesclick").click(function(){
            $('.addnewsaleform').slideUp(500, function(){
                $('.addnewclientform').slideDown(500, function(){
                   $('#form-addNewClient #rut').val($('#form-client #rut').val());
                   $('#form-addNewClient #name').focus();
                });
            });
        });
    }
    
}
function loadClientInfo(rut){
    getClientInfo(rut, showClientInfo);
}

$('#document').ready(function(){
    $("#searchSeller").keyup(function(key){
        $(".searchResult").html('<center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></center>').fadeIn(500, function(){
            $.post('?load=search&action=sellerByName&ajaxRequest',{
                sellerName: ""+ $("#searchSeller").val() +""
            },
            function(data){
                var obj = $.parseJSON(data);
                $(".searchResult").html('');
                $("#sellerId").removeAttr('value','');
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
        $("#searchSeller").val('');
        $("#searchSeller").blur();
        $("#sellerId").attr('value',$(".dropdown:hover span").html().replace("&nbsp;",""));
            $(".selectedSeller").fadeOut(500, function(){
               var html = $(".dropdown:hover").html();
               $(".searchResult").slideUp(500, function(){
                    $(".selectedSeller").html(html).fadeIn(600);
                }); 
            });
    });

    $("#searchAttributes").keyup(function(key){
        $(".searchResult2").html('<center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando" width="20px"/></center>').fadeIn(500, function(){
            $.post('?load=search&action=getArticlesByAttrs&ajaxRequest',{
                atributes: ""+ $("#searchAttributes").val() +""
            },
            function(data){
                var obj = $.parseJSON(data);
                $(".searchResult2").html('');
                if(obj=='empty'){
                    $(".searchResult2").html('');
                    $(".searchResult2").slideUp(500);
                    return false;
                }
                var html = "";
                var error = false;
                html+='<ul class="listResult2">';
                $.each(obj, function(key, val){
                    if(key!="error"){
                        html+='<li class="dropdown2">';
                        html+='<span><strong>COD:&nbsp;</strong></span>';
                        html+='<span id="codigo">'+val.codigo_producto+'</span>';
                        html+='<span>&nbsp;&nbsp;<strong>NOMBRE:</strong></span>';
                        html+='<div id="descripcion">'+ val.descripcion_producto.toUpperCase()+'</div>';
                        html+='<span><strong>PRECIO:</strong> $</span>';
                        html+='<div id="precio">'+val.precio_producto+'</div>';
                        html+='<span><strong>SALDO:</strong></span>';
                        html+='<div id="stock">'+val.stock_producto+'</div>';
                        html+='</li>';
                    }else{
                        html=val;
                        error = true;
                    }
                });
                if(!error){
                    html+="</ul>";
                }
                $(".searchResult2").html(html);
                $(".searchResult2").slideDown(500);
                return true;
            });
        });
    });

    $(".searchResult2").click(function(){
        $("#searchAttributes").val('');
        $("#searchAttributes").blur();
        var count = $("#items").val();
        count++;
        $("#items").val(count);

        var html = '';
        html+='<tr id="item_'+count+'" class="tablerow">';
        html+=' <td>'+$(".dropdown2:hover #codigo").html()+'<input type="hidden" id="cod_'+count+'" class="codigo" value="'+$(".dropdown2:hover #codigo").html()+'"><div class="close-button"></div></td>';
        html+=' <td>'+$(".dropdown2:hover #descripcion").html()+'</td>';
        html+=' <td>'+$(".dropdown2:hover #precio").html()+'</td>';
        html+=' <td><input type="number" rel="#qty_'+count+'" value="'+$(".dropdown2:hover #precio").html()+'" id="precio_'+count+'" class="inputTable price">';
        html+=' <td><input type="number" rel="#precio_'+count+'" value="1" id="qty_'+count+'" class="inputTable quantity"></td>'
        html+=' <td id="subamount_'+count+'" class="subamount" rel="#precio_'+count+'">'+$(".dropdown2:hover #precio").html()+'</td>'
        html+='</tr>'
        $(".cartItems").append(html);
        var script = "";
        script+= "$('.tablerow td').mouseover(function(){$('tr:hover .close-button').addClass('mousehover');});\n";
        script+= "$('.tablerow td').mouseout(function(){$('tr .mousehover').removeClass('mousehover');});\n";
        script+= "$('.close-button').click(function(){\n\
                                        $('.tablerow:hover').remove();\n\
                                        calcAmount();\n\
                                        var count = $('#items').val();\n\
                                        count--;\n\
                                        var x = 0;\n\
                                        count++;\n\
                                        var element = 0;\n\
                                        for(x=0;x<=count;x++){\n\
                                            var obj = document.getElementById('item_'+x);\n\
                                            if(obj != null){\n\
                                                element++;\n\
                                                obj.id = 'item_'+element;\n\
                                                $('#items').val(element);\n\
                                            }\n\
                                        }\n\
                                        if(element==0){\n\
                                            $('#items').val(element);\n\
                                        }\n\
                                    });\n";
        script+= "$('.quantity').keyup(function(e){\n\
                        var rel = document.getElementById(e.currentTarget.id).getAttribute('rel');\n\
                        var precio = $(rel).val();\n\
                        var cantidad = this.value;\n\
                        $('.subamount').each(function(e){\n\
                            var rel2 = document.getElementById(this.id).getAttribute('rel');\n\
                            if(rel2 == rel){\n\
                                this.innerHTML = precio * cantidad;\n\
                            } \n\
                        });\n\
                        calcAmount();\n\
                  });\n\
                  $('.price').keyup(function(e){\n\
                        var rel = document.getElementById(e.currentTarget.id).getAttribute('rel');\n\
                        $(rel).keyup();\n\
                  });";
        addScript(script);
        calcAmount();
        /*
        $("precio_"+count).keyup(function(key){
            if(key==13){
                alert("precio");
            }
        });*/
        $("#precio_"+count).focus();
        $("#precio_"+count).select();
        $(".searchResult2").slideUp(500);
    });
    
    $('#prepayment_cbo').change(function(val){
        if(val.currentTarget.value==1){
            $('.prepayment_div').fadeIn('500');
        }else{
            $('.prepayment_div').fadeOut('500');
        }
    });
    $('#prepayment_cbo').keyup(function(val){
        if(val.currentTarget.value==1){
            $('.prepayment_div').fadeIn('500');
        }else{
            $('.prepayment_div').fadeOut('500');
            $('#prepayment_txt').val('0');
        }
    });

    $('#btn_modify_clientInfo').click(function(){
        $('.addnewsaleform').slideUp(500, function(){
            $('.addnewclientform').slideDown(500, function(){
               var showdata = function show(response, error){
                   if(!error){
                       $('#form-addNewClient #rut').val(response.id_cliente);
                       $('#form-addNewClient #rut').attr('readonly','readonly')
                       $('#form-addNewClient #name').val(response.nombre_cliente);
                       $('#form-addNewClient #lastname').val(response.apellido_cliente);
                       $('#form-addNewClient #lastname2').val(response.apellido1_cliente);
                       $('#form-addNewClient #place').val(response.villa);
                       $('#form-addNewClient #street').val(response.calle);
                       $('#form-addNewClient #num_address').val(response.numero_casa);
                       $('#form-addNewClient #phone').val(response.fono_cliente);
                       $('#form-addNewClient #workplace').val(response.lugar_trabajo_cliente);
                       $('#form-addNewClient #notes').val(response.observaciones_cliente);

                       $('#form-addNewClient #city option').each(function(){
                           if(this.value == response.id_ciudad){
                               this.setAttribute('selected', 'selected');
                               getZones(this.value, response.id_zona_cliente);
                           }
                       });

                       $('#form-addNewClient #evaluation option').each(function(){
                           if(this.value == response.id_evaluacion_cliente){
                               this.setAttribute('selected', 'selected');
                           }
                       });
                       $('#form-addNewClient').attr('action','?load=clients&action=updateInfo&redirect=load@sales|action@form_create|extraview@Vaddsale|rut@'+response.id_cliente);
                   }else{

                   }
               }
               getClientInfo($('#form-client #rut').val(), showdata);
            });
        });
    });

    $('#sale').click(function(){
        var rows = [];
        count = 0;
        $('.tablerow').each(function(){
            rows.push([$('#'+this.id+' .codigo').val(), $('#'+this.id+' .price').val() * $('#'+this.id+' .quantity').val(), $('#'+this.id+' .quantity').val()]);
            count++;
        });
        var items = $.toJSON(rows);
        
        $.post('?load=sales&action=addNewSale&ajaxRequest',{
            id_cliente:""+ $('#form-client #rut').val() +"",
            id_vendedor:""+$('#sellerId').val()+"",
            first_pay_date:""+$('#firstpayment_txt').val()+"",
            sale_date:""+$("#sale_date").val()+"",
            subscription:""+$('#subscription').val()+"",
            payment_method:""+$('#payment_method').val()+"",
            total_amount:""+$('#amountVal').val()+"",
            observations:""+$('#observations').val()+"",
            prepayment_op:""+$('#prepayment_cbo').val()+"",
            prepayment: ""+$('#prepayment_txt').val()+"",
            items:""+items+""
        },
        function(data){
           var obj = $.parseJSON(data);
           var html = "";
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
                   html+="<center><h3><strong>"+val.saleid+"</strong></h3><center>";
                   $(".simpledialogtext").html(html);
                   $("#showmessage").click();
                   $(".okclick").click(function(){
                       document.location.href = val.redirect;
                   })
               }
           });
        });
        
    });

    $('#saveChanges').click(function(){
        var rows = [];
        count = 0;
        $('.tablerow').each(function(){
            rows.push([$('#'+this.id+' .codigo').val(), $('#'+this.id+' .price').val() * $('#'+this.id+' .quantity').val(), $('#'+this.id+' .quantity').val()]);
            count++;
        });
        var items = $.toJSON(rows);

        $.post('?load=sales&action=modify_sale&ajaxRequest',{
            saleid:""+$('#saleid').val()+"",
            id_cliente:""+ $('#form-client #rut').val() +"",
            id_vendedor:""+$('#sellerId').val()+"",
            first_pay_date:""+$('#firstpayment_txt').val()+"",
            sale_date:""+$("#sale_date").val()+"",
            subscription:""+$('#subscription').val()+"",
            payment_method:""+$('#payment_method').val()+"",
            total_amount:""+$('#amountVal').val()+"",
            observations:""+$('#observations').val()+"",
            prepayment_op:""+$('#prepayment_cbo').val()+"",
            prepayment: ""+$('#prepayment_txt').val()+"",
            items:""+items+""
        },
        function(data){
           var obj = $.parseJSON(data);
           var html = "";
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
                   html+="<center><h3><strong>"+val.saleid+"</strong></h3><center>";
                   $(".simpledialogtext").html(html);
                   $("#showmessage").click();
                   $(".okclick").click(function(){
                       document.location.href = val.redirect;
                   })
               }
           });
        });

    });

    $('.modifySale').click(function(){
        var html = "";
        html+= "<div class=\"message success modify-form\"><h3>Ingrese el Folio a Modificar</h3>";
        html+= "    <form action=\"?load=sales&action=form_modifySale&extraview=Vaddsale\" method=\"POST\" enctype=\"multipart/form-data\">";
        html+= "        <input type=\"number\" name=\"saleid\" required=\"required\">";
        html+= "        <button type=\"button\" onClick=\"modifySale();\" class=\"button button-gray\"><span class=\"pencil\"></span>Editar</button>";
        html+= "        <button type=\"button\" onClick=\"$('.action-form').slideUp('200',function(){$('.modify-form').remove()});\" class=\"button button-gray\">Cancelar</button>";
        html+= "    </form>";
        html+= "</div>";
        $('.action-form').slideDown('200', function(){
            $(this).html(html);
        });
    });
    $('.deleteSale').click(function(){
        var html = "";
        html+= "<div class=\"message success delete-form\"><h3>Ingrese el Folio a Eliminar</h3>";
        html+= "    <form action=\"?load=sales&action=deleteSale\" method=\"POST\" enctype=\"multipart/form-data\">";
        html+= "        <input type=\"number\" name=\"saleid\" required=\"required\">";
        html+= "        <button type=\"button\" onClick=\"deleteSale()\" class=\"button button-gray\"><span class=\"bin\"></span>Eliminar</button>";
        html+= "        <button type=\"button\" onClick=\"$('.action-form').slideUp('200',function(){$('.modify-form').remove()});\" class=\"button button-gray\">Cancelar</button>";
        html+= "    </form>";
        html+= "</div>";
        $('.action-form').slideDown('200', function(){
            $(this).html(html);
        });
    });
    $('.InvalidateSale').click(function(){
        var html = "";
        html+= "<div class=\"message success invalidate-form\"><h3>Ingrese el Folio a Anular</h3>";
        html+= "    <form action=\"?load=sales&action=invalidateSale\" method=\"POST\" enctype=\"multipart/form-data\">";
        html+= "        <input type=\"number\" name=\"saleid\" required=\"required\">";
        html+= "        <button type=\"button\" onClick=\"invalidateSale()\" class=\"button button-gray\"><span class=\"bin\"></span>Anular</button>";
        html+= "        <button type=\"button\" onClick=\"$('.action-form').slideUp('200',function(){$('.modify-form').remove()});\" class=\"button button-gray\">Cancelar</button>";
        html+= "    </form>";
        html+= "</div>";
        $('.action-form').slideDown('200', function(){
            $(this).html(html);
        });
    });
});
function modifySale(){
    if($('.modify-form input').val()==""||$('.modify-form input').val()=="0"){
        $(".simpledialogtext").html('<p>Debe ingresar el Folio a eliminar</p>');
        $("#showmessage").click();
    }else{
        $('.modify-form form').submit();
    }
}
function deleteSale(){
    if($('.delete-form input').val()==""||$('.delete-form input').val()=="0"){
        $(".simpledialogtext").html('<p>Debe ingresar el Folio a eliminar</p>');
        $("#showmessage").click();
    }else{
        $(".modaldialogtext").html('<p>&iquest;Est&aacute; seguro que desea realizar esta acci&oacute;n?<br/>Se eliminar&aacute;n todos los pagos realizados por este cliente</p>');
        $("#showmessage_yesno").click();
        $(".yesclick").click(function(){
            $('.delete-form form').submit();
        });
    }
}
function invalidateSale(){
    if($('.invalidate-form input').val()==""||$('.invalidate-form input').val()=="0"){
        $(".simpledialogtext").html('<p>Debe ingresar el Folio a eliminar</p>');
        $("#showmessage").click();
    }else{
         $(".modaldialogtext").html('<p>&iquest;Est&aacute; seguro que desea realizar esta acci&oacute;n?<br/>Esta acci&oacute;n provocar&aacute; que esta venta no sea considerada en los reportes financieros</p>');
        $("#showmessage_yesno").click();
        $(".yesclick").click(function(){
            $('.invalidate-form form').submit();
        });
    }
}

function calcAmount(){
    var suma = 0;
    $("td.subamount").each(function(index){
        suma+=$(this).text()*1;
        //alert(index + ': ' + $(this).text());
    });
    $("#amountVal").val(suma);
    $("#total span").html('$'+suma);
}

function enterKeyPress(fromelement, toelement){
    $("#"+fromelement).keyup(function(key){
        if(key==13){
            $("#"+toelement).focus(function(){
               $("#"+toelement).select();
            });
        }
    });
}

function addScript(text){
    var script   = document.createElement("script");
        script.type  = "text/javascript";
        script.textContent = text;
        //script.src   = "path/to/your/javascript.js";
        document.body.appendChild(script);

        // remove from the dom
        document.body.removeChild(document.body.lastChild);
}

function getSaleInfo(saleid){
    $.post('load=sales&action=getSaleInfo&ajaxRequest',
            {
                saleid:""+saleid+""
            },
            function(data){
                
            });
}