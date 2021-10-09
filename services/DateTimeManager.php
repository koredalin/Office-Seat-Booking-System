<?php

namespace app\services;

use \DateTime;
use yii\db\Expression;

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
     * 
     * @return string|int|null|false the value of the first column in the first row of the query result.
     * False is returned if the query result is empty.
     */
    public static function nowDb()
    {
        $expression = new Expression('NOW()');

        return (new \yii\db\Query)->select($expression)->scalar();
    }
}
