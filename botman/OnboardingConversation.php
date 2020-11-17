<?php

use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation
{
    protected $firstname;

    public function askFirstname()
    {
        $this->ask('Cual es tu nombre?', function($answer) {
            $firstName = $answer->getText();
            if( trim($firstName) === "." || trim($firstName) === " " )
                return $this->repeat('Ingrese un nombre real por favor! ');
            $this->say('Un placer conocerte '.$firstName);
        });
    }

    public function run()
    {
        $this->askFirstname();
    }

}
