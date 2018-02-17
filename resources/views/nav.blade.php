	<?php use App\Account; ?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				@if (Auth::guest())
					<li><a href="{{ url('/') }}">Inicio</a></li>
				@else
					<?php
						$user= Auth::user();	
					?>	
					<li><a href="{{ url('/home') }}">Inicio</a></li>
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Usuario<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{!! route('user.create') !!}" >Crear Usuario</a></li>
							<li><a href="{!! route('user.index') !!}" >Ver lista de usuarios</a></li>
						</ul>
					</li>
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Factura<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{!! route('user.create') !!}" >Crear Factura</a></li>
							<li><a href="{!! route('user.index') !!}" >Ver Facturas</a></li>
						</ul>
					</li>
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Producto<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{!! route('products.create') !!}" >Crear Producto</a></li>
							<li><a href="{!! route('products.index') !!}" >Ver Producto</a></li>
						</ul>
					</li>
					<li><a href="{!! route('user.index') !!}" >Crear Presupuesto</a></li>
					<li><a href="#" >Cantidad de materia prima</a></li>
					<li><a href="{{ url('/facturas-csv') }}" >Descargar relacion de ingresos</a></li>
					<li><a href="{!! route('empresa.index') !!}" >Lista de Empresas</a></li>
				@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">registrar</a></li> -->
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
						<img src="{{asset('/images/ssa.png')}}" height="25" width="30">
						Usuario {{ Auth::user()->firstName }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Salir de la sesión</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>