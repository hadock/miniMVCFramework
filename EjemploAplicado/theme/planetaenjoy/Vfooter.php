
            </div>
            <div id="push"></div>
</section>

    </div>

    <footer>
        <div id="footer-inner" class="container_8 clearfix">
            <div class="grid_8">
                <span class="fr"><a href="#">Documentation</a> | <a href="#">Feedback</a></span>Last account activity from 127.0.0.1 - <a href="#">Details</a> | &copy; 2010. All rights reserved. Theme design by VivantDesigns
            </div>
        </div>
    </footer>
    <!-- simple dialog -->
    <a class="modalInput" rel="#simpledialog" id="showmessage"></a>
    <div class="widget modal" id="simpledialog">
        <header><h2>Atenci&oacute;n</h2></header>
        <section>
            <p class="simpledialogtext">
                &iquest;Est&aacute; seguro que desea realizar esta acci&oacute;n?
            </p>

            <!-- yes/no buttons -->
            <center>
            <p>
                    <button class="button button-blue close okclick">Aceptar</button>
                    <!--<button class="button button-gray close">No</button>-->
            </p>
            </center>
        </section>
    </div>
    <!-- yes/no dialog -->
     <a class="modalInput" rel="#yesno" id="showmessage_yesno"></a>
    <div class="widget modal" id="yesno">
        <header><h2>Confirmar</h2></header>
        <section>
            <p class="modaldialogtext">
                &iquest;Est&aacute; seguro que desea proceder?
                Presione la tecla ESCAPE para cancelar
            </p>

            <!-- yes/no buttons -->
            <p>
                <button class="button button-blue close yesclick">Si</button>
                <button class="button button-gray close noclick">No</button>
            </p>
        </section>
     </div>

     <!-- user input dialog -->
     <div class="widget modal" id="prompt">
         <header><h2>Ingreso</h2></header>
         <section>
             <p class="inputdialogtext">
                 Ingrese el valor solicitado.
                 Presione la tecla ESCAPE para cancelar
             </p>

             <!-- input form. you can press enter too -->
             <form>
                 <input type="text" />
                 <hr />
                 <button class="button button-gray" type="submit">Aceptar</button>
                 <button class="button button-gray close" type="button">Cancelar</button>
             </form>
         </section>
      </div>
      <script lang="Javascript" type="text/javascript">
	$("document").ready(function(){
		var showmsg = false;
		$(window).unload(function(e){
			if(showmsg){
				alert("cerrando ventana");
                                return false;
			}
		});
                $(window).keydown(function(e){
                    if(e.which == 116){
                        showmsg = false;
                    }
                });
		$(window).mouseleave(function(){
			showmsg = true;
		});
		$("body").mouseenter(function(){
			showmsg = false;
		});
		$("body").mouseover(function(){
			showmsg = false;
		});
	});
	/*
	window.onbeforeunload = function() {
		alert("desconectando");
	*/
      </script>
</body>
</html>
