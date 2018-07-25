<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/07/2018
 * Time: 20:03
 */

namespace Mld\Core\Defaults;

final class Dungeon
{
    /** @var string $BREAK_LINE */
    public static $BREAK_LINE = "\n";

    /** @var int $WIDTH */
    public static $WIDTH = 20;

    /** @var int $HEIGHT */
    public static $HEIGHT = 20;

    /** @var float $PERCENTAGE_OF_ROOMS */
    public static $PERCENTAGE_OF_ROOMS = 0.15;

    /** @var int $EMPTY_TALE */
    public static $EMPTY_TALE = ' ';

    /** @var string $ROOM_TALE */
    public static $ROOM_TALE = '#';
}