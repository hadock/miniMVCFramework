$(document).ready(function(){
   /*
   $("#loginform").validator({
    	position: 'top',
    	offset: [25, 10],
    	messageClass:'form-error',
    	message: '<div><em/></div>' // em element is the arrow
        });
    */


   $("#loginform").submit( function(){
        /*if($("#username").val()=="Usuario" || $("#password").val()=="Contraseña"){
            $('.message').removeClass('info');
            $('.message').addClass('error');
            $('.message').html('Los campos son obligatorios').fadeIn('500');
            return false;
        }*/

        $('.message').html('<img src="'+theme_dir+'images/loading.gif" alt="Autentificando" width="20px" /><span>Validando la Informaci&oacute;n</span>').fadeIn('500', function(){
            $.post('?action=doLogin&ajaxRequest', {
                username: ""+$("#username").val()+"",
                password: ""+$("#password").val()+""
            },
            function(data) {
                var items = [];

                  $.each(data, function(key, val) {
                      var error = false;
                      if(key=='error'){
                        $('.message').attr('class','message error');
                        items.push('<li id="' + key + '">' + val + '</li>');
                        error = true;
                        $('.message').html('<ul>'+items.join('')+'<ul>');
                      }else{
                          if(!error){
                            $('.message').attr('class','message success');
                            $('.message').html('Accediendo.. Espere un momento por favor...');
                            document.location.href = '?'+key+'='+val;
                            return false;
                          }

                      }
                  });
            },
            "json"
            );
        });
        

        return false;
   });
    
});

