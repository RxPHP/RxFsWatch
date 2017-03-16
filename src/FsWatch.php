<?php

namespace Rx\React;

use React\EventLoop\LoopInterface;
use Rx\DisposableInterface;
use Rx\Observable;
use Rx\ObserverInterface;
use Rx\Subject\Subject;

class FsWatch extends Observable
{
    private $process;
    private $errors;

    public function __construct($path, $options = null, LoopInterface $loop = null)
    {
        $cmd = "fswatch -xrn {$path} " . $options;

        $this->errors  = new Subject();
        $this->process = new ProcessSubject($cmd, $this->errors, null, null, [], $loop);
    }

    public function _subscribe(ObserverInterface $observer) : DisposableInterface
    {
        return $this->process
            ->merge($this->errors->map(function (\Throwable $ex) {
                throw $ex;
            }))
            ->map(function ($data) {
                list($file, $bitwise) = explode(" ", $data);
                return new WatchEvent($file, (int)$bitwise);
            })
            ->subscribe($observer);
    }
}
