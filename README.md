# geoapi.es-php
Libreria en PHP para GeoAPI.es

### Cómo empezar

Es preferible leer la [documentación general](https://github.com/GeoAPI-es/geoapi.es-docs) a la par con esta documentación.

La librería esta basada en [composer](https://getcomposer.org/), por lo tanto es recomendable usar `composer` para instalarla.

Para instalar <b>geoapi.es-php</b> y sus dependencias, es suficiente con añadir

    "geoapi.es/php": "~0.0.1"

en la sección `require` de tu archivo `composer.json`.

Si no estas manejando tu proyecto con `composer` o simplemente quieres hacer una prueba rapida,
puedes ejecutar

    composer require geoapi.es/php

### Como funciona a nivel funcional

La librería tiene 2 partes importantes.

De base usaremos el siguiente código para poder explicar mejor cada parte.

```php
$geoapi = new GeoAPI(); //Nueva instancia de la librería
```

* Configuracion

    El método `setConfig` sirve para definir los parámetros que usará la librería para hacer las
    peticiones. Dichos parámetros están explicados en la [documentación general](https://github.com/GeoAPI-es/geoapi.es-docs).

    ```php
    //
    $geoapi->setConfig("key", "...");
    $geoapi->setConfig("sandbox", 0);
    ...
    ```

* Métodos

    La librería dispone de varios métodos, los cuales se usan para realizar las distintas peticiones. Cada uno de los métodos puede tener 0 o más parámetros, que se usan para,
    por ejemplo, filtrar o concretar la busqueda. Los métodos reciben un único argumento del
    tipo array asociativo, que a su vez debe contener parejas de valores siendo:

    * la clave - una cadena de texto especificando el parámetro que se desea enviar
    * el valor - o bien una cadena de texto o bien un numero que da valor al parámetro

    Ejemplos:

    ```php
    //
    $geoapi->comunidades(array());
    $geoapi->provincias(array(
        'CCOM' => '08'
    ));
    ...
    ```

    Todos los métodos disponibles, asi como sus parámetros, están especificados en la [documentación general](https://github.com/GeoAPI-es/geoapi.es-docs).

### Como funciona a nivel técnico

La librería realiza peticiones `GET` al endpoint y ejecuta un callback (usando `\React\Promise`),
pasándole como parámetros los datos recibidos. De esta manera se consigue un código asíncrono.

```php
$geoapi->comunidades(array(
    //Sin argumentos
))->then(function($respuesta) {
    echo print_r($respuesta, true);
});
```
