<?php

use Rx\React\FsWatch;
use Rx\React\WatchEvent;

require __DIR__ . '/../vendor/autoload.php';

$watch = new FsWatch('~/');

$watch->subscribeCallback(function (WatchEvent $e) {
    echo "file: ", $e->getFile(), PHP_EOL;
    echo "event types: ", json_encode($e->getEvents()), PHP_EOL;
});
