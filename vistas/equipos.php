<html>
<head class=" h-100"><meta charset="euc-jp">
	
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
				<div class="bg-white pt-5 col-md-9">
					<p class="h3 pb-3">Estados disponibles <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Agregar</button></p>
					<table class="table table-striped ">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Nombre</th>
					      <th scope="col">Coordinador</th>
					      <th scope="col">Otro</th>
					    </tr>
					  </thead>
					  <tbody class="">

					    <tr v-for="item in groceryList" v-bind:todo="item" v-bind:key="item.id">
					    	<th class="align-middle">{{item.id}}</th>
					    	<td class="align-middle">{{item.nombre}}</td>
					    	<td class="align-middle">{{item.coordinador}}</td>
					    	<td class="align-middle">
					    		<button type="button" class="btn btn-warning mr-3 mt-1 mb-1">Editar</button>
					    		<button type="button" class="btn btn-danger  mt-1 mb-1" @click="eliminar_estado(item)">Eliminar</button>
					    	</td>
					    </tr>
					  </tbody>
					</table>
					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog">
					    	<div class="modal-content">
						      	<div class="modal-header">
						        	<h5 class="modal-title" id="exampleModalLabel">Añadir</h5>
						        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          		<span aria-hidden="true">&times;</span>
						        	</button>
						      	</div>
						      	<div class="modal-body">
						        	<form>
						        		<label>Nombre</label>
						        		<input type="text" name="nombre" class="w-100 border mb-4" v-model="nuevo.nombre">
						        		<label>Imagen</label>
						        		<input type="text" name="imagen" class="w-100 border mb-4" v-model="nuevo.imagen">
						        	</form>
						      	</div>
						      	<div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							        <button type="button" class="btn btn-primary" :class="[nuevo.imagen.length === 0 || nuevo.nombre.length === 0 ? 'disabled' : '']" :disabled="nuevo.imagen.length === 0 || nuevo.nombre.length=== 0" @click="agregar_estado()">Save changes</button>
						      	</div>
						    </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>


	</div>
	<script type="text/javascript">
	

	Vue.component('todo-item', {
	  props: ['todo'],
	  template: '<tr><th scope="row">3</th><td>{{ todo.nombre }}</td><td>the Bird</td><td>@twitter</td></tr>'
	})

	var app7 = new Vue({
	  el: '#app-7',
	  data: {
	    groceryList: [
	     
	    ],
	    nuevo: {"nombre":"Estado nuevo","imagen":"imagen estado nuevo"} ,
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
			xhttp.open("GET", "http://proyectos.hatchtemuco.com/api/equipo/", false);
			xhttp.send();
			this.groceryList = JSON.parse(data_new);
			console.log(this.data);
	    },
	    eliminar_estado: function(item){
	    	console.log(item);
	      	var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			       // Typical action to be performed when the document is ready:
			       console.log("enviado");
			    }
			};
			xhttp.open("DELETE", "http://proyectos.hatchtemuco.com/api/equipo/"+item.id+"/", false);
			xhttp.send();
			
	    },
	    agregar_estado: function(){
	    	var bool = false;
	    	var formData = new FormData();
			formData.append("nombre", this.nuevo.nombre);
			formData.append("imagen", this.nuevo.imagen);

	      	var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			       // Typical action to be performed when the document is ready:
			       bool = this.responseText;
			       console.log(this.responseText);
			    }
			};
			xhttp.open("POST", "http://proyectos.hatchtemuco.com/api/equipo/", false);
			xhttp.send(formData);

			if(bool  != false ){
				this.nuevo = {"nombre":"","imagen":""};
			}else{
			  	console.log("Error al guardar");
			}

	    }
	  },
	  mounted: function () {
		  this.$nextTick(function () {
		    window.setInterval(() => {
	            this.getDatos();
	        },1000);
		  })
	}
	})
</script>
</body>
</html>