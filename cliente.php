<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Avance proyecto</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
	<div id="vista-proyectos" >
		<div class="container-fluid bg-dark p-3 pl-5 pr-5">
			<div class="row">
				<div class="col-md-2">
					<img src="https://hatchtemuco.com/img/LogoTransaparente.png" class="img-fluid">
				</div>
				<div class="col-md-2 offset-md-8">
					<img v-bind:src="proyecto.imagen" class="img-fluid" style="max-height: 50px;">
				</div>
			</div>
		</div>
		<div class="container" v-if="vision === 'inicio'">
			<div class="row pt-5 pb-5">
				<div class="col-md-6 offset-md-3 mt-5 p-3 bg-light border rounded">
					<p class="h2">Revisar estado de su proyecto</p>
					<p class="mb-0 pb-0">Ingrese la id de su proyecto</p>
					<input class="w-100 mb-4" type="number" name="id" v-model="proyecto.id">
					<button class="btn btn-primary w-100" @click="getDatos()">Revisar</button>
				</div>
			</div>
		</div>
		<div class="container" v-if="vision === 'ver_proyecto'">
			<div class="row pt-5">
				<div class="col-md-3 text-justify">
					<button class="btn btn-danger" @click="volver_inicio()">Volver</button>

					<p class="h6 mt-4">En esta pagina podra ver la etapa en la cual se encuentra el proyecto, igualmente el listado mostrara las tareas que se han asigando al proyecto.</p>
					<p class="h6">Las tareas completadas se destacaran con verde</p>
					<p class="h6">Si tiene alguna duda respecto a alguna tarea presione el boton <button class="btn btn-warning"> ? </button>, para enviar un mensaje</p>
				</div>
				<div class="col-md-9">
					<p class="h3">Nombre: {{proyecto.nombre}} </p>
					<p class="h6">Etapa: {{estado_proyecto}}  </p>
					<table class="table table-striped ">
						<tr>
							<th>Tarea</th>
							<th>Estado</th>
							<th>Acción</th>
						</tr>
						<tr v-for="item in tareas" v-bind:key="item.id" :class="[item.estado != 0  ? 'text-success font-italic bg-gradient-success border-success' : 'incompleto', '']">
							<td>{{item.nombre}}</td>
							<td>{{item.estado != 0  ? 'Completo' : 'En progreso'}}</td>
							<td><button class="btn btn-info ml-1 mr-1" v-if="item.estado==1" data-toggle="modal" data-target="#comentarioModal" @click="carga_comentario(item)"> ver </button><button v-else  data-toggle="modal" data-target="#exampleModal" class="btn btn-warning ml-1 mr-1" @click="ayuda(item)"> ? </button></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="container-fluid bg-dark mt-3">
			<div class="row">
				<div class="col-md-12 pt-4 pb-3">
					<p class="text-white text-center h4">Gracias por confiar en nosotros</p>
					<p class="text-white text-center">Recuerda que puedes contactarnos mediante los siguientes medios</p>
				</div>
				<div class="col-4">
					<p class="text-white text-right">Whatsapp</p>
				</div>
				<div class="col-4">
					<p class="text-white text-center">correo</p>
				</div>
				<div class="col-4">
					<p class="text-white text-left">telefono</p>
				</div>
			</div>
		</div>
		
		<!-- MODAL -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog">
			   	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLabel">Consultar</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body">
			        	<form>
			        		<label>Tarea</label>
			        		<input type="text" name="nombre" class="w-100 border mb-2" v-model="tarea.nombre">
			        		<label>Nombre</label>
			        		<input type="text" name="persona" class="w-100 border mb-2" v-model="consulta.nombre">
			        		<label>Comentario y/o consulta</label>
			        		<textarea class="form-control" id="comentario" v-model="consulta.comentario">
			        			
			        		</textarea>
			        	</form>
				    </div>
				    <div class="modal-footer">
					    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					    <button type="button" class="btn btn-primary"  :disabled="consulta.comentario.length === 0 " @click="enviar_comentario()" data-dismiss="modal">Enviar comentario</button>
				    </div>
				</div>
			</div>
		</div>	
		<!-- MODAL 2 -->
		<div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="comentarioModalLabel" aria-hidden="true">
		  	<div class="modal-dialog">
			   	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLabel">Leer comentario</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body">
			        	<p class="h6"> {{comentario}} </p>
				    </div>
				    <div class="modal-footer">
					    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				    </div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css"></style>
<script type="text/javascript">
	
	var app7 = new Vue({
	  	el: '#vista-proyectos',
	  	data: {
		    tareas : [],
		    proyecto: {"id":10,"nombre":"Seleccione proyecto","imagen":"","estado":""} ,
		    estados : [],
		    vision: "inicio",
		    estado_proyecto: "",
		    tarea: {"id":"","nombre":"","proyecto":"","prioridad":"10","estado":"0"},
		    consulta: {"comentario":"","nombre":""},
		    comentario: "",
	  	},
	  	computed:{
	  		
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
				xhttp.open("GET", "http://proyectos.hatchtemuco.com/api/proyecto/"+this.proyecto.id+"/", false);
				xhttp.send();
				this.proyecto = JSON.parse(data_new);

				

				var data_new3 = '';
				var xhttp3 = new XMLHttpRequest();
				xhttp3.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       data_new3 = this.responseText;
				    }
				};
				xhttp3.open("GET", "http://proyectos.hatchtemuco.com/api/tarea/1/proyecto/"+this.proyecto.id+"/", false);
				xhttp3.send();

				this.tareas = JSON.parse(data_new3);
				this.vision = "ver_proyecto";
				this.update_estado_proyecto();
		    },
		    volver_inicio: function(){
		    	this.vision = "inicio";	
		    	this.proyecto = {"id":10,"nombre":"Seleccione proyecto","imagen":"","estado":""} ;
		    	this.tareas = [];
		    },
		    update_estado_proyecto: function(){
		    	for (var i = this.estados.length - 1; i >= 0; i--) {
		    		console.log(this.estados[i].id+" / "+this.proyecto.estado);
		    		if(this.estados[i].id == this.proyecto.estado){
		    			this.estado_proyecto = this.estados[i].nombre;
		    		}
		    	}
		    },
		    ayuda: function( item ){
		    	this.tarea = item;
		    },
		    enviar_comentario: function(){
		    	var formData = new FormData();
				formData.append("cliente", this.consulta.nombre);
				formData.append("proyecto", this.proyecto.nombre);
				formData.append("comentario", this.consulta.comentario);
				formData.append("tarea", this.tarea.nombre);

		      	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       bool = this.responseText;
				       console.log(this.responseText);
				    }
				};
				xhttp.open("POST", "http://proyectos.hatchtemuco.com/enviar-comentario/", false);
				xhttp.send(formData);
		    },
		    carga_comentario: function( item ){
		    	this.comentario = item.comentario;
		    }
	  	},
		mounted: function () {
			/*this.$nextTick(function () {
			   	window.setInterval(() => {
		           	this.getDatos();
		       	},60000);
			})*/
		},
		created: function(){
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
		}
	})
</script>
</body>
</html>