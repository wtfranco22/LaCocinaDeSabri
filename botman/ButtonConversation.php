<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ButtonConversation extends Conversation
{

    public function run (){
        $preguntas = Question::create('¿En que puedo ayudarte?')
        ->addButtons([
            Button::create('Crear Cuenta')->value('crear'),
            Button::create('Realizar Pedido')->value('encargar'),
            Button::create('Horarios de Atención')->value('horarios'),
            Button::create('Medios De Pagos')->value('pago'),
        ]);
        $this->ask($preguntas, function ($answer){
            //podemos dar botones y tomar lo escrito o condicionar a botones
            if($answer->isInteractiveMessageReply()){
                //toma ambos $this->say('Un placer conocerte Don '.$answer->getValue());
                if($answer->getValue()=='crear'){
                   $this->say('Ingrese a Cuenta -> CrearCuenta'); 
                }
                elseif($answer->getValue()=='encargar'){
                    $this->say('En este caso usted puede ingresar a nuestro Menú -> Entradas / Principal ');
                }
                elseif($answer->getValue()=='horarios'){
                    $this->say('Horarios:<br>
                    Lunes a Viernes de 10:00 hs a 14:00 hs.<br>
                    Sábado de 19:30 a 23:30 hs.');
                }
                elseif($answer->getValue()=='pago'){
                    $this->say('Tarjetas de Credito <img height=\'12px\' src=\'MasterCard_Logo.svg.png\' /><br>
                    Tarjetas de Débito <img height=\'12px\' src=\'Maestro_Logo.svg.png\' /><br>
                    Efectivo <img height=\'15px\' src=\'efectivo.png\' /> con 20% de descuento');
                }
            }else{
                $this->say('No es valida la opción');
                $this->repeat();
            }
        });
    }
}
?>