<body class="login">
    <div class="login-box main-content">
        <header><h2>ACCESO - E.R.P Casa Madelynn</h2></header>
    	<section>
            <div class="message info">Ingrese nombre de usuario/contrase&ntilde;a</div>
    		<form id="loginform" action="?action=doLogin" method="post" class="clearfix">
			<p>
				<input type="text" id="username"  class="full" value="" name="username" required="required" placeholder="Usuario" />
			</p>
			<p>
                            <input type="password" id="password" class="full" value="" name="password" required="required" placeholder="password" />
			</p>
			<p class="clearfix">
				<span class="fl">
					<input type="checkbox" id="remember" class="" value="1" name="remember"/>
					<label class="choice" for="remember">Recordarme</label>
				</span>

				<button class="button button-gray fr" type="submit">Entrar</button>
			</p>
		</form>
            <ul><li><strong>AYUDA!</strong>&nbsp;<a href="#">Olvid&eacute; mi Contrase&ntilde;a</a></li></ul>
    	</section>
    </div>
</body>
</html>