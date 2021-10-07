<?php

namespace app\services\interfaces;

/**
 *
 * @author Hristo
 */
interface SeatBookServiceInterface
{
    /**
     * 
     * @param array $post
     * @return bool Success.
     */
    public function book(array $post): bool;
}
