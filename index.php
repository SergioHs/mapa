<!DOCTYPE html>
<html lang="en">
<head>
	<title>#-! SMC !-#</title>
	  	<meta charset="utf-8">
		<title>Sistema de Mapeamento Colaborativo</title>
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="sources/bootstrap.min.css">
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBuERdoQ4F8LyCgU985DeeWY0lFb43vMNA"></script>
		<script src="sources/jquery.min.js"></script>
	  	<script src="sources/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/meu-arquivo.css">
		<link rel="shortcut icon" href="https://www.freevectormaps.com/ico/favicon.png" type="image/x-icon"/>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
	 <div class="navbar-header">
		 <a class="navbar-brand" href="#"><img src="https://www.freevectormaps.com/ico/favicon.png" width="20px" height="20px"> SISMAPURB </a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Mapeie</a></li>
        <li><a href="dadosmapeamento.php">Dados do Mapeamento</a></li>
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Pesquisa</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php

session_start();
if(isset($_SESSION['flash_error'])): ?>
<div class="row">
	<p class="alert alert-danger">
		<?= $_SESSION['flash_error'] ?>
	</p>
</div>
<?php  elseif(isset($_SESSION['flash_success'])):?>
<div class="row">
	<p class="alert alert-success">
		<?= $_SESSION['flash_success'] ?>
	</p>
</div>
<?php session_destroy(); endif; ?>

<div class="row">
	<div class="col-md-4" style="background-color:AntiqueWhite; margin-left: 30px; width: 300px;  height: 500px;" id="form"><br>
		<form enctype="multipart/form-data" action="client/submitOcorrencia.php" id="submitOcorrenciaForm" method="POST">
			<div class="form-group">
				<label for="problema">Problema</label>
				<input type="text" name="problema" class="form-control">
			</div>
			<div class="form-group">
				<label for="problema">Descrição</label>
				<input type="text" name="descricao" class="form-control">
			</div>
			<div class="form-group">
				<label for="endereco">Nome da Rua: </label>
				<input type="text" name="endereco" class="form-control">
			</div>
			<div class="form-group">
				<label for="file">Foto</label>
				<input type="file" name="arquivo" id="arquivo">
			</div>
			<button type="submit" class="btn btn-danger btn-lg btn-block">
				<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Mapear Problema
			</button>
			<input type="hidden" name="latitude" value="">
			<input type="hidden" name="longitude" value="">
		</form>
	</div>
	<div class="col-md-8">
		<div id="map-canvas" class="col-md-8" style="width: 700px; height: 500px; margin-left: 30px;"></div>
	</div>
</div>
<script>
$(document).ready(function(){

  function initialize() {
    var latlng = new google.maps.LatLng(-27.0319451,-48.6545272);
    var myOptions = {
      zoom: 13,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        myOptions);
	var infowindow = new google.maps.InfoWindow();
	google.maps.event.addListener(map, 'click', function() {
	  infowindow.close();
	});

	$.ajax({
		url: 'client/fetchOcorrencias.php',
		success: function(data){
			data = JSON.parse(data);
			map.data.addGeoJson(data);
			map.data.addListener('click', function(event) {
				   infowindow.setContent(event.feature.getProperty('name')+"<br>"+event.feature.getProperty('description')+"<br /><img style='width: 250px;height: 100px' src='files/"+event.feature.getProperty('arquivo')+"'>");
				   infowindow.setPosition(event.latLng);
				   infowindow.setOptions({pixelOffset: new google.maps.Size(0,-34)});
				   infowindow.open(map);
				});

		},
		error: function(e){
			console.log("ERRO: ");
			console.log(e);
		}

	})




  };

  initialize();

});

document.getElementById("submitOcorrenciaForm").addEventListener("submit",function(e){
	var appKey = 'AIzaSyBuERdoQ4F8LyCgU985DeeWY0lFb43vMNA';
	var address = this.endereco.value;
	e.preventDefault();

	$.ajax({
		url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+address+'&components=locality:Camboriu|country:BR|administrative_area:SC&key='+appKey,
		success: function(data){
			if(data.status == "OK"){
				var latitude = 	data.results[0].geometry.location.lat;
				var longitude = data.results[0].geometry.location.lng;
				console.log(latitude);
				console.log(longitude);
				document.getElementById("submitOcorrenciaForm").latitude.value = latitude;
				document.getElementById("submitOcorrenciaForm").longitude.value = longitude;
				document.getElementById("submitOcorrenciaForm").submit();
			} else {
				e.preventDefault();
				alert("Endereço não encontrado. Por favor, tente novamente");
			}
		},
		error: function (e){
			console.log("GEOCODE ERROR");
			console.log(e);
		}
	});
});

</script>
</body>
</html>
