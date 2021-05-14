<html>
<head class=" h-100">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Tablero - proyectos</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body class=" h-100">
	<div id="vista-proyectos" class="h-100">
		<div class="container-fluid h-100">
			<div class="row h-100">
				<?php 
				include_once('nav-admin.php')
				?>
				<div class="bg-white pt-5 col-md-9 h-100 overflow-auto">
					<p class="h3 pb-3">Proyectos activos<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Agregar</button></p>
					<table class="table table-striped ">
					  <thead>
					    <tr><th scope="col">Logo</th><th scope="col">Nombre</th><th scope="col">estado</th><th scope="col">Acciones</th></tr>
					  </thead>
					  <tbody class="">
					  	<tr is="fila-proyectos" v-for="item in groceryList" v-bind:proyecto="item" v-on:cargar_proyecto="cargar_proyecto(item)" v-on:eliminar_proyecto="eliminar_proyecto(item)"></tr>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
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
					    <button type="button" class="btn btn-primary" :class="[nuevo.imagen.length === 0 || nuevo.nombre.length === 0 ? 'disabled' : '']" :disabled="nuevo.imagen.length === 0 || nuevo.nombre.length=== 0" @click="agregar_proyecto()">Save changes</button>
				    </div>
				</div>
			</div>
		</div>	  	
		<!-- MODAL 2 -->
		<div class="modal fade" id="proyectoModal" tabindex="-1" aria-labelledby="proyectoModalLabel" aria-hidden="true">
		  	<div class="modal-xl modal-dialog modal-dialog-scrollable">
			   	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title w-100" id="proyectoModalLabel">{{proyecto_seleccionado.nombre.toLocaleUpperCase()}}
			        		<button class="btn btn-success float-right ml-2 mr-2" @click="cambiar_estado('editar_proyecto')" v-if="estado_pagina !== 'editar_proyecto'" >Editar proyecto</button>
			        		<button class="btn btn-danger float-right ml-2 mr-2" @click="cambiar_estado('ver_proyecto')" v-else>Cancelar</button>
			        		<button class="btn btn-success float-right" @click="cambiar_estado('añadir_tarea')" v-if="estado_pagina !== 'añadir_tarea'">Agregar tarea</button><button class="btn btn-danger float-right" @click="cambiar_estado('ver_proyecto')" v-else>Cancelar</button></h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body">
			      		<div class="contendor-add-tarea p-4 bg-light rounded border" v-if="estado_pagina === 'añadir_tarea'">
			      			<div class="input-group">
								<div class="input-group-prepend">
							    	<span class="input-group-text">Tarea y prioridad</span>
							  	</div>
							  	<input type="text" aria-label="nombre-tarea" class="form-control col-8" v-model="nueva.nombre">
							  	<select class="custom-select" id="inputGroupSelect01" v-model="nueva.prioridad">
								    <option selected>Elija prioridad</option>
								    <option value="10">Baja</option>
								    <option value="20">Normal</option>
								    <option value="30">Alta</option>
								</select>
							</div>
							<div class="form-group pt-2">
							    <label for="exampleFormControlSelect2">Notificar al completar (seleccione mas de 1 con ctrl)</label>
							    <select multiple class="form-control" id="notificar_usuarios" v-model="notificar_usuarios">
								    <option v-for="item in usuarios" v-bind:key="item.id" :value="item.id"> {{item.nombre}} ( {{item.correo}} )</option>
							    </select>
							</div>
							<div class="form-group pt-2">
								<button class="btn btn-success w-100" @click="agregar_tarea()">Enviar</button>
							</div>
			      		</div>
			      		<div class="contendor-edit-proyecto p-4 mb-3 bg-light rounded border" v-if="estado_pagina === 'editar_proyecto'">
			      			<div class=" input-group">
			      				<input type="text" class="form-control" name="nombre_proyecto" v-model="proyecto_seleccionado.nombre">
				      			<select v-model="proyecto_seleccionado.estado">
					      			<option class="form-control custom-select" v-for="item in estados" v-bind:key="item.id" :value="item.id"> {{item.nombre}} </option>
					      		</select>	
			      			</div>
			      			<div class="input-group pt-2 pb-2">
			      				<button class="btn btn-primary w-100 " @click="actualizar_proyecto()">Guardar</button>
			      			</div>
			      			
			      		</div>
			      		<div class="accordion row" id="accordionExample">
			      			<div class="col-md-3">
						  <div class="card">
						    <div class="card-header" id="headingOne">
						      <h2 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          Equipo 1
						        </button>
						      </h2>
						    </div>
						  </div>
						  <div class="card">
						    <div class="card-header" id="headingTwo">
						      <h2 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Equipo 2
						        </button>
						      </h2>
						    </div>
						  </div>
						  <div class="card">
						    <div class="card-header" id="headingThree">
						      <h2 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          Equipo 3
						        </button>
						      </h2>
						    </div>
						  </div>
							</div>
						  <div class="col-md-9">
						  	<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <table class="table table-striped">
					        		<thead>
								    <tr>
								      <th scope="col">ID</th>
								      <th scope="col">Nombre</th>
								      <th scope="col">prioridad</th>
								      <th scope="col">estado</th>
								      <th scope="col">Acciones</th>
								    </tr>
								  </thead>

					        		<tr v-for="item in tareas" v-bind:todo="item" v-bind:key="item.id" :class="item.estado == 0 ? 'incompleto' : 'text-muted font-italic bg-light'">
								    	<th>{{item.id}}</th>
								    	<td>{{item.nombre}}</td>
								    	<td> {{get_prioridad_by_id(item)}} </td>
								    	

								    	<td v-if="item.estado != 1">Incompleta</td>
								    	<td v-else>Completa</td>
								    	<td>
								    		<button class="btn btn-success" @click="editar_estado_tarea(1, item)" v-if="item.estado != 1">Completar</button>
								    		<button class="btn btn-info" @click="editar_estado_tarea(0, item)" v-else>Deshacer</button>
								    		<button class="btn btn-warning" @click="editar_tarea( item )">Editar</button>
								    		<button v-if="item.estado != 1" class="btn btn-danger" @click="eliminar_tarea(item)" >Eliminar</button>
								    		<button v-else class="btn btn-primary" data-toggle="modal" data-target="#comentarioModal" @click="cambiar_id_tarea_editada(item)">Comentar</button>
								    	</td>
								    </tr>
					        	</table>
					        	<p v-if="tareas.length === 0">No hay tareas pendientes</p>
						      </div>
						    </div>
						    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						      <div class="card-body">
						        <table class="table table-striped">
					        		<thead>
								    <tr>
								      <th scope="col">ID</th>
								      <th scope="col">Nombre</th>
								      <th scope="col">prioridad</th>
								      <th scope="col">estado</th>
								      <th scope="col">Acciones</th>
								    </tr>
								  </thead>
					        		<tr v-for="item in tareas" v-bind:todo="item" v-bind:key="item.id" :class="item.estado == 0 ? 'incompleto' : 'text-muted font-italic bg-light'">
								    	<th>{{item.id}}</th>
								    	<td>{{item.nombre}}</td>
								    	<td> {{get_prioridad_by_id(item)}} </td>
								    	

								    	<td v-if="item.estado != 1">Incompleta</td>
								    	<td v-else>Completa</td>
								    	<td>
								    		<button class="btn btn-success" @click="editar_estado_tarea(1, item)" v-if="item.estado != 1">Completar</button>
								    		<button class="btn btn-info" @click="editar_estado_tarea(0, item)" v-else>Deshacer</button>
								    		<button class="btn btn-warning" @click="editar_tarea( item )">Editar</button>
								    		<button v-if="item.estado != 1" class="btn btn-danger" @click="eliminar_tarea(item)" >Eliminar</button>
								    		<button v-else class="btn btn-primary" data-toggle="modal" data-target="#comentarioModal" @click="cambiar_id_tarea_editada(item)">Comentar</button>
								    	</td>
								    </tr>
					        	</table>
					        	<p v-if="tareas.length === 0">No hay tareas pendientes</p>
						      </div>
						    </div>
						    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						      <div class="card-body">
						        <table class="table table-striped">
					        		<thead>
								    <tr>
								      <th scope="col">ID</th>
								      <th scope="col">Nombre</th>
								      <th scope="col">prioridad</th>
								      <th scope="col">estado</th>
								      <th scope="col">Acciones</th>
								    </tr>
								  </thead>
					        		<tr v-for="item in tareas" v-bind:todo="item" v-bind:key="item.id" :class="item.estado == 0 ? 'incompleto' : 'text-muted font-italic bg-light'">
								    	<th>{{item.id}}</th>
								    	<td>{{item.nombre}}</td>
								    	<td> {{get_prioridad_by_id(item)}} </td>
								    	

								    	<td v-if="item.estado != 1">Incompleta</td>
								    	<td v-else>Completa</td>
								    	<td>
								    		<button class="btn btn-success" @click="editar_estado_tarea(1, item)" v-if="item.estado != 1">Completar</button>
								    		<button class="btn btn-info" @click="editar_estado_tarea(0, item)" v-else>Deshacer</button>
								    		<button class="btn btn-warning" @click="editar_tarea( item )">Editar</button>
								    		<button v-if="item.estado != 1" class="btn btn-danger" @click="eliminar_tarea(item)" >Eliminar</button>
								    		<button v-else class="btn btn-primary" data-toggle="modal" data-target="#comentarioModal" @click="cambiar_id_tarea_editada(item)">Comentar</button>
								    	</td>
								    </tr>
					        	</table>
					        	<p v-if="tareas.length === 0">No hay tareas pendientes</p>
						      </div>
						    </div>
						  </div>
						</div>

				    </div>
				    <div class="modal-footer">
					    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					    <button type="button" class="btn btn-primary" :class="[nuevo.imagen.length === 0 || nuevo.nombre.length === 0 ? 'disabled' : '']" :disabled="nuevo.imagen.length === 0 || nuevo.nombre.length=== 0" @click="agregar_proyecto()">Save changes</button>
				    </div>
				</div>
			</div>
		</div>
		<!-- MODAL 3 -->
		<div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="comentarioModalLabel" aria-hidden="true">
		  	<div class="modal-dialog">
			   	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLabel">Añadir comentario</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body">
			        	<form>
			        		<label>Comentario (texto , url , etc )</label>
			        		<textarea type="text" name="comentario" class="w-100 border mb-4" v-model="comentario.comentario"></textarea>
			        		
			        	</form>
			        	<button  class="btn btn-primary w-100" data-dismiss="modal" @click="comentar_tarea()">Comentar</button>
				    </div>
				    <div class="modal-footer">
				    	<label class="float-left">({{char_count}}/500)</label>
					    <button type="button" class="btn btn-secondary">Close</button>
				    </div>
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
	
	/* PLANTILLA CADA FILA DE TABLA DE PROYECTOS */
	var fila_proyectos ={
		props: ['proyecto'],
		template: `
		<tr >
	    	<!-- <th>{{proyecto.id}}</th> -->
	    	<td><img v-bind:src="proyecto.imagen" ></td>
	    	<td>{{proyecto.nombre}}</td>
	    	<td>estado</td>
	    	<td class="align-middle">
	    		<button type="button" class="btn btn-warning mr-3 mt-1 mb-1" data-toggle="modal" data-target="#proyectoModal" v-on:click="$emit('cargar_proyecto')">Ver</button>
	    		<button type="button" class="btn btn-danger  mt-1 mb-1" v-on:click="$emit('eliminar_proyecto')">Eliminar</button>
	    	</td>
		</tr>
		`
	}
	var app7 = new Vue({
	  	el: '#vista-proyectos',
	  	data: {
		    groceryList: [],
		    nuevo: {"nombre":"Estado nuevo","imagen":"imagen estado nuevo"} ,
		    tareas : [],
		    proyecto_seleccionado: {"id":"","nombre":"","imagen":"","estado":""} ,
		    nueva: {"id":-1,"nombre":"","proyecto":"","prioridad":"10","estado":"0"} ,
		    estado_pagina: false,
		    estados : [],
		    usuarios: [],
		    equipos:[{"id":"0","nombre":"Diseño"},{"id":"1","nombre":"Web"},{"id":"2","nombre":"Marketing"}],
		    notificar_usuarios: [],
		    comentario: {id:0,comentario:""},
	  	},
	  	computed:{
		  	get_estado_id( item ){
		  		var aux = this.estados;
		  		for (var i = aux.length - 1; i >= 0; i--) {
		  			console.log(aux[i].id);

		  		}
		  	},
		  	char_count(){
		  		return this.comentario.comentario.length;
		  	}
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
				this.groceryList = JSON.parse(data_new);

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
				//console.log(this.data);

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
		    },
		    eliminar_proyecto: function(item){
		    	//console.log(item);
		      	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       console.log("enviado");
				    }
				};
				xhttp.open("DELETE", "http://proyectos.hatchtemuco.com/api/proyecto/"+item.id+"/", false);
				xhttp.send();
				this.getDatos();
		    },
		    agregar_proyecto: function(){
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
				xhttp.open("POST", "http://proyectos.hatchtemuco.com/api/proyecto/", false);
				xhttp.send(formData);

				if(bool  != false ){
					this.nuevo = {"nombre":"","imagen":""};
				}else{
				  	console.log("Error al guardar");
				}
				this.getDatos();
		    },
		    cargar_proyecto: function(item){
		      	//console.log(item);
		      	this.proyecto_seleccionado = item;
		      	this.nueva.proyecto = item.id;
		      	var array = [];
		      	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       app7.tareas = JSON.parse(xhttp.responseText);
				    }
				};
				xhttp.open("GET", "http://proyectos.hatchtemuco.com/api/tarea/1/proyecto/"+item.id+"/", false);
				xhttp.send();
		    },
		    cambiar_estado: function( nuevo_estado ){
		    	this.estado_pagina = nuevo_estado;
		    },
		    editar_estado_tarea: function ( nuevo_estado , item){
		    	item.estado = nuevo_estado;
		    	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       console.log(this.responseText + "response");
				    }
				};
				xhttp.open("PATCH", "http://proyectos.hatchtemuco.com/api/tarea/"+item.id+"/estado/"+nuevo_estado+"/", false);
				xhttp.send();

				if(nuevo_estado == 1){
					var xhttp2 = new XMLHttpRequest();
					xhttp2.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       console.log(this.responseText);
					    }
					};
					xhttp2.open("GET", "http://proyectos.hatchtemuco.com/send-email/"+item.id+"/", false);
					xhttp2.send();
					
				}
		    },
		    agregar_tarea: function(){
		    	if(this.nueva.id != -1){//update
		    		console.log('update');
		    		var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       console.log(this.responseText + "response");
					    }
					};
					xhttp.open("PATCH", "http://proyectos.hatchtemuco.com/api/tarea/"+this.nueva.id+"/nombre/"+this.nueva.nombre+"/", false);
					xhttp.send();

					xhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       console.log(this.responseText);
					    }
					};
					xhttp.open("PATCH", "http://proyectos.hatchtemuco.com/api/tarea/"+this.nueva.id+"/prioridad/"+this.nueva.prioridad+"/", false);
					xhttp.send();

					for (var i = this.tareas.length - 1; i >= 0; i--) {
						if(this.tareas[i].id == this.nueva.id){
							this.tareas[i].nombre = this.nueva.nombre;
							this.tareas[i].prioridad = this.nueva.prioridad;
						}
					}

					this.nueva.id = -1;
		    		this.nueva.proyecto = 0;
		    		this.nueva.prioridad = 10;
		    		this.nueva.estado = 0;
		    		this.nueva.nombre = "";

		    	}else{//crear
		    		console.log('agregar_tarea');
		    		var bool = false;
			    	var formData = new FormData();
					formData.append("nombre", this.nueva.nombre);
					formData.append("proyecto", this.nueva.proyecto);
					formData.append("prioridad", this.nueva.prioridad);
					formData.append("estado", this.nueva.estado);
					
			      	var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
					       // Typical action to be performed when the document is ready:
					       console.log(this.responseText);
					    }
					};
					xhttp.open("POST", "http://proyectos.hatchtemuco.com/api/tarea/", false);
					xhttp.send(formData);
					console.log(xhttp.responseText);
					if(xhttp.responseText != false ){
						this.cargar_proyecto(this.proyecto_seleccionado);
					}else{
					  	console.log("Error al guardar");
					}

					this.nueva.nombre = '';
					this.nueva.prioridad = '10';

					var id_nueva_tarea =xhttp.responseText;
					for (var i = this.notificar_usuarios.length - 1; i >= 0; i--) {
						
						var formData = new FormData();
						formData.append("usuario", this.notificar_usuarios[i]);
						formData.append("tarea", id_nueva_tarea);
				      	var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
						    if (this.readyState == 4 && this.status == 200) {
						       // Typical action to be performed when the document is ready:
						    }
						};
						xhttp.open("POST", "http://proyectos.hatchtemuco.com/api/notificacion/", false);
						xhttp.send(formData);
						console.log('id notificacion: '+xhttp.responseText);
					}

					this.notificar_usuarios = [];
		    	}
		    	/*
				
				*/
				this.cambiar_estado('ver_proyecto');

			},
			eliminar_tarea: function( item ){
		      	console.log(item);
		      	console.log("http://proyectos.hatchtemuco.com/api/tarea/"+item.id+"/");
		      	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       console.log("enviado");
				    }
				};
				xhttp.open("DELETE", "http://proyectos.hatchtemuco.com/api/tarea/"+item.id+"/", false);
				xhttp.send();
				this.cargar_proyecto(this.proyecto_seleccionado);
		    },
		    editar_tarea: function( item ){
		    	this.cambiar_estado('añadir_tarea');
		    	this.nueva.nombre = item.nombre;
		    	this.nueva.prioridad = item.prioridad;
		    	this.nueva.id = item.id;
		    	this.nueva.proyecto = item.proyecto;
		    },
		    comentar_tarea: function(){
		    	var xhttp = new XMLHttpRequest();
		    	var comentario = this.comentario.comentario.split("/");
		    	var comentario_sanitizado = "";
		    	for (var i = 0; i < comentario.length ; i++) {
		    		if(i == comentario.length){
		    			comentario_sanitizado += comentario[i];
		    		}else{
		    			comentario_sanitizado += comentario[i]+"---";	
		    		}
		    	}
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       // Typical action to be performed when the document is ready:
				       console.log(this.responseText + "response");
				    }
				};
				xhttp.open("PATCH", "http://proyectos.hatchtemuco.com/api/tarea/"+this.comentario.id+"/comentario/"+comentario_sanitizado+"/", false);
				xhttp.send();

		    },
		    cambiar_id_tarea_editada: function( item ){
		    	this.comentario.comentario = item.comentario;
		    	this.comentario.id = item.id;
		    },
		    get_estado_by_id( item ){
		    	var texto = 'Estado desconocido';
		    	for (var i = this.estados.length - 1; i >= 0; i--) {
		    		if(this.estados[i]['id'] == item.estado ){
		    			texto = this.estados[i].nombre;
		    		}
		    	}
		    	return texto;
		    },
		    get_prioridad_by_id( item ){
		    	var texto = 'prioridad desconocido';
		    	if(item.prioridad == '10'){
		    		var texto = 'Baja';
		    	}else if(item.prioridad == '20'){
		    		var texto = 'Normal';
		    	}else if(item.prioridad == '30'){
		    		var texto = 'Alta';
		    	}
		    	return texto;
		    },
		    actualizar_proyecto: function(){
		    	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       console.log(this.responseText + "response");
				    }
				};
				xhttp.open("PATCH", "http://proyectos.hatchtemuco.com/api/proyecto/"+this.proyecto_seleccionado.id+"/estado/"+this.proyecto_seleccionado.estado+"/", false);
				xhttp.send();
				var xhttp2 = new XMLHttpRequest();
				xhttp2.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				       console.log(this.responseText + "response");
				    }
				};
				xhttp2.open("PATCH", "http://proyectos.hatchtemuco.com/api/proyecto/"+this.proyecto_seleccionado.id+"/nombre/"+this.proyecto_seleccionado.nombre+"/", false);
				xhttp2.send();
				this.cambiar_estado('ver_proyecto');
		    }
		},
	  	mounted: function () {
		  	this.$nextTick(function () {
		    	window.setInterval(() => {
	            	this.getDatos();
	        	},60000);
		  	})
		},
		created: function(){
			this.getDatos();
		},
		components:{
			'fila-proyectos':fila_proyectos,
		}
	})
</script>
</body>
</html>