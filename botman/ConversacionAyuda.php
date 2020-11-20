<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ConversacionAyuda extends Conversation
{

    /**
     * creamos un obj pregunta, obj pregunta contiene objetos botones,
     * preguntamos si la respuesta fue de forma interactiva (en este caso si respondio por botones)
     * y sino le insistimos que responda con botones, si es interactiva leemos el valor de la respuesta 
     * y le damos intrucciones, para href si no usamos target='_blank' se carga la pagina dentro del chat, probar jaja
     */
    public function run()
    {
        //creamos una pregunta que contendra botones
        $preguntas = Question::create('opciones de ayuda')
            ->addButtons([ //arreglo de los botones de opciones
                Button::create('Crear Cuenta')->value('crear'),
                Button::create('Realizar Pedido')->value('encargar'),
                Button::create('Horarios de Atención')->value('horarios'),
                Button::create('Medios De Pagos')->value('pago'),
            ]);
        $this->ask($preguntas, function ($answer) {
            //pregunta a traves de los botones y el usuario responde
            if ($answer->isInteractiveMessageReply()) {
                //es valido xq el usuario respondio con los botones
                if ($answer->getValue() == 'crear') {
                    //selecciono el boton Crear Cuenta
                    $this->say('Vaya a la parte superior<br>Ingrese a Cuenta &#8658; CrearCuenta<br>
                   Ó ingrese <a href=\'../CrearCuenta.html\' target=\'_blank\'>Aquí</a>');
                } elseif ($answer->getValue() == 'encargar') {
                    $this->say('En este caso usted puede ingresar a nuestro Menú &#8658; Entradas / Principal<br>
                    Ó ingrese <a href=\'../CartaMenu.html\' target=\'_blank\'>Aquí</a>');
                } elseif ($answer->getValue() == 'horarios') {
                    $this->say('Horarios:<br>
                    Lunes a Viernes de 10:00 hs a 14:00 hs.<br>
                    Sábado de 19:30 a 23:30 hs.');
                } elseif ($answer->getValue() == 'pago') {
                    //la pagina se encarga de interpretar las imagenes
                    $this->say('Tarjetas de Credito <img height=\'12px\' src=\'MasterCard_Logo.svg.png\' /><br>
                    Tarjetas de Débito <img height=\'12px\' src=\'Maestro_Logo.svg.png\' /><br>
                    Efectivo <img height=\'15px\' src=\'efectivo.png\' /> con 20% de descuento');
                }
            } else {
                //el usuario no respondio a traves de los botones dados, si queremos leer ambas, solo sacamos la condicion
                $this->say('Seleccione una opcion');
                $this->repeat();//se repite esta funcion
            }
        });
    }
}
