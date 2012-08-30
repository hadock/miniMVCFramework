<div class="container_8 clearfix">
                <!-- Sidebar -->

                <aside class="grid_1">

                    <nav class="global">
                        <ul class="clearfix">
                            <li<?php if($params['MainSelected']['Lista']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-house" href="?load=trackinglist">
                                    <span><?=$params['cuentajuegos']?></span>
                                    Lista Tracking
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['Juegos']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-tick" href="#?load=juegos">
                                    Juegos
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['Nuevo']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-payment" href="?load=transaccion&action=mostrarForm&extraview=Vaddtransaccion">
                                    Nueva Apuesta
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['Exportar']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-sale" href="?load=export">
                                    <span>0</span>
                                    Exportar
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!--
                    <nav class="subnav recent">
                        <h4>Ventas Recientes</h4>
                        <ul class="clearfix">
                            <?php foreach($params['LastSales']['COMPRA v, CLIENTE c, FOLIO f'] as $key => $value): ?>
                            <li>
				<form id="form_<?=$value['id_cliente']?>" action="?load=clients&action=show_client_history&extraview=Vclienthistory" method="POST" enctype="multipart/form-data">
		                        <a class="contact" onclick="document.getElementById('form_<?=$value['id_cliente']?>').submit();" href="#"><h5><?=$value['numero_folio']?></h5><h6><?=$value['nombre_cliente']?></h6></a>
					<div class="tooltip left">
			                    <span class="avatar">
			                    </span>
			                    <h5><?=$value['nombre_cliente']?></h5>
			                    <h6><?=$value['id_cliente']?></h6>
			                    <address><?=$value['direccion_cliente']?></address>
			                </div>
					<input type="hidden" value="<?=$value['id_cliente']?>" name="clientid">
				</form>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                    -->
                    <!--
                    <nav class="subnav">
                        <h4>Style Templates</h4>
                        <ul class="clearfix">
                            <li><a href="./layouts.html">Layouts</a></li>
                            <li><a href="./styles.html">Styles</a></li>
                            <li><a href="./forms.html">Forms</a></li>
                            <li><a href="./tables.html">Tables</a></li>
                        </ul>
                    </nav>
                    -->
                </aside>

                <!-- Sidebar End -->
