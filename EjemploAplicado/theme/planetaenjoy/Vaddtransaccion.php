<!-- Main Section -->
<style type="text/css">
<!--
.Estilo5 {
	color: #CC0000;
	font-weight: bold;
}
-->
</style>
<script type="text/javascript" lang="Javascript">
$("document").ready(function(){
    <?php
    if($params['transaccion']['tipo'] == 'nueva_apuesta'){
    ?>
            $("#idtarjeta").val("<?=$params['transaccion']['datos']['idtarjeta']?>");
            $("#idtarjeta").attr("readonly","readonly");
            getclientinfo("<?=$params['transaccion']['datos']['idtarjeta']?>");
            $(".tarjeta").hide();
    <?php
    }else{
    ?>
    $("#idtarjeta").focus();
    $("#idtarjeta").keypress(function(event){
        var key = event.which;
        if ( key == 13 ) {
            event.preventDefault();
            getclientinfo(this.value);
            $("#listajuegos").focus();
            return false;
        }
    });
    <?php
    }
    ?>
});
</script>


<section class="main-section grid_7">

    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="./documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
            </ul>
            <h2>
                TRACKING ON-LINE: Nuevo Ingreso
            </h2>
        </header>
        <section class="container_7 clearfix">
            <div class="trackinglista">
                <?php
                if(isset($_GET['idjuego'])){
                    $idjuego = "&idjuego=".$_GET['idjuego'];
                }else{
                    $idjuego = "";
                }
                ?>
                <form class="grid_4" action="?load=transaccion&action=guardar_registro<?=$idjuego?>" enctype="multipart/form-data" method="POST">
                    <fieldset>
                        <legend>Formulario de Registro</legend>
                        <?php
                        if(isset($_GET['error'])){
                        ?>
                        <div class="message error">
                        <h3>Se a producido un error...</h3>
                        <p><?=base64_decode($_GET['m'])?></p>
                        </div>
                        <?
                        }
                        ?>
                        <table>
                            <tr>
                                <td>
                                    <!-- FORMULARIO -->
                                    <table width="450px" border="0" align="center">
                                        <tr class="tarjeta">
                                            <td width="263" height="33">Deslice Tarjeta De Cliente </td>
                                            <td colspan="3">
                                            <div align="left">
                                                <input type="password" name="tarjeta" id="idtarjeta"/>
                                            </div></td>
                                        </tr>
                                        <?php
                                        if($params['mostrarlistajuegos']){
                                        ?>
                                        <tr>
                                            <td height="33">Juego</td>
                                            <td colspan="3">

                                            <div align="left">
                                                    <select name="juego" id="listajuegos">
                                                    <?php
                                                    foreach($params['Juegos'] as $key => $values):
                                                        if($values['selected']){
                                                            $selected = "selected = \"selected\"";
                                                        }else{
                                                            $selected = "";
                                                        }
                                                    ?>
                                                    <option <?=$selected?> value="<?=$values['id_tipo_juego']?>">
                                                    <?=$values['nombre_juego']?>
                                                    </option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                    </select>
                                            </div></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td height="35">Apuesta Promedio Tradicional</td>
                                            <td colspan="3">

                                            <div align="left">
                                                <input type="radio" value="tradicional" checked="checked" name="tipo_apuesta">
                                                <select name="aptradicional">
                                                <?php
                                                    foreach($params['tradicional']['tbl_apuesta_prom'] as $key => $values):
                                                    ?>
                                                <option value="<?=$values['id_apuesta_prom']?>">
                                                <?=$values['valor_apuesta_prom']?>
                                                </option>
                                                <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div></td>
                                        </tr>
                                        <tr>
                                            <td height="31">Apuesta Promedio VIP </td>
                                            <td colspan="1">

                                            <div align="left">
                                                <input type="radio" value="vip" name="tipo_apuesta">
                                                <select name="apvip">
                                                <?php
                                                    foreach($params['vip']['tbl_apuesta_prom'] as $key => $values):
                                                    ?>
                                                <option value="<?=$values['id_apuesta_prom']?>">
                                                <?=$values['valor_apuesta_prom']?>
                                                </option>
                                                <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div></td>
                                        </tr>
                                        <tr>
                                            <td height="39">Observaciones</td>
                                            <td colspan="1">
                                            <div align="left">
                                                <textarea name="observacion"></textarea>
                                            </div></td>
                                        </tr>                
                                        
                                    </table>
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;
                                </td>
                                <td>
                                     <form class="grid_4 container_5" action="">
                                        <fieldset>
                                            <legend>Datos del cliente</legend>
                                            <table width="300px" border="0" align="center">
                                                <tr>
                                                    <td height="29">ID Cliente </td>
                                                    <td colspan="3">
                                                    <div align="left">
                                                        <input type="text" readonly="readonly" name="idcliente" id="idcliente" />
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                    <td width="263" height="33">Nombre </td>
                                                    <td colspan="3">
                                                    <div align="left">
                                                        <input type="text" name="nombre" id="nombre_cliente" readonly="readonly" />
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                    <td width="263" height="33">Categor&iacute;a </td>
                                                    <td colspan="3">
                                                    <div align="left">
                                                        <input type="text" name="categoria" id="categoria_cliente" readonly="readonly" />
                                                    </div></td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                     </form>
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

<!-- Main Section End -->
