<?php

use Rx\React\FsWatch;
use Rx\React\WatchEvent;

require __DIR__ . '/../vendor/autoload.php';

$watch = new FsWatch(__DIR__ . '/test.txt');

$touch = (new \Rx\React\ProcessSubject('echo hmmm > ' . __DIR__ . '/test.txt'))->skip(1);

$watch
    ->merge($touch)
    ->subscribe('print_r');


//file: .../test.txt
//event types: ["CREATED"]
