<?php

use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;
use Discord\Voice\VoiceClient;
use Discord\Parts\Channel\Message;
require_once ('./vendor/autoload.php');
require_once ('./key.php');
require_once ('./text.php');

$key = getkey();

$discord = new Discord(
    ['token'=>$key]);
$discord->on('ready', function (Discord $discord){
    echo 'bot is ready';
    $discord->on('message', function ($message, $discord){
        $content = $message -> content;
//        if(strpos($content,'!') === false) return;

        if(strpos($content,'!play') === 0) {
            $channel = $message->author->getVoiceState()->channel;

            if($channel) {
                $channel->join()->then(function (VoiceClient $vc) use ($content) {
                    $url = substr($content, 5);

                    $audioFile = 'audio.ogg';

                    exec("youtube-dl -x --audio-format vorbis --audio-quality 0 --output", $audioFile, $url);

                    $vc->playFile($audioFile);

                });
            } else {
                $message->channel->sendMessage('{$e->getMessage()}\n";');
            }
    };

        textCommand($content,$message);
    });
});


$discord->run();
