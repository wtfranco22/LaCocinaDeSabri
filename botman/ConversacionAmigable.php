<?php

use BotMan\BotMan\Messages\Conversations\Conversation;

class ConversacionAmigable extends Conversation
{
    protected $respuesta;

    public function charla()
    {
        $this->ask('Como estas humano?', function ($answer) {
            $respuesta = $answer->getText();
            if (preg_match("/vos/", $respuesta)) {
                $this->say('Bien, gracias por preguntarme');
            } elseif (preg_match("/mal/", $respuesta)) {
                $this->say('Necesitas ayuda?.. pregunta');
            } else {
                (trim($respuesta) == "." || trim($respuesta) == " ");
                $this->say('Me estas provocando? ¬_¬ dije <br>');
                return $this->repeat();
            }
        });
    }

    public function run()
    {
        $this->charla();
    }
}
