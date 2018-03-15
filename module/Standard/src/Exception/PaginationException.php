<?php

namespace Standard\Exception;

/**
 * Class PaginationException
 *
 * @package Standard\Exception
 */
class PaginationException extends \Exception
{
    /**
     * PaginationException constructor.
     *
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 500);
    }
}
