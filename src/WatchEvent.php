<?php

namespace Rx\React;

class WatchEvent
{
    private $bitwise;
    private $file;
    private $events = [];

    const NO_OP = 0;
    const PLATFORM_SPECIFIC = 1;
    const CREATED = 2;
    const UPDATED = 4;
    const REMOVED = 8;
    const RENAMED = 16;
    const OWNER_MODIFIED = 32;
    const ATTRIBUTE_MODIFIED = 64;
    const MOVED_FROM = 128;
    const MOVED_TO = 256;
    const IS_FILE = 512;
    const IS_DIR = 1024;
    const IS_SYM_LINK = 2048;
    const LINK = 4096;
    const OVERFLOW = 8192;

    public function __construct(string $file, int $bitwise)
    {
        $this->bitwise = $bitwise;
        $this->file    = $file;
    }

    public function getBitwise()
    {
        return $this->bitwise;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getEvents()
    {
        if ($this->bitwise & self::NO_OP) $this->events[] = "NO_OP";
        if ($this->bitwise & self::ATTRIBUTE_MODIFIED) $this->events[] = "ATTRIBUTE_MODIFIED";
        if ($this->bitwise & self::OWNER_MODIFIED) $this->events[] = "OWNER_MODIFIED";
        if ($this->bitwise & self::CREATED) $this->events[] = "CREATED";
        if ($this->bitwise & self::REMOVED) $this->events[] = "REMOVED";
        if ($this->bitwise & self::RENAMED) $this->events[] = "RENAMED";
        if ($this->bitwise & self::UPDATED) $this->events[] = "UPDATED";
        if ($this->bitwise & self::MOVED_FROM) $this->events[] = "MOVED_FROM";
        if ($this->bitwise & self::MOVED_TO) $this->events[] = "MOVED_TO";
        if ($this->bitwise & self::OVERFLOW) $this->events[] = "OVERFLOW";

        return $this->events;
    }

    public function isFile()
    {
        return (bool) ($this->bitwise & self::IS_FILE);
    }

    public function isDir()
    {
        return (bool) ($this->bitwise & self::IS_DIR);
    }

    public function isSymbolicLink()
    {
        return (bool) ($this->bitwise & self::IS_SYM_LINK);
    }

    public function isLink()
    {
        return (bool) ($this->bitwise & self::LINK);
    }

    public function noOp()
    {
        return (bool) ($this->bitwise & self::NO_OP);
    }

    public function attributeModified()
    {
        return (bool) ($this->bitwise & self::ATTRIBUTE_MODIFIED);
    }

    public function ownerModified()
    {
        return (bool) ($this->bitwise & self::OWNER_MODIFIED);
    }

    public function created()
    {
        return (bool) ($this->bitwise & self::CREATED);
    }

    public function removed()
    {
        return (bool) ($this->bitwise & self::REMOVED);
    }

    public function renamed()
    {
        return (bool) ($this->bitwise & self::RENAMED);
    }

    public function updated()
    {
        return (bool) ($this->bitwise & self::UPDATED);
    }
}
