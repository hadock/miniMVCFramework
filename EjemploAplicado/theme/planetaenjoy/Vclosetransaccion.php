<section class="main-section grid_7">

    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="./documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
            </ul>
            <h2>
                TRACKING ON-LINE: Cierre de Juego
            </h2>
        </header>
        <section class="container_7 clearfix">
            <div class="trackinglista">
                <form class="grid_5" action="?load=transaccion&action=cerrar_juego" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="idjuego" value="<?=$params['resumen'][0]['id_juego']?>">
                    <fieldset>
                        <legend>Formulario de Registro</legend>
                            <?php
                            if(isset($_GET['error'])){
                            ?>
                            <div class="message error">
                            <h3>Se a producido un error...</h3>
                            <p><?=  base64_decode($_GET['m'])?></p>
                            </div>
                            <?
                            }
                            ?>
                        <table>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <!-- FORMULARIO -->
                                                <table width="450px" border="0" align="center">
                                                    <tr>
                                                        <td height="36">Hora Termino </td>
                                                        <td width="371">
                                                            <div align="left">
                                                                <?php
                                                                    $hora = date("H");
                                                                    $minutos = date("i");
                                                                ?>
                                                                <input type="hidden" name="hora" value="<?=$hora?>">
                                                                <input type="hidden" name="minutos" value="<?=$minutos?>">
                                                                <select name="hora_cbo" id="hora" disabled="disabled">
                                                            <?php 
                                                                    for($x=0;$x<24;$x++){
                                                                        $valor = "";
                                                                        if($x<10){
                                                                            $valor = '0'.$x;
                                                                        }else{
                                                                            $valor = $x;
                                                                        }
                                                                        if($valor == $hora){
                                                                            $selected = "selected=\"selected\"";
                                                                        }else{
                                                                            $selected = "";
                                                                        }
                                                                    ?>
                                                            <option value="<?=$valor?>" <?=$selected?>>
                                                            <?=$valor?>
                                                            </option>
                                                            <?php 
                                                                    }
                                                                    ?>
                                                            </select>
                                                            :
                                                            <select name="minutos_cbo" id="minutos" disabled="disabled">
                                                            <?php 
                                                                    
                                                                    for($x=0;$x<60;$x++){
                                                                        $valor = "";
                                                                        if($x<10){
                                                                            $valor = '0'.$x;
                                                                        }else{
                                                                            $valor = $x;
                                                                        }
                                                                     if($valor == $minutos){
                                                                            $selected = "selected=\"selected\"";
                                                                        }else{
                                                                            $selected = "";
                                                                        }
                                                                    ?>
                                                            <option value="<?=$valor?>" <?=$selected?>>
                                                            <?=$valor?>
                                                            </option>
                                                            <?php 
                                                                    }
                                                                    ?>
                                                            </select>
                                                            <a href="javascript:void(0)" onclick="asignar_hora_combos('hora','minutos')">Ahora</a>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="263" height="30">Fecha Termino </td>
                                                        <td width="371">
                                                        <div align="left">
                                                            <input type="text" name="fecha_termino" value="<?=date('d/m/Y')?>" readonly="readonly">
                                                        </div></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="34">Jefe Responsable</td>
                                                        <td colspan="3">

                                                        <div align="left">
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
                                                        </div></td>
                                                    </tr>

                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="datatable" width="400px">
                                        <thead>
                                            <tr>
                                                <th colspan="4" align="center">
                                                    Resumen del Juego
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>Tiempo de Juego</strong>
                                                </td>
                                                <td>
                                                    <?=$params['resumen'][0]['tiempo_juego']?>
                                                </td>
                                                <td>
                                                    <strong>Monto Jugado</strong>
                                                </td>
                                                <td>
                                                    <?=$params['resumen'][0]['monto_total']?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Cliente</strong>
                                                </td>
                                                <td>
                                                    <?=$params['resumen'][0]['nombre_cliente']?>
                                                </td>
                                                <td>
                                                    <strong>Juego</strong>
                                                </td>
                                                <td>
                                                    <?=$params['resumen'][0]['nombre_juego']?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                                    
                        <table width="587" border="0" align="center">
                            <tr>
                                <td width="236">&nbsp;</td>
                                <td width="76">

                                    <div align="left">
                                    <input type="submit" name="Submit" value="Aceptar" />
                                    </div></td>
                            <td width="261"><input type="reset" name="Submit2" value="Cancelar" /></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            </div>
            
        </section>
    </div>
</section>
