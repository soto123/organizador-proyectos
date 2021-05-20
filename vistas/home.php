<html>
<head class=" h-100">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Tablero - organizador</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body class=" h-100">
	<div id="app-7" class="h-100">
		<div class="container-fluid h-100">
			<div class="row h-100">
				<?php 
				include_once('nav-admin.php')
				?>
				<div class="bg-white pt-5 col-md-9 h-100 overflow-auto">
					<p class="h3 pb-1">Inicio</p>
					<div class="row pt-1 pb-2">
						<tarjeta-dashboard v-bind:contador="contar_proyectos">proyectos</tarjeta-dashboard>
						<tarjeta-dashboard v-bind:contador="contar_usuarios">usuarios</tarjeta-dashboard>
						<tarjeta-dashboard v-bind:contador="contar_tareas_pendientes">tareas pendientes</tarjeta-dashboard>
					</div>
					<p class="h3">Proyectos</p>
					<table class="table table-striped ">
					  <thead>
					    <tr><th scope="col">ID</th><th scope="col">Imagen</th><th scope="col">Nombre</th><th scope="col">Otro</th></tr>
					  </thead>
					  <tbody class="" id="contenido-tabla">						
					    <tr is="todo-item" v-for="item in proyectos" v-bind:key="item.id" v-bind:todo="item"></todo-item>
					  </tbody>
					</table>
					
				</div>
			</div>
		
		</div>
	</div>

	<style>
	    td img{
	        max-width:200px;
	        max-height:50px;
	    }
	</style>
	<script type="text/javascript">
	
	var todoItem = {
	  props: ['todo'],
	  template: `
	  <tr class="fila-proyecto">
	  	<th>{{todo.id}}</th>
	  	<td>{{todo.nombre}}</td>
	  	<td><img :src="todo.imagen"></td>
	  	<td>{{todo.estado}}</td>
	 </tr>`
	};

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
		`
	}
	var app7 = new Vue({
	  	el: '#app-7',
	  	data: {
		    proyectos: [],
		    usuarios: [],
		    tareas: [],
		    estados: []
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
	  	},
	 	methods: {
		    getDatos: function () {
		      	var data_new2 = '';
				var xhttp2 = new XMLHttpRequest();
				xhttp2.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       data_new2 = this.responseText;
				    }
				};
				xhttp2.open("GET", "http://proyectos.hatchtemuco.com/api/proyecto/", false);
				xhttp2.send();
				this.proyectos = JSON.parse(data_new2);
		    },
		    get_estado_by_id: function( item ){
		    	var texto = 'Estado desconocido';
		    	for (var i = this.estados.length - 1; i >= 0; i--) {
		    		if(this.estados[i]['id'] == item.estado ){
		    			texto = this.estados[i].nombre;
		    		}
		    	}

		    	return texto;
		    }
	  	},
	  	mounted: function () {
		  this.$nextTick(function () {
		    window.setInterval(() => {
	            this.getDatos();
	        },1000);
		  });

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
			xhttp3.open("GET", "http://proyectos.hatchtemuco.com/api/tarea/", false);
			xhttp3.send();
			this.tareas = JSON.parse(data_new3);

			var data_new4 = '';
			var xhttp4 = new XMLHttpRequest();
			xhttp4.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			       // Typical action to be performed when the document is ready:
			       data_new4 = this.responseText;
			    }
			};
			xhttp4.open("GET", "http://proyectos.hatchtemuco.com/api/usuario/", false);
			xhttp4.send();
			this.usuarios = JSON.parse(data_new4);	
		},
		components:{
			'todo-item' : todoItem,
			'tarjeta-dashboard':tarjetaDashboard,
		}
	});
	
</script>
</body>
</html>