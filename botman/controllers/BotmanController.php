<?php
/**
 * Created by Taufiq Rahman.
 * Date: 02/05/18
 * Time: 11.34
 */

namespace botman\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use idk\yii2\botman\Cache;
use BotMan\Drivers\Web\WebDriver;
use botman\conversations\OnboardingConversation;

class BotmanController extends Controller
{
    public $userName;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        \Yii::$app->language = 'id';
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
            $bot->reply('Hi '.', '.$this->randomGreeting().PHP_EOL.Yii::t('botman', 'What you want to do today ?'));
        });
        
        $botman->hears('bahasa', function ($bot) {
            $bot->reply('ok, saya berbahasa indonesia');
        });

        $botman->hears('thank.*|good.*|correct.*|ok', function ($bot) {
            $bot->reply($this->appraisal_thank_you());
        });

        $botman->hears('boarding', function ($bot) {
            $bot->startConversation(new OnboardingConversation);
        });

        $botman->fallback(function ($bot) {
            $user=$bot->getUser()->getId();
            $message =$bot->getMessage()->getPayload();
            
            //{ ["driver"]=> string(3) "web" ["userId"]=> string(5) "Admin" ["message"]=> string(8) "ddfadsfa" ["attachment"]=> string(4) "null" ["interactive"]=> string(1) "0" }
            // var_dump($message);
            // die();
            $bot->reply('Sorry '.$user. '🙏'.PHP_EOL.$message['message'] .'<br>'.' I did not understand these commands.'.PHP_EOL.'Just say *Hi* if you want my asistance ya 😉');
        });
        // start listening
        $botman->listen();
        // request must be terminated.
          // die;
    }
    // public function randomGreeting()
    // {
    //     $items = [
    //         'Nice to meet you! 🤗',
    //         'it is great to see you 🤗. Have a good day. ☀ ',
    //         'Pleased to meet you! 🤗',
    //         'I\'m looking forward to working with you 🤗',
    //         'I think this is the beginning of a beautiful friendship 🤗'
    // ];
    //     return  $items[array_rand($items)];
    // }

    public function randomGreeting()
    {
        $items = [
            Yii::t('botman', 'Nice to meet you!'),
            Yii::t('botman', 'it is great to see you. Have a good day.')
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
