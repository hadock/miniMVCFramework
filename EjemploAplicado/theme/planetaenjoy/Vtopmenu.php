<body>
    <div id="wrapper">
        <header>
            <div class="container_8 clearfix">
                <h1 class="grid_1"><a href="?load=trackinglist">Tracking</a></h1>
                <nav class="grid_5">
                    <ul class="clearfix">
                        <li class="action">
                            <script type="text/javascript" lang="Javascript">
                                $("document").ready(function(){
                                   $("#formAddCliente").submit(function(){
                                      $.post(this.action+"&ajaxRequest",{
                                          "idtarjetanueva":""+$("#idtarjetanueva").val()+"",
                                          "topcategorias":""+$("#topcategorias").val()+"",
                                          "idclientenuevo":""+$("#idclientenuevo").val()+"",
                                          "nombreclientenuevo":""+$("#nombreclientenuevo").val()+""
                                      },function(data){
                                          var obj = $.parseJSON(data);
                                          $.each(obj, function(id, val){
                                              $.each(val, function(cond, value){
                                                if(cond=="error"){
                                                    $("."+value.textin+"").html(value.msg);
                                                    $("#"+value.action+"").click();
                                                }
                                                if(cond=="idexiste"){
                                                    $("."+value.textin+"").html(value.msg);
                                                    $("#"+value.action+"").click();
                                                    $(".yesclick").click(function(){
                                                       $.post('?load=client&action=updateCliente&ajaxRequest',
                                                               {
                                                                "idtarjetanueva":""+$("#idtarjetanueva").val()+"",
                                                                "topcategorias":""+$("#topcategorias").val()+"",
                                                                "idclientenuevo":""+$("#idclientenuevo").val()+"",
                                                                "nombreclientenuevo":""+$("#nombreclientenuevo").val()+""
                                                               },
                                                               function(data){
                                                                   var ob = $.parseJSON(data);
                                                                   $.each(ob, function(ids, vals){
                                                                        $.each(vals, function(con, values){
                                                                            if(con=="success"){
                                                                                $("."+values.textin+"").html(values.msg);
                                                                                $("#"+values.action+"").click();
                                                                                $("#"+values.focusinput).focus();
                                                                                var cardid = $("#"+values.focusinput).val();
                                                                                $(".cerrarform").click();
                                                                                getclientinfo(cardid);
                                                                            }else{
                                                                                $(".simpledialogtext").html("A ocurrido un error desconocido durante el proceso");
                                                                                $("#showmessage").click();
                                                                            }  
                                                                        });
                                                                   });
                                                               }
                                                           );
                                                    });
                                                }
                                                if(cond=="success"){
                                                    $("."+value.textin+"").html(value.msg);
                                                    $(".cerrarform").click();
                                                    $("#"+value.action+"").click();
                                                    $("#"+value.focusinput).focus();
                                                    var cardid = $("#"+value.focusinput).val();
                                                    getclientinfo(cardid);
                                                }  
                                              });
                                                
                                          });
                                      });
                                      return false;
                                   });
                                });
                            </script>
                            <a href="#" class="has-popupballoon button button-blue" id="addcliente"><span class="add"></span>Registro Cliente</a>
                            <div class="popupballoon top">
                                <h3>Registro Cliente</h3>
                                <form action="?load=client&action=addNew" method="POST" id="formAddCliente">
                                    Tarjeta<br />
                                    <input type="text" id="idtarjetanueva" name="idtarjetanueva" readonly="readonly"/><br />
                                    Categor&iacute;a<br/>
                                    <select id="topcategorias" name="topcategorias">
                                        <option selected value="Classic">Classic</option>
                                        <option selected value="Silver">Silver</option>
                                        <option selected value="Gold">Gold</option>
                                        <option selected value="Platinum">Platinum</option>
                                        <option selected value="Diamond">Diamond</option>
                                    </select>
                                    Id Cliente<br />
                                    <input type="text" id="idclientenuevo" name="idclientenuevo" />
                                    Nombre Cliente<br />
                                    <input type="text" id="nombreclientenuevo" name="nombreclientenuevo" /><br />
                                    <hr />
                                    <button type="submit" class="button button-orange newcontact">Aceptar</button>
                                    <button type="reset" class="button button-gray close cerrarform">Cancelar</button>
                                </form>
                            </div>
                        </li>
                        <!--
                        <li class="action">
                            <a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Task</a>
                            <div class="popupballoon top">
                                <h3>Add new task</h3>
                                <input type="text" /><br /><br />
                                When it's due?<br />
                                <input type="date" /><br />
                                What category?<br />
                                <select><option>None</option></select>
                                <hr />
                                <button class="button button-orange">Add task</button>
                                <button class="button button-gray close">Cancel</button>
                            </div>
                        </li>
                        -->
                        <li <?php if($params['MainSelected']['main']) echo ' class="active" '; ?>><a href="?load=trackinglist">Principal</a></li>
                        <li <?php if($params['MainSelected']['profile']) echo ' class="active" '; ?>><a href="?load=user&action=getProfile">Mi Perf&iacute;l</a></li>
                        <li class="fr">
                            <a href="#">
                                <?php
                                if($params['welcome']['tbl_usuario'][0]['jefatura']==1){
                                    echo 'Jefe';
                                }
                                if($params['welcome']['tbl_usuario'][0]['jefatura']==0){
                                    echo 'Usuario';
                                }
                                ?>
                                <span class="arrow-down"></span>
                            </a>
                            <ul>
                                <!--
                                <li><a href="#">Account</a></li>
                                <li><a href="#">Users</a></li>
                                <li><a href="#">Groups</a></li>
                                -->
                                <li><a href="?load=login&action=doLogout">Cerrar Sesi&oacute;n</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <form class="grid_2">
                    <input style="visibility: hidden;" class="full" type="text" placeholder="Search..." />
                </form>
            </div>
        </header>
        
        <section>