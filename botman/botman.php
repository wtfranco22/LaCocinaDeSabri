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

$botman->fallback(function ($bot) {
    $mensaje = $bot->getMessage();
    $bot->reply('No comprendo \'' . $mensaje->getText() . '\', sea más específico por favor :)');
});

$botman->hears('hola(.*)|buen(.*)', function ($bot) { //por aca ingresa el texto del usuario
    $mensaje = $bot->getMessage();
    if (preg_match("/como estas/", $mensaje->getText())) {
        $bot->reply('Bien, gracias por preguntarme');
    }
    $bot->startConversation(new ConversacionAmigable());
});

$botman->hears('(.*)ayuda(.*)|(.*)no ent(.*)|(.*)guiar(.*)|(.*)comida(.*)', function ($bot) {
    $bot->startConversation(new ConversacionAyuda());
})->skipsConversation();

$botman->hears('(.*)plato del dia(.*)', function ($bot) { //por aca ingresa el texto del usuario
    $bot->startConversation(new ConversacionComida());
});

$botman->hears('(.*)chau(.*)|me voy(.*)|adios(.*)|nos vemos(.*)|gracias|nada', function ($bot) {
    $bot->reply('Un placer, hasta pronto!');
})->stopsConversation();

$botman->listen();
