<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/07/2018
 * Time: 20:52
 */

namespace Mld\Core\Defaults;

use Mld\Core\Defaults\Dungeon as DungeonConfig;

abstract class AbstractDungeon
{
    /** @var array $dungeon */
    protected $dungeon = [];

    /**
     * Initialisation
     */
    public function __init(): void
    {
        for ($i = 0; $i < DungeonConfig::$HEIGHT; $i++) {
            for ($j = 0; $j < DungeonConfig::$WIDTH; $j++) {
                if (!isset($this->dungeon[$i])) {
                    $this->dungeon[$i] = [];
                }

                $this->dungeon[$i][$j] = DungeonConfig::$EMPTY_TALE;
            }
        }
    }

    /**
     * Return the dungeon as a string
     *
     * @return string
     */
    public function __toString(): string
    {
        $string = '';

        for ($i = 0; $i < DungeonConfig::$HEIGHT; $i++) {
            for ($j = 0; $j < DungeonConfig::$WIDTH; $j++) {
                $string .= sprintf('%s', $this->dungeon[$i][$j]);
            }

            $string .= sprintf('%s', DungeonConfig::$BREAK_LINE);
        }

        return $string;
    }
}