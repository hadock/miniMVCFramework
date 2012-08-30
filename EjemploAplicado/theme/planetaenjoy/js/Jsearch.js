function getSearchForm(nameofform, titleofsearch){
    $('.searchtitle').html(titleofsearch);
    $('.searchby').html('<img src="'+theme_dir+'images/loading.gif" alt="Autentificando" width="20px" />');
    $('.search').fadeIn('500', function(){
        $.post('?load=search&action=getSearchForm&extraview='+nameofform+'&ajaxRequest',{
           form: ""+nameofform+""
        }, function(data){
            if(data.length>0){
                $('.searchby').html(data);
            }
        });
    });

}
function doSearch(kindofsearch, fieldstosend){
    var arrayFields = [];
    var post = [];
    arrayFields = fieldstosend.toString().split(',');
    for (var i=0; i < arrayFields.length; i++) {
     post.push(arrayFields[i] + ':' + $('#'+arrayFields[i]).val());
    }
    $('.divresult').html('<img src="'+theme_dir+'images/loading.gif" alt="Autentificando" width="20px" />');
    $.post('?load=search&action='+kindofsearch+'&ajaxRequest',{
          filter: post.join(',')
        }, function(data){
            if(data.length>0){
                var obj = $.parseJSON(data);
                if(obj[0].length == 1){
                   var msg = '';
                   $.each(obj, function(key, val){
                       msg+= val;
                   });
                   $('.divresult').html('<div class="message error closeable"><span class="message-close"></span><h3>Lo siento...</h3><p>' + msg + '</p></div>');
                   setTimeout("$('.closeable').fadeOut('500');", 2500);
                    return false;
                }
                var html = '';
                html+='<table class= "datatable paginate sortable full">';
                html+=' <thead>';
                html+='     <tr>';
                html+='         <th> Rut  </th>';
                html+='         <th> Nombre </th>';
                html+='         <th> Apellidos  </th>';
                html+='         <th> Direcci&oacute;n </th>';
                html+='         <th> Tel&eacute;fono </th>';
                html+='         <th> Acci&oacute;n </th>';
                html+='     </tr>';
                html+=' </thead>';
                html+=' <tbody>';                
                var fields = [];
                  $.each(obj, function(key, val) {
                        fields.push('<tr>');
                        fields.push('<td>' + val.id_cliente + '</td>');
                        fields.push('<td>' + val.nombre_cliente +'</td>' );
                        fields.push('<td>' + val.apellido_cliente + ' ' + val.apellido1_cliente +'</td>' );
                        fields.push('<td>' + val.direccion_cliente +'</td>' );
                        fields.push('<td>' + val.fono_cliente +'</td>' );
                        fields.push('<td><ul class="action-buttons clearfix">\n\
                                          <li><a class="button button-gray no-text" href="?load=clients&action=form_create&extraview=Vaddclient&clirut='+val.id_cliente+'">Editar<span class="pencil"></span></a></li>\n\
                                          <li><a class="button button-gray no-text deleteClient" rel="'+val.id_cliente+'" href="javascript:void(0);">Eliminar<span class="bin"></span></a></li>\n\
                                          <li><form action="?load=clients&action=show_client_history&extraview=Vclienthistory" method="POST" enctype="multipart/form-data" id="form_goHistory_'+val.id_cliente+'"><input type="hidden" name="clientid" value="'+val.id_cliente+'"><a class="button button-gray no-text" onClick="document.getElementById(\'form_goHistory_\'+\''+val.id_cliente+'\').submit()" href="#">Historial<span class="view-list"></span></a></form></li>\n\
                                    </ul></td>' );
                      fields.push('</tr>');
                  });
                html+= fields.join('');
                html+=' </tbody>';
                html+='</table>'
                var buttons = "";
                buttons+='<center>';
                buttons+='<button class="button button-gray" type="button" onClick="imprimir()">Imprimir</button>';
                buttons+='<button class="button button-gray" type="button" onClick="$(\'.divresult\').fadeOut(500)">Cerrar</button>';
                buttons+='</center>';
                $('.divresult').html(html+buttons+'<br/>');
            }
            /*
             <ul class="action-buttons clearfix">

                                    <li><a class="button button-gray no-text" href="#">Edit<span class="pencil"></span></a></li>
              ?load=clients&action=form_create&extraview=Vaddclient&clirut='+val.id_cliente+'
                                    <li><a class="button button-gray no-text" href="#">Delete<span class="bin"></span></a></li>



                                    <li><a class="button button-gray no-text" href="#">List View<span class="view-list"></span></a></li>

                                </ul>
             **/
            return true;
        });
    
}