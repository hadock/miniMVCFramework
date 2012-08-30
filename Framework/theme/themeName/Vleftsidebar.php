<div class="container_8 clearfix">
                <!-- Sidebar -->

                <aside class="grid_1">

                    <nav class="global">
                        <ul class="clearfix">
                            <li<?php if($params['MainSelected']['home']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-house" href="?load=welcome">
                                    Resumen
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['clients']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-contact" href="?load=clients">
                                    <span><?=number_format($params['clientsCount']['CLIENTE'][0]['total'])?></span>
                                    Clientes
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['sales']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-sale" href="?load=sales">
                                    <span><?=number_format($params['salesCount']['COMPRA'][0]['total'])?></span>
                                    Ventas
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['payments']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-payment" href="?load=payment">
                                    <span><?=number_format($params['paymentsCount']['PAGO'][0]['total'])?></span>
                                    Abonos
                                </a>
                            </li>
			<!--
                            <li<?php if($params['MainSelected']['contacts']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-book" href="?load=contacts">
                                    <span>2</span>
                                    Agenda
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['task']) echo ' class="active" '; ?>>
                                <a class="nav-icon icon-tick" href="?load=mytasks">
                                    <span>1</span>
                                    Tareas
                                </a>
                            </li>
                            <li<?php if($params['MainSelected']['notes']) echo ' class="active" '; ?>><a class="nav-icon icon-note" href="?load=mynotes">Notas</a></li>
			-->
                        </ul>
                    </nav>

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
