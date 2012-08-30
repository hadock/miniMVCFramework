<!-- Main Section -->

<section class="main-section grid_7">

    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="./documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
            </ul>
            <h2>
                Men&uacute; Principal -> Lista
            </h2>
        </header>
        <section class="container_6 clearfix">
            <div class="trackinglista">
                <table class="datatable paginate sortable" border="0" align="center">
                    <thead>
                        <tr>
                            <th width="35" height="23" scope="col"><span class="Estilo6">Transacciones</span></th>
                            <th width="200" scope="col"><span class="Estilo6">Cliente </span></th>
                            <th width="35" scope="col"><span class="Estilo6">Jugando </span></th>
                            <th width="150" scope="col"><span class="Estilo6">Registrado por</span></th>
                            <th width="60" scope="col"><span class="Estilo6">Fecha</span></th>
                            <th width="45" scope="col"><span class="Estilo6">Hora</span></th>
                            <th width="65" scope="col"><div align="center"><span class="Estilo6">Monto Acumulado</span></div></th>
                            <th width="175" scope="col"><span class="Estilo6">Acci&oacute;n</span></th>
                        </tr>
                    </thead>
                    <?php
                    foreach($params['lista'] as $key => $value):
                    ?>
                    <tr class="tableresult">
                            <td>
                                <a class="button button-gray" href="?load=transaccion&action=mostrarlista&idjuego=<?=$value['id_juego']?>&extraview=Vtransaccionlist">
                                    <span class="view-list"></span>Ver
                                </a>
                            </td>
                            <td>
                                <?=$value['nombre_cliente']?>
                            </td>
                            <td>
                                <?=$value['nombre_juego']?>
                            </td>
                            <td>
                                <?=$value['nombre_usuario']?>
                            </td>
                            <td>
                                <?=cambiafecha_a_normal_inverida_cnguion($value['fecha_inicio'])?>
                            </td>
                            <td>
                                <?=$value['hora_inicio']?>
                            </td>
                            <td>
                                <?=$value['monto_acumulado']?>
                            </td>
                            <td align="center">
                                        <a class="button button-gray" href="#" onclick="document.location.href='?load=transaccion&action=cerrarForm&extraview=Vclosetransaccion&idjuego=<?=$value['id_juego']?>'" >
                                            <span class="bin" ></span>
                                            Cerrar
                                        </a>
                                        <a class="button button-gray" href="#" onclick="document.location.href='?load=transaccion&action=mostrarForm&extraview=Vaddtransaccion&idjuego=<?=$value['id_juego']?>'" >
                                            <span class="add" ></span>
                                            Apostar
                                        </a>
                                
                            </td>
                    </tr>
                    <?php
                endforeach;
                    ?>
                </table>
            </div>
        </section>
    </div>
</section>

<!-- Main Section End -->
