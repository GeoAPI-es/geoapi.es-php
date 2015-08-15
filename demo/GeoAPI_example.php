<?php

require __DIR__ . '/vendor/autoload.php';

$geoapi = new GeoAPI();

$geoapi->setConfig("key", "");
$geoapi->setConfig("type", "JSON");
$geoapi->setConfig("sandbox", 1);

$geoapi->comunidades(array(
	//
))->then(function($v){
	echo print_r($v, true);
});

sleep(1);

$geoapi->provincias(array(
	'CCOM' => '08'
))->then(function($v){
	echo print_r($v, true);
});

?>