<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use idk\yii2\botman\Cache;
use BotMan\Drivers\Web\WebDriver;

class BotmanController extends Controller
{
    public $userName;

    public function actionIndex()
    {
        $this->userName='admin';
        // Set your driver
        DriverManager::loadDriver(WebDriver::class);
        // Create a botman instance
        $botman = BotManFactory::create([
                        'web' => [
                                'matchingData' => [
                                        'driver' => 'web',
                                ],
                        ]
                   ], new Cache()); // <= The cache from yii2-botman

        $botman->hears('.*hi.*|.*hello.*|.*hey.*', function ($bot) {
            $bot->reply('Hi '.$this->userName.', '.$this->randomGreeting().PHP_EOL.'What you want to do today ?
                ');
        });
        
        $botman->hears('thank.*|good.*|correct.*|ok', function ($bot) {
            $bot->reply($this->appraisal_thank_you());
        });

        // start listening
        $botman->listen();
        // request must be terminated.
        // die;
    }
    public function randomGreeting()
    {
        $items = [
            'Nice to meet you! 🤗',
            'it is great to see you 🤗. Have a good day. ☀ ',
            'Pleased to meet you! 🤗',
            'I\'m looking forward to working with you 🤗',
            'I think this is the beginning of a beautiful friendship 🤗'
    ];
        return  $items[array_rand($items)];
    }

    public function appraisal_thank_you()
    {
        $items = ['Anytime. '.PHP_EOL.'That\'s what I\'m here for.'.PHP_EOL.'Just say *Hi* if you want my asistance ya 😉',
                'It\'s my pleasure to help.'.PHP_EOL.'Just say *Hi* if you want my asistance ya 😉',
                '👍'];
        return  $items[array_rand($items)];
    }
}
