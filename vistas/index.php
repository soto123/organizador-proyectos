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
				<div class="bg-dark col-md-3 h-100">
					<img src="https://www.hatchtemuco.com/img/LogoTransaparente.png" alt="logo hatch" class="img-fluid p-5">
					<nav class="nav flex-column">
						<a class="nav-link text-white border active" href="#">Home</a>
						<a class="nav-link text-white border" href="#">Estados</a>
						<a class="nav-link text-white border" href="#">Proyectos</a>
						<a class="nav-link text-white border" href="#">Usuarios</a>
						<a class="nav-link text-white border" href="#">Salir</a>
					</nav>
				</div>
				<div class="bg-white pt-5 col-md-9">
					<table class="table table-striped ">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Nombre</th>
					      <th scope="col">imagen</th>
					      <th scope="col">Otro</th>
					    </tr>
					  </thead>
					  <tbody class="">

					    <!--
					    <tr v-for="item in groceryList" v-bind:todo="item" v-bind:key="item.id">
					    	<th>{{item.id}}</th>
					    	<td>{{item.nombre}}</td>
					    	<td>{{item.imagen}}</td>
					    	<td>estado</td>
					    </tr>
					-->
					    <fila-proyecto v-for="item in groceryList" v-bind:nombre="item.nombre" v-bind:imagen="item.imagen" v-bind:estado="item.estado" v-bind:id="item.id"></fila-proyecto>
					  </tbody>
					</table>
					
				</div>
			</div>
		
		</div>
		<!-- <button v-on:click="getDatos">Reverse Message</button> -->
	  	
	</div>
	<script type="text/javascript">
	

	Vue.component('todo-item', {
	  props: ['todo'],
	  template: '<tr><th scope="row">3</th><td>{{ todo.nombre }}</td><td>the Bird</td><td>@twitter</td></tr>'
	});

	app7.component("fila-proyecto",{
		props:{
			id: String,
			nombre: String,
			imagen: String,
			estado: String,
		},
		templates:`
		<tr>
		   	<th>{{id}}</th>
		   	<td>{{nombre}}</td>
		   	<td>{{imagen}}</td>
		   	<td>{{estado}}</td>
		</tr>`});

	var app7 = new Vue({
	  el: '#app-7',
	  data: {
	    groceryList: [
	      { id: 0, nombre: '', imagen: '' }
	    ]
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
			xhttp.open("GET", "http://localhost/hatch/organizador-proyectos/api/estado/", false);
			xhttp.send();
			this.groceryList = JSON.parse(data_new);
			console.log(this.data);
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