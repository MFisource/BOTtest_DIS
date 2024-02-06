<?php

require __DIR__.'/vendor/autoload.php';
require './key.php';

use Discord\Discord;
use Discord\WebSockets\Event;

$token = getkey();
$channelIdToJoin = "1200847994841473155"; // Замените YOUR_VOICE_CHANNEL_ID на реальный ID голосового канала

$discord = new Discord([
    'token' => $token,
]);

$discord->on('ready', function ($discord) use ($channelIdToJoin) {
    echo "Bot is ready!", PHP_EOL;

    $discord->on(Event::VOICE_STATE_UPDATE, function ($voiceState, $discord) {
        if ($voiceState->guild_id !== null && $voiceState->user_id === $discord->user->id && $voiceState->channel_id !== null) {
            echo "Бот успешно присоединился к голосовому каналу {$voiceState->channel_id}" . PHP_EOL;
        }
    });

    $discord->on(Event::MESSAGE_CREATE, function ($message, $discord) use ($channelIdToJoin) {
        if ($message->content === '!run') {
            $message->guild->channels->fetch('1200847994841473155')->done(function ($voicechan) use ($discord) {
                $discord->joinVoiceChannel($voicechan, false, true, null, true);
            });
        }
    });
});

$discord->run();
