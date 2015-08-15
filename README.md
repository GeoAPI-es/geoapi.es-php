# geoapi.es-php
Libreria en PHP para GeoAPI.es

### Como empezar

La libreria esta basada en [composer](https://getcomposer.org/), por lo tanto es recomendable usar `composer` para instalarla.

Para instalar <b>geoapi.es-php</b> y sus dependencias, es suficiente con añadir

    "geoapi.es/php": "~0.0.1"

en la seccion `require` de tu archivo `composer.json`.

Si no estas manejando tu proyecto con `composer` o simplemente quieres hacer una prueba rapida,
puedes ejecutar

    composer require geoapi.es/php

### Como funciona a nivel funcional

La libreria tiene 2 partes importantes.

De base usaremos el siguiente codigo para poder explicar mejor cada parte.

    $geoapi = new GeoAPI(); //Nueva instancia de la libreria

* Configuracion

    El metodo `setConfig` sirve para definir los parametros que usara la libreria para hacer las
    peticiones. Dichos parametros estan explicados en la [documentacion general](https://github.com/GeoAPI-es/geoapi.es-docs).

    ```php
    //
    $geoapi->setConfig("key", "...");
    $geoapi->setConfig("sandbox", 0);
    ...
    ```

* Metodos

    La libreria dispone de varios metodos, los cuales se usan para realizar las distintas peticiones. Cada uno de los metodos puede tener 0 o mas parametros, que se usan para,
    por ejemplo, filtrar o concretar la busqueda.

    ```php
    //
    $geoapi->comunidades();
    $geoapi->provincias();
    ...
    ```

    Todos los metodos disponibles, asi como sus parametros, estan especificados en la [documentacion general](https://github.com/GeoAPI-es/geoapi.es-docs).

### Como funciona a nivel tecnico

La libreria realiza peticiones `GET` al endpoint y ejecuta un callback (usando `React/Promise`),
pasandole como parametros los datos recibidos. De esta manera se consigue un codigo asincrono.

```php
$geoapi->comunidades(array(
    //Sin argumentos
))->then(function($respuesta) {
    echo print_r($respuesta, true);
});
```
