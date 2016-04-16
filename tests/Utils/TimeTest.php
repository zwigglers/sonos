<?php

namespace duncan3dc\SonosTests\Utils;

use duncan3dc\Sonos\Utils\Time;

class TimeTest extends \PHPUnit_Framework_TestCase
{

    public function testFromString1()
    {
        $time = Time::FromString(55);
        $this->assertSame(55, $time->asInt());
        $this->assertSame("00:00:55", $time->asString());
    }
    public function testFromString2()
    {
        $time = Time::FromString(":55");
        $this->assertSame(55, $time->asInt());
        $this->assertSame("00:00:55", $time->asString());
    }
    public function testFromString3()
    {
        $time = Time::FromString("1:55");
        $this->assertSame(115, $time->asInt());
        $this->assertSame("00:01:55", $time->asString());
    }
    public function testFromString4()
    {
        $time = Time::FromString("01:00");
        $this->assertSame(60, $time->asInt());
        $this->assertSame("00:01:00", $time->asString());
    }
    public function testFromString5()
    {
        $time = Time::FromString("1:01:01");
        $this->assertSame(3661, $time->asInt());
        $this->assertSame("01:01:01", $time->asString());
    }


    public function testFromInt1()
    {
        $time = Time::FromInt(0);
        $this->assertSame(0, $time->asInt());
        $this->assertSame("00:00:00", $time->asString());
    }
    public function testFromInt2()
    {
        $time = Time::FromInt(60);
        $this->assertSame(60, $time->asInt());
        $this->assertSame("00:01:00", $time->asString());
    }
    public function testFromInt3()
    {
        $time = Time::FromInt(127);
        $this->assertSame(127, $time->asInt());
        $this->assertSame("00:02:07", $time->asString());
    }
    public function testFromInt4()
    {
        $time = Time::FromInt(3600);
        $this->assertSame(3600, $time->asInt());
        $this->assertSame("01:00:00", $time->asString());
    }
    public function testFromInt5()
    {
        $time = Time::FromInt(3725);
        $this->assertSame(3725, $time->asInt());
        $this->assertSame("01:02:05", $time->asString());
    }


    public function testFormat1()
    {
        $time = Time::FromString("1:9:4");
        $this->assertSame("01/09/04", $time->format("%H/%M/%S"));
    }
    public function testFormat2()
    {
        $time = Time::FromString("01:05:02");
        $this->assertSame("1-5-2", $time->format("%h-%m-%s"));
    }
    public function testFormat3()
    {
        $time = Time::FromString("99:59:59");
        $this->assertSame("99-59-59", $time->format("%h-%m-%s"));
    }
    public function testFormat4()
    {
        $time = Time::FromString("00:00:00");
        $this->assertSame("0-0-0", $time->format("%h-%m-%s"));
    }
}
