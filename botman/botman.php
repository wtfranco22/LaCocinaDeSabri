<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('OnboardingConversation.php');
require_once('ButtonConversation.php');

$config = [];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->fallback(function($bot){
    $mensaje = $bot->getMessage();
    $bot->reply('No reconozco el comando \''.$mensaje->getText().'\', tu vieja por las dudas');
});

$botman->hears('(.*)hola(.*)|buenos(.*)|buenas(.*)', function($bot) {//por aca ingresa el texto del usuario
    $bot->startConversation(new OnboardingConversation()); 
});
$botman->hears('(.*)ayuda(.*)|(.*)no ent(.*)|(.*)no se(.*)', function($bot) {
    $bot->startConversation(new ButtonConversation()); 
});

$botman->hears('(.*)chau(.*)|me voy(.*)|adios(.*)|nos vemos(.*)|gracias', function($bot) {
    $bot->reply('Un placer, hasta pronto!');
})->stopsConversation();

/*$botman->hears('nombres', function($bot) {
    $bot->startConversation(new ButtonConversation());
    //es para mostrar opciones de botones o tomar lo que ingresa el usuario
});*/

$botman->listen();
