<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class ConversacionComida extends Conversation
{
    public function run()
    {
        $preguntas = Question::create('Plato del dia: Milanesa')
            ->addButtons([
                Button::create('Ver Plato')->value('milanesa'),
            ]);
        $this->ask($preguntas, function ($answer) {
            if ($answer->getValue() == 'milanesa') {
                $imagen = new Image('http://localhost/LaCocinaDeSabri/multimedia/milanesa.jpeg');
                $rta = OutgoingMessage::create('Mila C/fritas $400')->withAttachment($imagen);
                $this->say($rta);
            }
            $this->say('Puede ingresar a nuestro Menú &#8658; Entradas / Principal 
            Ó ingrese <a href=\'../cartaMenu.html#principal\' target=\'_blank\'>Aquí</a>');
        });
    }
}
