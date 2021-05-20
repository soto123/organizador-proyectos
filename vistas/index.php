<html>
	<head class=" h-100">
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	    <title>Tablero - organizador</title>
		<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
	</head>
	<body class=" h-100">
		<div id="app-7" class="h-100">
			<div class="container-fluid h-100">
				<div class="row h-100">
					<menu-navegacion v-bind:paginas="paginas"></menu-navegacion>
					<contenido v-bind:proyectos="proyectos" v-bind:tareas="tareas" v-bind:usuarios="usuarios" v-bind:estados="estados" titulo_vista="Titulo de vista"></contenido>
				</div>
			</div>	  	
		</div>
		<script type="text/javascript">
		
		var item_menu_nav = {
		  props: ['pagina'],
		  template: `<a class="nav-link text-white border active" v-bind:href="pagina.url">{{pagina.nombre}}</a>`
		};
		
		var menu_navegacion = {
			props: ['paginas'],
			template:`
			<div id="menu" class="bg-dark col-md-3 h-100">
				<img src="https://www.hatchtemuco.com/img/LogoTransaparente.png" alt="logo hatch" class="img-fluid p-5">
				<nav class="nav flex-column">
					<item-menu-navegacion v-for="pagina in paginas" v-bind:pagina="pagina" v-bind:key="pagina.id"></item-menu-navegacion>
				</nav>
			</div>
			`,
			components:{
				'item-menu-navegacion':item_menu_nav,
			}
		}
		
		var tarjetaDashboard = {
			props: ['contador'],
			template: `
				<div class="col-md-4 pl-2 pr-2 tarjeta-dashboard">
					<div class="card bg-light">
				      <div class="card-body">
				        <h5 class="card-title">Total de <slot></slot>:</h5>
				        <p class="card-text h3">{{contador}} activos.</p>
				        <a href="#" class="btn btn-primary">Ver más...</a>
				      </div>
				    </div>
				</div>
			`,
		}

		var proyectoFila = {
		  props: ['proyecto','estados','filtro_proyectos','filtro_proyectos_activo'],
		  template: `
		  <tr class="fila-proyecto" v-show="filtro_proyectos_activo == 0 || filtro_proyectos_activo == proyecto.estado">
		  	<th>{{proyecto.id}}</th>
		  	<td>{{proyecto.nombre}}</td>
		  	<td><img :src="proyecto.imagen"></td>
		  	<td>{{get_estado_by_id(proyecto)}}</td>
		 </tr>`,
		 methods:{
			get_estado_by_id( item ){
		    	var texto = 'Estado desconocido';
		    	for (var i = this.estados.length - 1; i >= 0; i--) {
		    		if(this.estados[i]['id'] == item.estado ){
		    			texto = this.estados[i].nombre;
		    		}
		    	}
		    	return texto;
		    },
		},

		};

		var contenido = {
			data: function () {
				return {
				 filtro_proyectos_activo: 0
				}
			},
			props: ['tareas','proyectos','usuarios','titulo_vista','estados'],
			template: `
			<div id="contenido" class="bg-white pt-5 col-md-9 h-100" style="overflow-y:scroll;">
				<h2>{{titulo_vista}}</h2>
				<div class="row pt-1 pb-2">
					<tarjeta-dashboard v-bind:contador="contar_proyectos">proyectos</tarjeta-dashboard>
					<tarjeta-dashboard v-bind:contador="contar_tareas_pendientes">tareas sin cumplir</tarjeta-dashboard>
					<tarjeta-dashboard v-bind:contador="contar_usuarios">usuarios</tarjeta-dashboard>
				</div>
				<label>Filtro:</label>
				<select v-model="filtro_proyectos_activo">
					<option value="0">Todas</option>
					<option v-for="estado in estados" v-bind:value="estado.id">{{estado.nombre}}</option>
				</select>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped">
							<thead>
						    	<tr><th scope="col">ID</th><th scope="col">Imagen</th><th scope="col">Nombre</th><th scope="col">Otro</th></tr>
						  	</thead>
						  	<tbody class="" id="contenido-tabla">						
							    <tr is="proyecto-fila" v-for="proyecto in proyectos" v-bind:key="proyecto.id" v-bind:proyecto="proyecto" v-bind:estados="estados" v-bind:filtro_proyectos_activo="filtro_proyectos_activo"></tr>
							  </tbody>
						</table>
					</div>
				</div>
			</div>
			`,
			components:{
				'tarjeta-dashboard':tarjetaDashboard,
				'proyecto-fila':proyectoFila,
			},
			computed:{
			  	contar_proyectos( ){
			  		return this.proyectos.length;
			  	},
			  	contar_tareas_pendientes( ){
			  		var counter = 0;
			  		for (var i = this.tareas.length - 1; i >= 0; i--) {
			  			if(this.tareas[i].estado == 0){
			  				counter++;
			  			}
			  		}
			  		return counter;
			  	},
			  	contar_usuarios( ){
			  		return this.usuarios.length;
			  	},
			}
		}
		var app7 = new Vue({
		  	el: '#app-7',
		  	data: {
		    	paginas: [
		    		{id:0,nombre:'home', url: 'http://proyectos.hatchtemuco.com/vistas/index.php'},
		    		{id:1,nombre:'Estados', url: 'http://proyectos.hatchtemuco.com/vistas/index.php'},
		    		{id:2,nombre:'Proyectos', url: 'http://proyectos.hatchtemuco.com/vistas/index.php'},
		    		{id:3,nombre:'Usuarios', url: 'http://proyectos.hatchtemuco.com/vistas/index.php'},
		    		{id:4,nombre:'Salir', url: 'http://proyectos.hatchtemuco.com/vistas/index.php'},
		    	],
		    	proyectos:[],
		    	tareas: [],
		    	usuarios:[],
		    	estados:[],
		  	},
		  	methods: {
		    	getDatos: function () {
			      	var data_new = '';
			      	var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       data_new = this.responseText;
					    }
					};
					xhttp.open("GET", "http://proyectos.hatchtemuco.com/api/proyecto/", false);
					xhttp.send();
					this.proyectos = JSON.parse(data_new);

					var data_new2 = '';
					var xhttp2 = new XMLHttpRequest();
					xhttp2.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       data_new2 = this.responseText;
					    }
					};
					xhttp2.open("GET", "http://proyectos.hatchtemuco.com/api/estado/", false);
					xhttp2.send();
					this.estados = JSON.parse(data_new2);
					var data_new3 = '';
					var xhttp3 = new XMLHttpRequest();
					xhttp3.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       data_new3 = this.responseText;
					    }
					};
					xhttp3.open("GET", "http://proyectos.hatchtemuco.com/api/usuario/1/tipo/0/", false);
					xhttp3.send();
					this.usuarios = JSON.parse(data_new3);

					var data_tareas = '';
					var xhttp_tareas = new XMLHttpRequest();
					xhttp_tareas.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       data_tareas = this.responseText;
					    }
					};
					xhttp_tareas.open("GET", "http://proyectos.hatchtemuco.com/api/tarea/", false);
					xhttp_tareas.send();
					this.tareas = JSON.parse(data_tareas);
			    },
		  	},
		  	mounted: function () {
		  		this.getDatos();
			  	this.$nextTick(function () {
			    	window.setInterval(() => {
		            	this.getDatos();
		        	},30000);
			  	})
			  	
			},
			components:{
				'menu-navegacion':menu_navegacion,
				'contenido':contenido,
			},
			computed:{
			  	
		  	},
		})
		</script>
		<style>
		    td img{
		        max-width:200px;
		        max-height:50px;
		    }
		</style>
	</body>
</html>