<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/07/2018
 * Time: 21:31
 */

namespace Mld\Exception;

use Throwable;

class ConfigException extends \Exception
{
    /**
     * ConfigException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('%s with exception : %s', __CLASS__, $message), $code, $previous);
    }
}