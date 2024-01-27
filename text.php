<?php

function textCommand($content,$message) {
        if($content === '!kok'){
            $imageLink = 'https://http.cat/201';
            $message->channel->sendMessage($imageLink);
        };
};

