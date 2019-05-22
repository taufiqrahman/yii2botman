<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <a href="https://github.com/botman/botman" target="_blank">  
    <img src="https://camo.githubusercontent.com/07596d6ada94296e90131d01394b10eefa1ce16a/68747470733a2f2f626f746d616e2e696f2f696d672f626f746d616e2e706e67"height="100px">
    </a>
    <h1 align="center">Yii 2 Botman Project Template</h1>
    <br>
</p>

Yii 2 Botman Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with chatbot server.

<h2 align="left">About BotMan</h2>
    <br>
BotMan is a framework agnostic PHP library that is designed to simplify the task of developing innovative bots for multiple messaging platforms, including Slack, Telegram, Microsoft Bot Framework, Nexmo, HipChat, Facebook Messenger and WeChat.

You can find the BotMan documentation at https://botman.io.

DIRECTORY STRUCTURE
-------------------

```
common                   contains shared configurations
    
console                  contains console configurations
    
backend                  contains application assets such as JavaScript and CSS
                         Future plan is use for manage Chatbot content 
    
frontend                 contains application assets such as JavaScript and CSS
                         contains WebChatbot client. 

botman                   contains botman Chatbot server    

vendor/                  contains dependent 3rd-party packages

environments/            contains environment-based overrides
```

USAGE
-----
```
1. Clone this repo
2. Install like other Yii applications ( create DB than ./init, ./yii migrate)
3. Edit url for botman in common/config/params.php
4. Sign in new user (from frontend or backend)
5. Login in frontend.
6. click envelope icon in bottom right
7. viola ....you can use chatbot botman.

```