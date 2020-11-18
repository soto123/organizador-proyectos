<!DOCTYPE html>
<html>
<head>
	<title>Vistas</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
</head>
<body>
<div id="app">
  {{ message }}
</div>
<div id="app-2">
  <span v-bind:title="message">
    Hover your mouse over me for a few seconds
    to see my dynamically bound title!
  </span>
</div>
<div id="app-3">
  <span v-if="seen">Now you see me</span>
</div>
<script type="text/javascript">
	var app = new Vue({
	  el: '#app',
	  data: {
	    message: 'Hello Vue!'
	  }
	})
	var app2 = new Vue({
	  el: '#app-2',
	  data: {
	    message: 'You loaded this page on ' + new Date().toLocaleString()
	  }
	})
	var app3 = new Vue({
	  el: '#app-3',
	  data: {
	    seen: true
	  }
	})
</script>
</body>
</html>