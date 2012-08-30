
<section class="main-section grid_7">
    
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="./documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
            </ul>
            <h2>
                Men&uacute; Principal -> Exportaci&oacute;n de Registros
            </h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <h3>Este m&oacute;dulo le permite gestionar las exportaciones de datos a excel seg&uacute;n par&aacute;metros</h3>
                <h4><strong> IMPORTANTE!!!.. La exportaci&oacute;n solo contempla los juegos cerrados.</strong></h4>
                <hr />
                <div class="message info">
                    <h3>Exportar transacciones por tipo</h3>
                    <span>Seleccione la fecha de inicio y t&eacute;rmino para exportar, <br> Asegurese de seleccionar la opci&oacute;n correcta en <strong>Tipo de Exportaci&oacute;n</strong> </span>
                        <p>
                        <form action="?load=export&action=byTypeandDate" method="POST" target="filereceiver" enctype="multipart/form-data" accept-charset="UTF-8">
                            Desde:
                            <input type="date" id="fromdate" name="fromdate" required="required">
                            A las:
                            <select name="fromhour" id="fromhour">
                                <?php 
                                for($x=0;$x<24;$x++){
                                    $valor = "";
                                    if($x<10){
                                        $valor = '0'.$x;
                                    }else{
                                        $valor = $x;
                                    }
                                ?>
                                    <option value="<?=$valor?>">
                                    <?=$valor?>
                                    </option>
                                <?php 
                                }
                                ?>
                            </select>
                            :
                            <select name="fromminutes" id="fromminutes">
                                <?php 
                                for($x=0;$x<60;$x++){
                                    $valor = "";
                                    if($x<10){
                                        $valor = '0'.$x;
                                    }else{
                                        $valor = $x;
                                    }
                                ?>
                                    <option value="<?=$valor?>">
                                    <?=$valor?>
                                    </option>
                                <?php 
                                }
                                ?>
                            </select>
                            -
                            Hasta:
                            <input type="date" id="todate" name="todate" required="required">
                            A las:
                            <select name="tohour" id="tohour">
                                <?php 
                                for($x=0;$x<24;$x++){
                                    $valor = "";
                                    if($x<10){
                                        $valor = '0'.$x;
                                    }else{
                                        $valor = $x;
                                    }
                                ?>
                                    <option value="<?=$valor?>">
                                    <?=$valor?>
                                    </option>
                                <?php 
                                }
                                ?>
                            </select>
                            :
                            <select name="tominutes" id="tominutes">
                                <?php 
                                for($x=0;$x<60;$x++){
                                    $valor = "";
                                    if($x<10){
                                        $valor = '0'.$x;
                                    }else{
                                        $valor = $x;
                                    }
                                ?>
                                    <option value="<?=$valor?>">
                                    <?=$valor?>
                                    </option>
                                <?php 
                                }
                                ?>
                            </select>
                            <br>
                            <br>
                            <center>
                                <select id="tipoexportacion" name="tipoexportacion">
                                    <option value="0">Tipo de Exportaci&oacute;n</option>
                                    <option value="1">Solo tracking autom&aacute;tico</option>
                                    <option value="2">Solo apuestas de clientes</option>
                                    <option value="3">Todas las transacciones</option>
                                </select>
                                <button class="button button-blue" type="submit">Exportar</button>
                            </center>
                                
                        </form>
                            
                        </p>
                </div>

                <div class="message success">
                    <h3>Exportar Transacciones realizadas por un usuario</h3>
                    <span>Esta secci&oacute;n le permite exportar las transacciones realizadas por un usuario o tracking autom&aacute;tico asociado a este mismo</span>
                    <p>
                        <label for="fromdate" >Desde:</label>
                        <input type="date" id="fromdate" name="fromdate">
                        A las:
                        <select name="fromhour" id="fromhour">
                            <?php 
                            for($x=0;$x<24;$x++){
                                $valor = "";
                                if($x<10){
                                    $valor = '0'.$x;
                                }else{
                                    $valor = $x;
                                }
                            ?>
                                <option value="<?=$valor?>">
                                <?=$valor?>
                                </option>
                            <?php 
                            }
                            ?>
                        </select>
                        :
                        <select name="fromminutes" id="fromminutes">
                            <?php 
                            for($x=0;$x<60;$x++){
                                $valor = "";
                                if($x<10){
                                    $valor = '0'.$x;
                                }else{
                                    $valor = $x;
                                }
                            ?>
                                <option value="<?=$valor?>">
                                <?=$valor?>
                                </option>
                            <?php 
                            }
                            ?>
                        </select>
                        -
                        <label for="todate" >Hasta:</label>
                        <input type="date" id="todate" name="tomdate">
                        A las:
                        <select name="tohour" id="tohour">
                            <?php 
                            for($x=0;$x<24;$x++){
                                $valor = "";
                                if($x<10){
                                    $valor = '0'.$x;
                                }else{
                                    $valor = $x;
                                }
                            ?>
                                <option value="<?=$valor?>">
                                <?=$valor?>
                                </option>
                            <?php 
                            }
                            ?>
                        </select>
                        :
                        <select name="tominutes" id="tominutes">
                            <?php 
                            for($x=0;$x<60;$x++){
                                $valor = "";
                                if($x<10){
                                    $valor = '0'.$x;
                                }else{
                                    $valor = $x;
                                }
                            ?>
                                <option value="<?=$valor?>">
                                <?=$valor?>
                                </option>
                            <?php 
                            }
                            ?>
                        </select>
                        <br>
                        <br>
                        <center>
                            <select name="jefe">
                                <?php
                                foreach($params['listaJefes']['tbl_usuario'] as $key => $values):
                                ?>
                                <option value="<?=$values['id_usuario']?>">
                                <?=$values['nombre_usuario']?>
                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <button class="button button-green" type="submit">Exportar</button>
                        </center>
                        
                        
                    </p>
                </div>
                <iframe width="0px" height="0px" src="#" name="filereceiver" id="filereceiver"></iframe>
            </div>
        </section>
    </div>
</section>

                <!-- Main Section End -->