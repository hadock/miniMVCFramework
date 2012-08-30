$('#document').ready(function(){
    $('#form-addClientObservation').submit(function(e){
        e.preventDefault();
        if($('#observation_text').val()!=""){
            $.post('?load=clients&action=addObservation',
                    {
                        txtobservation:""+$('#observation_text').val()+"",
                        clientid:""+$('#idclient').val()+""
                    },function(){
                        $('#observation_text').val('');
                        getClientObs($('#idclient').val());
                    });
        }
    });

    $('.getSaledetails').click(function(){
        var saleid = $(this).attr('rel');
        $('.Saledetails').slideDown('500', function(){
            loadSaleSubscription(saleid,"true");
            loadPayments(saleid);
        });
    });
});

function  changeEvaluation(clientid, evtypeid){
    $.post('?load=clients&action=changeClientEvaluation&ajaxRequest',
           {
               clientid:""+clientid+"",
               evalid:""+evtypeid+""
           },
           function(data){
                var e = $.parseJSON(data);
                $.each(e, function(result, obj){
                    $(".simpledialogtext").html('<h3>'+obj.msg+'</h3>');
                    $("#showmessage").click();
                    if(result=="SUCCESS"){
                        getClientObs(clientid);
                    }
                });
           }
          );
}

function getClientObs(clientid){
    $('.clientObservations').html('<center><img src="'+theme_dir+'/images/loading.gif" alt="Cargando"></center>').fadeIn('500', function(){
        $.post('?load=clients&action=getClientObs&ajaxRequest',
               {
                   clientid:""+clientid+""
               },
               function(data){
                   $('.clientObservations').html('');
                   var e = $.parseJSON(data);
                    $.each(e, function(result, obj){
                        if(result!="ERROR"){
                            var html = "";
                            html+='<div class="message success">';
                            html+='<p>Observaci&oacute;n: <strong>'+obj.texto_obs+'</strong></p>';
                            html+='<p>Fecha: <strong>'+obj.fecha_obs+'</strong></p>';
                            html+='<p>Publicado por: <strong>'+obj.user_obs+'<strong></p>';
                            html+='</div>';
                            $('.clientObservations').append(html).fadeIn(500);
                        }else{
                            var html2 = "";
                            html2+='<div class="message error">';
                            html2+='<p>'+obj.msg+'</p>';
                            html2+='</div>';
                            $('.clientObservations').append(html2).fadeIn(500);
                        }
                    });
               }
              );
    });
}

function getZones(cityid, selected){
            $.post('?load=clients&action=getZoneList&ajaxRequest', {
                city: ""+cityid+"",
                selected: ""+selected+""
            },
            function(data) {
                var items = [];
                  $.each(data, function(key, val) {
                      if(key){
                          $.each(val, function(ind, info){
                            items.push('<option value="' + info['id_zona'] + '" '+info['selected']+'>' + info['nombre_zona'].toUpperCase() + '</option>');
                          });
                        $('#zone').html(items.join(''));
                      }
                  });
            },
            "json"
            );
}

function getClientInfo(rut, callback){
    $.post('?load=clients&action=getClientInfo&ajaxRequest',{
        rut:""+rut+""
    },
    function(data){
        var obj = [];
        obj = $.parseJSON(data)
        $.each(obj, function(key, val) {
           if(key!="ERROR"){
                $.each(val, function(ind, info){
                    callback(info,false);
                });
           }else{
                    callback(val,true);
           }
           
        });
    });
}
