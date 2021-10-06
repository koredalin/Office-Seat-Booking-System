<?php

namespace app\services;

use \DateTime;

/**
 * Description of DateTimeManager
 *
 * @author Hristo
 */
class DateTimeManager
{
    public static function now(): DateTime
    {
        return new DateTime('NOW');
    }
    
    public static function nowStr(): string
    {
        return self::now()->format('Y-m-d H:i:s');
    }
}
