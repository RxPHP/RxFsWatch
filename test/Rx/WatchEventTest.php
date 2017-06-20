<?php

namespace  Rx\React\Tests;

use PHPUnit\Framework\TestCase;
use Rx\React\WatchEvent;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class WatchEventTest extends TestCase
{
    public function testFileCreated()
    {
        $e = new WatchEvent('/some/file.txt', 514);

        self::assertTrue($e->created());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(514, $e->getBitwise());
    }

    public function testFileUpdated()
    {
        $e = new WatchEvent('/some/file.txt', 516);

        self::assertTrue($e->updated());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(516, $e->getBitwise());
    }

    public function testFileRenamed()
    {
        $e = new WatchEvent('/some/file.txt', 528);

        self::assertTrue($e->renamed());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(528, $e->getBitwise());
    }

    public function testFileRemoved()
    {
        $e = new WatchEvent('/some/file.txt', 520);

        self::assertTrue($e->removed());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(520, $e->getBitwise());
    }

    public function testFileOwnerModified()
    {
        $e = new WatchEvent('/some/file.txt', 544);

        self::assertTrue($e->ownerModified());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(544, $e->getBitwise());
    }

    public function testFileAttributeModified()
    {
        $e = new WatchEvent('/some/file.txt', 576);

        self::assertTrue($e->attributeModified());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(576, $e->getBitwise());
    }

    public function testFileIsLink()
    {
        $e = new WatchEvent('/some/file.txt', 4608);

        self::assertTrue($e->isFile());
        self::assertTrue($e->isLink());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(4608, $e->getBitwise());
    }

    public function testFileIsSymbolicLink()
    {
        $e = new WatchEvent('/some/file.txt', 2560);

        self::assertTrue($e->isFile());
        self::assertTrue($e->isSymbolicLink());
        self::assertEquals('/some/file.txt', $e->getFile());
        self::assertEquals(2560, $e->getBitwise());
    }

    public function testDir()
    {
        $e = new WatchEvent('/some/dir', 1024);

        self::assertTrue($e->isDir());
        self::assertEquals('/some/dir', $e->getFile());
        self::assertEquals(1024, $e->getBitwise());
    }
}
