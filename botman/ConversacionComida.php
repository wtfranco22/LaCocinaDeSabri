<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class ConversacionComida extends Conversation
{
    /**
     * creamos la pregunta, creamos el boton y le preguntamos si quiere ver el plato
     * y si elige verlo, guardamos el obj image, y usamos obj outgoingmesagge para responder
     * al usuario, asi como devolvemos la imagen puede ser cualquier archivo
     */
    public function run()
    {
        $preguntas = Question::create('Plato del dia: Milanesa')
            ->addButtons([
                Button::create('Ver Plato')->value('milanesa'),
            ]);
        $this->ask($preguntas, function ($answer) {
            if ($answer->getValue() == 'milanesa') {
                //creamos el obj Image pasando por parametro la url de la imagen
                $imagen = new Image('http://localhost/LaCocinaDeSabri/multimedia/milanesa.jpeg');
                //outgoingmessage es para responderle al usuario con un archivo
                //creamos al obj con su nombre y con withAttachment adjuntamos el archivo
                $rta = OutgoingMessage::create('Mila C/fritas $400')->withAttachment($imagen);
                $this->say($rta);
            }
            $this->say('Puede ingresar a nuestro Menú &#8658; Entradas / Principal 
            Ó ingrese <a href=\'../cartaMenu.html#principal\' target=\'_blank\'>Aquí</a>');
        });
    }
}
