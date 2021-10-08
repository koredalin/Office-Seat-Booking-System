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
    
    /**
     * Returns current date, time as scalar expression.
     */
    public static function nowDb(): string
    {
        $expression = new Expression('NOW()');

        return (new \yii\db\Query)->select($expression)->scalar();
    }
}
