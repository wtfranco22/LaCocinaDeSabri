<?php

use BotMan\BotMan\Messages\Conversations\Conversation;

class ConversacionAmigable extends Conversation
{
    protected $respuesta;

    /**
     * recordemos que es un objeto de la clase, say, ask, repeat, son propios 
     * de la clase conversation
     * ask, es para realizar una pregunta al usuario
     * say, es para decirle alguna respuesta al usuario
     */
    public function charla()
    {
        $this->ask('Como estas humano?', function ($answer) {
            /*la respuesta del usuario es un objeto y del objeto obtener el mensaje,
            recordemos que puede ingresar archivos esta interaccion solo espera texto */
            $respuesta = $answer->getText();
            if (preg_match("/vos?/", $respuesta)) {
                //preg_match compara expresion regular, si $respuesta trae una subcadena igual a 'vos?' entonces ingresa
                $this->say('Bien, gracias por preguntarme');
            } elseif (preg_match("/\W/", $respuesta)) {
                //\W son para los caracteres especiales, para probar en el chat
                $this->say('Me estas provocando? ¬_¬ dije <br>');
                return $this->repeat();
            }
            //le preguntamos que quiere realizar y terminamos la funcion charla y volvemos a escuchar al usuario desde botman.php
            $this->say('que desea realizar?');
        });
    }
    /**
     * 'ejecuta' de manera automatica la clase y llama de inmediato a la funcion charla
     */
    public function run()
    {
        $this->charla();
    }
}