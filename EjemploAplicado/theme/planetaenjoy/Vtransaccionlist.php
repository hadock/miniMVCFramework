<!-- Main Section -->
<script type="text/javascript" lang="Javascript" >
    $("document").ready(function(){
        $("table.apuestas").paginate({
                                        rows: 10, 
                                        buttonClass: 'button-blue',
                                        buttonFirst: 'Recientes',
                                        buttonLast: 'Anteriores'
                                    });
        $("table.tracking").paginate({
                                        rows: 10, 
                                        buttonClass: 'button-blue',
                                        buttonFirst: 'Recientes',
                                        buttonLast: 'Anteriores'
                                    });
    });
</script>
<section class="main-section grid_7">

    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="./documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
            </ul>
            <h2>
                Men&uacute; Principal -> Historial de Transacciones -> <strong><?=$params['clienteJugando'][0]['nombre_cliente']?></strong>
            </h2>
        </header>
        <section class="container_4 clearfix">
            <div class="trackinglista">
                <table class="datatable">
                    <thead>
                        <tr>
                            <th>
                                Apuestas realizadas por el cliente
                            </th>
                            <th>
                                Tracking (Autom&aacute;tico)
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <td style="vertical-align: top;">
                            <!-- Tabla de apuestas realizadas por el usuario -->
                            <table class="apuestas datatable sortable" border="0" align="center">
                                <thead>
                                    <tr>
                                        <th width="60" scope="col"><span class="Estilo6">Fecha </span></th>
                                        <th width="35" scope="col"><span class="Estilo6">Hora </span></th>
                                        <th width="240" scope="col"><span class="Estilo6">Observaci&oacute;n</span></th>
                                        <th width="50" scope="col"><span class="Estilo6">Monto</span></th>
                                    </tr>
                                </thead>
                                <?php
                                foreach($params['listaApuestas'] as $key => $value):
                                ?>
                                <tr class="tableresult">
                                        <td>
                                            <?=$value['fecha_apuesta']?>
                                        </td>
                                        <td>
                                            <?=$value['hora_apuesta']?>
                                        </td>
                                        <td>
                                            <?=$value['observacion']?>
                                        </td>
                                        <td>
                                            $<?=number_format($value['monto_apuesta'])?>
                                        </td>
                                </tr>
                                <?php
                            endforeach;
                                ?>
                            </table>
                        </td>
                        <td style="vertical-align: top;">
                            <!-- tracking automatico realizado por sistema -->
                            <table class="tracking datatable sortable" border="0" align="center">
                                <thead>
                                    <tr>
                                        <th width="60" scope="col"><span class="Estilo6">Fecha </span></th>
                                        <th width="35" scope="col"><span class="Estilo6">Hora </span></th>
                                        <th width="240" scope="col"><span class="Estilo6">Observaci&oacute;n</span></th>
                                        <th width="50" scope="col"><span class="Estilo6">Monto</span></th>
                                    </tr>
                                </thead>
                                <?php
                                foreach($params['listaTracking'] as $key => $value):
                                ?>
                                <tr class="tableresult">
                                        <td>
                                            <?=$value['fecha_apuesta']?>
                                        </td>
                                        <td>
                                            <?=$value['hora_apuesta']?>
                                        </td>
                                        <td>
                                            <?=$value['observacion']?>
                                        </td>
                                        <td>
                                            $<?=number_format($value['monto_apuesta'])?>
                                        </td>
                                </tr>
                                <?php
                            endforeach;
                                ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="button button-gray" onclick="document.location.href='?load=transaccion&action=mostrarForm&extraview=Vaddtransaccion&idjuego=<?=$_GET['idjuego']?>'" >
                                <span class="add" ></span>
                                Agregar Apuesta
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</section>

<!-- Main Section End -->
