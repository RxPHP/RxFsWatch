<?php

use Rx\React\FsWatch;
use Rx\React\WatchEvent;

require __DIR__ . '/../vendor/autoload.php';

$watch = new FsWatch(__DIR__, ' -e ".*" -i "\\\.txt$"');

$touch = (new \Rx\React\ProcessSubject('echo hey > ' . __DIR__ . '/test.txt'))->skip(1);

$watch
    ->merge($touch)
    ->subscribe(function (WatchEvent $e) {
        echo 'file: ', $e->getFile(), PHP_EOL;
        echo 'event types: ', json_encode($e->getEvents()), PHP_EOL;
    });
