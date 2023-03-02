<?php

class Seconds{

    private static int $minute = 60;
    private static int $hour = 3600;
    private static int $day = 86400;
    private static int $week = 604800;
    private static int $month = 2592000;

    public static function Minute(): int{
        return Seconds::$minute;
    }

    public static function Hour(): int{
        return Seconds::$hour;
    }

    public static function Day(): int{
        return Seconds::$day;
    }

    public static function Week(): int{
        return Seconds::$week;
    }

    public static function Month(): int{
        return Seconds::$month;
    }
}

?>