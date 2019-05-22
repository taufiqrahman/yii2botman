<?php

namespace botman\conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class OnboardingConversation extends Conversation
{
    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask('Hi, what is your name?', function (Answer $answer) {
            $this->firstname = $answer->getText();
            $this->say('Nice to meet you '.$this->firstname);
            $this->askEmail();
        });
    }
    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function (Answer $answer) {
            // Save result
            $this->email = $answer->getText();
            //$this->say('your email is :'.$this->email);
            $this->say('Great - that is all we need, '.$this->firstname);
            $this->confirmBoarding();
        });
    }

    public function confirmBoarding()
    {
        $message = '-------------------------------------- <br>';
        $message .= 'Name : ' . $this->firstname . '<br>';
        $message .= 'Email : ' . $this->email. '<br>';
        $message .= '---------------------------------------';

        $this->say('Great. Your boarding has been confirmed. Here is your boarding details. <br><br>' . $message);
    }


    public function run()
    {
        $this->askFirstname();
    }
}
