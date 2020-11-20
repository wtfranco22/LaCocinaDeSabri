<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('ConversacionAmigable.php');
require_once('ConversacionAyuda.php');
require_once('ConversacionComida.php');

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$config = [];

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

//cuando no coincide con ningun 'hears' entra en fallback
$botman->fallback(function ($bot) {
    //del driver que utilizamos obtenemos el obj mensaje del usuario
    $mensaje = $bot->getMessage();
    //damos una respuesta inmediata con reply al usuario
    $bot->reply('No comprendo \'' . $mensaje->getText() . '\', sea más específico por favor :)');
});

//hears es para escuchar lo que dice el usuario y compararlo con el primer parametro
$botman->hears('hola(.*)|buen(.*)', function ($bot) { //por aca ingresa el texto del usuario
    $mensaje = $bot->getMessage();
    if (preg_match("/como estas/", $mensaje->getText())) {
        //si el texto del usuario tiene un substring = como estas entonces ingresa
        $bot->reply('Bien, gracias por preguntarme');
    }
    //startConversation da la responsabilidad a la clase que se encuentra en el parametro para que responda
    $bot->startConversation(new ConversacionAmigable());
});

$botman->hears('(.*)ayuda(.*)|(.*)no ent(.*)|(.*)guiar(.*)|(.*)comida(.*)', function ($bot) {
    $bot->startConversation(new ConversacionAyuda());
})->skipsConversation();
/*skipsConversation, es para hacer un salto a este llamado si es que coincide,
no importa en que parte del hilo se encuentre, se realiza un salto a ese llamado y 
lo mas importante es que al finalizar continua en donde se encontraba antes de la coincidencia*/

$botman->hears('(.*)plato del dia(.*)', function ($bot) { //por aca ingresa el texto del usuario
    $bot->startConversation(new ConversacionComida());
});

$botman->hears('(.*)chau(.*)|me voy(.*)|adios(.*)|nos vemos(.*)|gracias|nada', function ($bot) {
    $bot->reply('Un placer, hasta pronto!');
})->stopsConversation();
/*stopConversation, realiza un salto a este llamado sin importar donde este pero
la diferencia es que se detiende el hilo de conversacion*/

//el siguiente llamado es para que botman este atento a los ingresos de mensaje, esta atento para 'escuchar'
$botman->listen();
