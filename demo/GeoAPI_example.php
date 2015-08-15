<?php

require __DIR__ . '/vendor/autoload.php';

$geoapi = new GeoAPI();

$geoapi->setConfig("key", "");
$geoapi->setConfig("type", "JSON");
$geoapi->setConfig("sandbox", 1);

$geoapi->comunidades(array(
	//Sin argumentos
))->then(function($v){
	echo print_r($v, true);
});

//Esperar 1 segundo para evitar el limite de la API en sandbox
sleep(1);

$geoapi->provincias(array(
	'CCOM' => '08' //Provincias de "Castilla y León"
))->then(function($v){
	echo print_r($v, true);
});

?>